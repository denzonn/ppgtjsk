<?php

namespace App\Http\Controllers;

use App\Models\GalleryKegiatan;
use App\Models\Kegiatan;
use Illuminate\Http\Request;

class GalleryActivityController extends Controller
{
    public function index()
    {
        $kegiatan = Kegiatan::all();

        // Pisahkan gallery berdasarkan kegiatan
        $gallery = [];

        foreach ($kegiatan as $item) {
            $gallery[$item->id] = GalleryKegiatan::where('kegiatan_id', $item->id)->get();
        }

        return view('pages.gallery', [
            'gallery' => $gallery,
            'kegiatan' => $kegiatan
        ]);
    }
}
