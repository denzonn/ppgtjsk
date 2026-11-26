<?php

namespace App\Http\Controllers\Admin;

use App\Casts\PublicUrl;
use App\Http\Controllers\Controller;
use App\Models\SiteImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiteImageController extends Controller
{
    public function index()
    {
        return view('pages.admin.site-image.index', [
            'slots' => SiteImage::SLOTS,
            'uploaded' => SiteImage::pluck('updated_at', 'key'),
        ]);
    }

    public function update(Request $request, string $key)
    {
        abort_unless(isset(SiteImage::SLOTS[$key]), 404);

        $label = SiteImage::SLOTS[$key][0];
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:10240',
        ], [
            'image.required' => "$label: pilih gambar dulu.",
            'image.uploaded' => "$label gagal diunggah. Ukurannya kemungkinan melebihi batas upload server (upload_max_filesize).",
            'image.image' => "$label harus berupa gambar.",
            'image.mimes' => "$label harus berformat JPG, PNG, atau WEBP.",
            'image.max' => "$label terlalu besar, maksimal 10 MB.",
        ]);

        $image = SiteImage::firstOrNew(['key' => $key]);
        $old = $image->getRawOriginal('path');
        $image->path = $request->file('image')->store('site-images', 'public');
        $image->save();

        if ($old) {
            Storage::disk('public')->delete(PublicUrl::toPath($old));
        }

        return back()->with('success', SiteImage::SLOTS[$key][0] . ' berhasil diganti');
    }

    public function destroy(string $key)
    {
        $image = SiteImage::where('key', $key)->firstOrFail();
        Storage::disk('public')->delete(PublicUrl::toPath($image->getRawOriginal('path')));
        $image->delete();

        return back()->with('success', SiteImage::SLOTS[$key][0] . ' dikembalikan ke gambar bawaan');
    }
}
