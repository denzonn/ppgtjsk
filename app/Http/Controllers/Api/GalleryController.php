<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GalleryKegiatan;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends BaseController
{
    public function index()
    {
        $gallery = GalleryKegiatan::all();

        return $this->sendResponse($gallery, 'Success get all gallery');
    }

    public function create()
    {
        $kegiatan =  Kegiatan::all();

        return $this->sendResponse($kegiatan, 'Success get all kegiatan');
    }

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

                $data['photo'] = GalleryKegiatan::create([
                    'kegiatan_id' => $data['kegiatan_id'],
                    'photo' => $path
                ]);
            }
        }

        return $this->sendResponse($data, 'Success create gallery');
    }

    public function destroy($id)
    {
        // Delete photo
        $gallery = GalleryKegiatan::findOrFail($id);
        Storage::disk('public')->delete($gallery->photo);
        $gallery->delete();

        return $this->sendResponse($gallery, 'Success delete gallery');
    }
}
