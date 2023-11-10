<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PemasukanKeuangan;
use App\Models\PengeluaranKeuangan;
use Illuminate\Http\Request;

class KeuanganController extends BaseController
{
    public function index()
    {
        $pemasukan = PemasukanKeuangan::select('tanggal', 'keterangan', 'jumlah')
            ->orderBy('tanggal', 'asc');

        $pengeluaran = PengeluaranKeuangan::select('tanggal', 'keterangan', 'jumlah')
            ->orderBy('tanggal', 'asc');

        $keuangan = $pemasukan->union($pengeluaran)
            ->orderBy('tanggal', 'asc')
            ->get();

        return $this->sendResponse($keuangan, 'Successfully get all keuangan');
    }
}
