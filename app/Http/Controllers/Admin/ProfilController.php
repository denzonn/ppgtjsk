<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Profil;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profil = Profil::all();

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
        return view('pages.admin.profil.create');
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

        if ($request->hasFile('photo')) {
            $images = $request->file('photo');

            $extension = $images->getClientOriginalExtension();

            $file_name = "periode-" . $data['periode'] . "." . $extension;

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
            'profil' => $profil
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
        $data = $request->all();

        if ($request->hasFile('photo')) {
            $images = $request->file('photo');

            $extension = $images->getClientOriginalExtension();

            $file_name = "periode-" . $data['periode'] . "." . $extension;

            $data['photo'] = $images->storeAs('photo', $file_name, 'public');
        }else {
            unset($data['photo']);
        }

        $profil = Profil::findOrFail($id);

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
