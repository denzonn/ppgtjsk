<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnggotaBidang;
use App\Models\Artikel;
use App\Models\Bidang;
use App\Models\FotoKsb;
use App\Models\GalleryKegiatan;
use App\Models\JabatanBidang;
use App\Models\Kegiatan;
use App\Models\NotulensiRapat;
use App\Models\Periode;
use App\Models\ProgramKerja;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PeriodeController extends Controller
{
    public function index()
    {
        $periode = Periode::withCount('users')->orderByDesc('tahun_mulai')->get();
        $user = auth()->user();
        $bolehTambah = $user->isAdminUtama() || ! Periode::where('tahun_mulai', $user->periode->tahun_selesai)->exists();

        $pengurus = AnggotaBidang::withoutGlobalScope('periode')->selectRaw('periode_id, count(*) as jumlah')
            ->groupBy('periode_id')->pluck('jumlah', 'periode_id');

        return view('pages.admin.periode.index', compact('periode', 'bolehTambah', 'pengurus'));
    }

    public function create()
    {
        $mulai = auth()->user()->periode?->tahun_selesai;

        return view('pages.admin.periode.create', compact('mulai'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'tahun_mulai' => 'required|integer|between:2000,2100',
            'tahun_selesai' => 'required|integer|between:2000,2100|gt:tahun_mulai',
        ]);
        abort_unless(auth()->user()->bolehBuatPeriode($data['tahun_mulai'], $data['tahun_selesai']), 403);
        if (! auth()->user()->isAdminUtama() && $data['tahun_selesai'] - $data['tahun_mulai'] > 5) {
            throw ValidationException::withMessages(['tahun_selesai' => 'Periode maksimal 5 tahun.']);
        }
        if (Periode::where($data)->exists()
            || (! auth()->user()->isAdminUtama() && Periode::where('tahun_mulai', $data['tahun_mulai'])->exists())) {
            throw ValidationException::withMessages(['tahun_mulai' => 'Periode ini sudah ada.']);
        }
        Periode::create($data + ['dibuat_oleh' => auth()->id()]);

        return redirect()->route('periode.index')->with('success', 'Periode berhasil ditambahkan.');
    }

    /** Tab data per periode untuk admin utama (hanya lihat): [label, model, relasi, [kolom => nilai]]. */
    private function tab(): array
    {
        $rel = fn ($relasi, $kolom) => fn ($i) => $i->{$relasi}?->{$kolom} ?? '-';

        return [
            'pengurus' => ['Pengurus', AnggotaBidang::class, ['bidang', 'jabatan'], [
                'Nama' => fn ($i) => $i->nama_anggota, 'Jabatan' => $rel('jabatan', 'nama_jabatan'), 'Bidang' => $rel('bidang', 'nama_bidang')]],
            'bidang' => ['Bidang', Bidang::class, [], [
                'Nama Bidang' => fn ($i) => $i->nama_bidang, 'Maksimal Orang' => fn ($i) => $i->maksimal_orang ?? 'Tidak dibatasi']],
            'jabatan' => ['Jabatan', JabatanBidang::class, [], ['Nama Jabatan' => fn ($i) => $i->nama_jabatan]],
            'foto-ksb' => ['Foto KSB', FotoKsb::class, [], ['Nama' => fn ($i) => $i->nama, 'Jabatan' => fn ($i) => $i->jabatan]],
            'program-kerja' => ['Program Kerja', ProgramKerja::class, ['bidang'], [
                'Program' => fn ($i) => $i->name, 'Bidang' => $rel('bidang', 'nama_bidang')]],
            'notulensi' => ['Notulensi', NotulensiRapat::class, [], ['Tanggal' => fn ($i) => $i->tanggal, 'Judul' => fn ($i) => $i->judul]],
            'artikel' => ['Artikel', Artikel::class, [], ['Tanggal' => fn ($i) => $i->tanggal, 'Judul' => fn ($i) => $i->judul]],
            'kegiatan' => ['Kegiatan', Kegiatan::class, ['program'], [
                'Kegiatan' => fn ($i) => $i->name, 'Program Kerja' => $rel('program', 'name')]],
            'galeri' => ['Galeri Kegiatan', GalleryKegiatan::class, ['kegiatan'], [
                'Kegiatan' => $rel('kegiatan', 'name'), 'Foto' => fn ($i) => $i->photo]],
        ];
    }

    public function show(Request $request, Periode $periode)
    {
        abort_unless(auth()->user()->isAdminUtama(), 403);
        $semua = $this->tab();
        $aktif = array_key_exists((string) $request->query('tab'), $semua) ? $request->query('tab') : 'pengurus';
        [, $model, $relasi, $kolom] = $semua[$aktif];
        $tanpaScope = fn ($q) => $q->withoutGlobalScope('periode');
        $diPeriode = fn ($m) => $m::withoutGlobalScope('periode')->where('periode_id', $periode->id);

        $baris = $diPeriode($model)->with(array_fill_keys($relasi, $tanpaScope))->latest('id')->paginate(25)->withQueryString();
        $jumlah = array_map(fn ($t) => $diPeriode($t[1])->count(), $semua);

        return view('pages.admin.periode.show', compact('periode', 'semua', 'aktif', 'kolom', 'baris', 'jumlah'));
    }

    public function pilih(Request $request)
    {
        abort_unless(auth()->user()->isAdminUtama(), 403);
        $data = $request->validate(['periode_id' => 'required|exists:periodes,id']);
        session(['periode_id' => (int) $data['periode_id']]);

        return back();
    }
}
