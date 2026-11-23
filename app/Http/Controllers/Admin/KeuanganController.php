<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PemasukanKeuangan;
use App\Models\PengeluaranKeuangan;
use App\Models\PiutangKeuangan;
use Illuminate\Http\Request;

class KeuanganController extends Controller
{
    public function index()
    {
        $pemasukan = PemasukanKeuangan::select('tanggal', 'keterangan', 'jumlah')->selectRaw("'Masuk' as jenis")
            ->orderBy('tanggal', 'asc');

        $pengeluaran = PengeluaranKeuangan::select('tanggal', 'keterangan', 'jumlah')->selectRaw("'Keluar' as jenis")
            ->orderBy('tanggal', 'asc');

        $keuangan = $pemasukan->union($pengeluaran)
            ->orderBy('tanggal', 'asc')
            ->get();

        $piutang = PiutangKeuangan::where('status', 'Belum Lunas')->sum('jumlah');

        return view('pages.admin.keuangan.index', compact('keuangan', 'piutang'));
    }
}
