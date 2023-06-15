<?php

namespace App\Http\Controllers;

use App\Models\AnggotaBidang;
use App\Models\Bidang;
use App\Models\FotoKsb;
use App\Models\GalleryKegiatan;
use App\Models\Kegiatan;
use App\Models\RenunganHarian;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index()
    {
        $renungan = RenunganHarian::all();
        $kegiatan = Kegiatan::take(6)->get();
        $gallery = GalleryKegiatan::take(10)->get();
        $ksb = FotoKsb::all();

        $bidang = Bidang::all()->except(1, 'Koordinator Kelompok');
        $manajement = Bidang::where('id', 1)->get();

        $manajementPengurus = [];
        foreach ($manajement as $item) {
            $manajementPengurus[] = AnggotaBidang::where('bidangs_id', $item->id)->get();
        }

        $pengurus = [];

        foreach ($bidang as $item) {
            $pengurus[] = AnggotaBidang::where('bidangs_id', $item->id)->get();
        }


        return view('pages.home', [
            'renungan' => $renungan,
            'kegiatan' => $kegiatan,
            'gallery' => $gallery,
            'ksb' => $ksb,
            'pengurus' => $pengurus,
            'bidang' => $bidang,
            'manajement' => $manajement,
            'manajementPengurus' => $manajementPengurus
        ]);
    }
}
