<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    const UPDATED_AT = null;

    protected $guarded = [];

    protected $casts = [
        'sebelum' => 'array',
        'sesudah' => 'array',
        'per_periode' => 'boolean',
    ];

    const LABEL = [
        Inventaris::class => 'Inventaris',
        JenisInventaris::class => 'Jenis Inventaris',
        DataAnggota::class => 'Data Anggota',
        PemasukanKeuangan::class => 'Pemasukan',
        PengeluaranKeuangan::class => 'Pengeluaran',
        PiutangKeuangan::class => 'Piutang',
        Iuran::class => 'Iuran',
        Dokument::class => 'Dokumen',
        RenunganHarian::class => 'Renungan',
        KegiatanMingguan::class => 'Kegiatan Mingguan',
        faq::class => 'FAQ',
        SekilasAnggota::class => 'Sekilas Anggota',
        LinkTerkait::class => 'Link Terkait',
        PundiKasih::class => 'Pundi Kasih',
        SiteImage::class => 'Gambar Situs',
        Saran::class => 'Saran',
        Admin\Profil::class => 'Profil',
        Bidang::class => 'Bidang',
        JabatanBidang::class => 'Jabatan',
        AnggotaBidang::class => 'Pengurus',
        FotoKsb::class => 'Foto KSB',
        ProgramKerja::class => 'Program Kerja',
        NotulensiRapat::class => 'Notulensi Rapat',
        Artikel::class => 'Artikel',
        Kegiatan::class => 'Kegiatan',
        GalleryKegiatan::class => 'Galeri Kegiatan',
        User::class => 'Akun',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }

    public function scopeTerlihatOleh($q, User $u)
    {
        if ($u->isAdminUtama()) {
            return $q;
        }

        return $q->where(fn ($w) => $w->where('per_periode', false)->orWhere('periode_id', $u->periode_id));
    }
}
