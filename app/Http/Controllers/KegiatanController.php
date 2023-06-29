<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\GalleryKegiatan;
use App\Models\Kegiatan;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function index()
    {
        $bidang = Bidang::all();

        // Pisahkan kegiatan berdasarkan bidang
        $kegiatan = [];

        foreach ($bidang as $item) {
            $kegiatan[$item->id] = Kegiatan::where('bidang_id', $item->id)->get();
        }

        return view('pages.kegiatan', [
            'kegiatan' => $kegiatan,
            'bidang' => $bidang
        ]);
    }


    public function detail($slug)
    {
        $kegiatan = Kegiatan::where('slug', $slug)->firstOrFail();
        $gallery = GalleryKegiatan::where('kegiatan_id', $kegiatan->id)->take(6)->get();

        return view('pages.kegiatan_detail', [
            'kegiatan' => $kegiatan,
            'gallery' => $gallery
        ]);
    }
}
