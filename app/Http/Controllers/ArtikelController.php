<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function index()
    {
        $artikel = Artikel::all();

        $popularArtikel = Artikel::orderBy('view_count', 'desc')->take(6)->get();

        $allTags = Artikel::pluck('tags')->map(function ($tags) {
            return json_decode($tags);
        })->flatten()->unique()->values();

        $randomTags = $allTags->random(min(8, $allTags->count()));

        return view('pages.artikel', [
            'artikel' => $artikel,
            'popularArtikel' => $popularArtikel,
            'randomTags' => $randomTags
        ]);
    }

    public function detail($slug)
    {
        $artikel = Artikel::where('slug', $slug)->firstOrFail();

        $artikel->increment('view_count');

        $relatedPosts = Artikel::inRandomOrder()
            ->whereNotIn('id', [$artikel->id])
            ->take(3)
            ->get();

        $popularArtikel = Artikel::orderBy('view_count', 'desc')->take(6)->get();

        $allTags = Artikel::pluck('tags')->map(function ($tags) {
            return json_decode($tags);
        })->flatten()->unique()->values();

        $randomTags = $allTags->random(min(8, $allTags->count()));

        return view('pages.artikel_detail', compact('artikel', 'relatedPosts', 'popularArtikel', 'randomTags'));
    }
}
