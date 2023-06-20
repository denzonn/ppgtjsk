<?php

namespace App\Http\Controllers;

use App\Models\GalleryKegiatan;
use App\Models\Kegiatan;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function index()
    {
        $kegiatan = Kegiatan::all();

        return view('pages.kegiatan', [
            'kegiatan' => $kegiatan
        ]);
    }

    public function detail($slug)
    {
        $kegiatan = Kegiatan::where('slug', $slug)->firstOrFail();
        $gallery = GalleryKegiatan::where('kegiatan_id', $kegiatan->id)->take(12)->get();

        return view('pages.kegiatan_detail', [
            'kegiatan' => $kegiatan,
            'gallery' => $gallery
        ]);
    }
}
