<?php

namespace App\Http\Controllers\Admin;

use App\Casts\PublicUrl;

use App\Http\Controllers\Controller;
use App\Models\Admin\Profil;
use App\Models\Periode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profil = Profil::with('periodeKepengurusan')->get()
            ->sortByDesc(fn ($p) => $p->periodeKepengurusan?->tahun_mulai)->values();

        return view('pages.admin.profil.index', [
            'profil' => $profil
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.profil.create', [
            'periodes' => Periode::orderByDesc('tahun_mulai')->get()
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
        $request->validate(['periode_id' => 'required|exists:periodes,id']);
        $data = $request->all();

        if ($request->hasFile('photo')) {
            $images = $request->file('photo');

            $extension = $images->getClientOriginalExtension();

            $file_name = "periode-" . Periode::find($data['periode_id'])->label() . "." . $extension;

            $data['photo'] = $images->storeAs('photo', $file_name, 'public');
        }

        Profil::create($data);

        return redirect()->route('profil-ppgt.index');
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
        $profil = Profil::findOrFail($id);

        return view('pages.admin.profil.edit', [
            'profil' => $profil,
            'periodes' => Periode::orderByDesc('tahun_mulai')->get()
        ]);
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
        $request->validate(['periode_id' => 'required|exists:periodes,id']);
        $data = $request->all();
        $profil = Profil::findOrFail($id);

        if ($request->hasFile('photo')) {
            if($profil->photo){
                Storage::disk('public')->delete(PublicUrl::toPath($profil->getRawOriginal('photo')));
            }

            $images = $request->file('photo');

            $extension = $images->getClientOriginalExtension();

            $file_name = "periode-" . Periode::find($data['periode_id'])->label() . "." . $extension;

            $data['photo'] = $images->storeAs('photo', $file_name, 'public');
        }else {
            unset($data['photo']);
        }

        $profil->update($data);

        return redirect()->route('profil-ppgt.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function  uploadImage()
    {
        // Code upload here
        $post = new Profil();
        $post->id = 0;
        $post->exists = true;

        $images = $post->addMediaFromRequest('upload')->toMediaCollection('images');

        return response()->json([
            'url' => $images->getUrl(),
        ]);
    }
}
