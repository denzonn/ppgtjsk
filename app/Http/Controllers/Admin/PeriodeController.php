<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Periode;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PeriodeController extends Controller
{
    public function index()
    {
        $periode = Periode::withCount('users')->orderByDesc('tahun_mulai')->get();
        $user = auth()->user();
        $bolehTambah = $user->isAdminUtama() || ! Periode::where('tahun_mulai', $user->periode->tahun_selesai)->exists();

        return view('pages.admin.periode.index', compact('periode', 'bolehTambah'));
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
        if (Periode::where($data)->exists()
            || (! auth()->user()->isAdminUtama() && Periode::where('tahun_mulai', $data['tahun_mulai'])->exists())) {
            throw ValidationException::withMessages(['tahun_mulai' => 'Periode ini sudah ada.']);
        }
        Periode::create($data + ['dibuat_oleh' => auth()->id()]);

        return redirect()->route('periode.index')->with('success', 'Periode berhasil ditambahkan.');
    }

    public function pilih(Request $request)
    {
        abort_unless(auth()->user()->isAdminUtama(), 403);
        $data = $request->validate(['periode_id' => 'required|exists:periodes,id']);
        session(['periode_id' => (int) $data['periode_id']]);

        return back();
    }
}
