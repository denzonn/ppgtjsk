<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Artikel::all();

        return view('pages.admin.artikel.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.artikel.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['slug'] = \Str::slug($request->judul);

        if ($request->hasFile('photo')) {
            $images = $request->file('photo');
            $extension = $images->getClientOriginalExtension();
            $file_name = "artikel-" . $data['slug'] . "." . $extension;
            $data['photo'] = $images->storeAs('photo', $file_name, 'public');
        }

        $tagsString = explode(',', $request->tags);
        $newTagsArray = [];
        foreach ($tagsString as $tag) {
            $tag = substr($tag, 0, -1);
            array_push($newTagsArray, $tag);
        }
        $tagsJson = json_encode($newTagsArray);

        $artikel = Artikel::create([
            'judul' => $data['judul'],
            'slug' => $data['slug'],
            'photo' => $data['photo'],
            'tags' => $tagsJson,
            'tanggal' => $data['tanggal'],
            'isi' => $data['isi'],
        ]);

        return redirect()->route('artikel.index')->with('success', 'Artikel berhasil disimpan');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Artikel::findOrFail($id);
        $tagsArray = json_decode($data->tags);

        return view('pages.admin.artikel.edit', compact('data', 'tagsArray'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $data['slug'] = \Str::slug($request->judul);
        $artikel = Artikel::findOrFail($id);

        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($artikel->photo) {
                Storage::disk('public')->delete($artikel->photo);
            }

            // Upload foto baru
            $images = $request->file('photo');
            $extension = $images->getClientOriginalExtension();
            $file_name = "artikel-" . $data['slug'] . "." . $extension;
            $data['photo'] = $images->storeAs('photo', $file_name, 'public');
        } else {
            // Jika tidak ada foto yang diunggah, gunakan foto dari artikel yang sudah ada
            $data['photo'] = $artikel->photo;
        }

        $tagsString = explode(',', $request->tags); // Pisahkan string menjadi array

        $newTagsArray = [];
        foreach ($tagsString as $tag) {
            $tag = substr($tag, 0, -1);
            array_push($newTagsArray, $tag);
        }
        $tagsJson = json_encode($newTagsArray);

        $artikel->update([
            'judul' => $data['judul'],
            'slug' => $data['slug'],
            'tags' => $tagsJson,
            'photo' => $data['photo'], // Gunakan foto baru atau foto yang sudah ada
            'tanggal' => $data['tanggal'],
            'isi' => $data['isi'],
        ]);

        return redirect()->route('artikel.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete photo
        $article = Artikel::findOrFail($id);
        Storage::disk('public')->delete($article->photo);
        $article->delete();

        return redirect()->route('artikel.index');
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'upload' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $images = $request->file('upload')->store('ckeditor-image-artikel', 'public');

        return response()->json([
            'url' => asset('storage/' . $images),
        ]);
    }
}
