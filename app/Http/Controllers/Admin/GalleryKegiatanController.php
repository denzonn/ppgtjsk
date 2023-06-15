<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryKegiatan;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gallery = GalleryKegiatan::all();

        return view('pages.admin.gallery.index', [
            'gallery' => $gallery,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kegiatan =  Kegiatan::all();

        return view('pages.admin.gallery.create', [
            'kegiatan' => $kegiatan,
        ]);
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
        $kegiatan = Kegiatan::where('id', $data['kegiatan_id'])->first();
        $name = $kegiatan->name;

        $this->validate($request, [
            'photo' => 'required',
            'photo.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3072'
        ]);

        if ($request->hasFile('photo')) {
            $images = $request->file('photo');

            foreach ($images as $image) {
                $extension = $image->getClientOriginalExtension();
                $file_name = "kegiatan-" . $name . "-" . uniqid() . "." . $extension;

                $path = $image->storeAs('photo', $file_name, 'public');

                GalleryKegiatan::create([
                    'kegiatan_id' => $data['kegiatan_id'],
                    'photo' => $path
                ]);
            }
        }

        return redirect()->route('gallery-kegiatan.index');
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
        //
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
        //
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
        $gallery = GalleryKegiatan::findOrFail($id);
        Storage::disk('public')->delete($gallery->photo);
        $gallery->delete();

        return redirect()->route('gallery-kegiatan.index');
    }
}
