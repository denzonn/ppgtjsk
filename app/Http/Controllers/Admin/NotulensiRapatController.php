<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NotulensiRapat;
use Illuminate\Http\Request;

class NotulensiRapatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notulensi = NotulensiRapat::all();

        return view('pages.admin.notulensi.index', [
            'notulensi' => $notulensi,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.notulensi.create');
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

        if ($request->hasFile('file')) {
            $images = $request->file('file');

            $extension = $images->getClientOriginalExtension();

            $file_name = "notulensi-" . $data['judul'] . "." . $extension;

            $data['file'] = $images->storeAs('file', $file_name, 'public');
        }

        NotulensiRapat::create($data);

        return redirect()->route('notulensi-rapat.index');
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
        $notulen = NotulensiRapat::findOrFail($id);

        return view('pages.admin.notulensi.edit', [
            'notulen' => $notulen,
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

        if ($request->hasFile('file')) {
            $images = $request->file('file');

            $extension = $images->getClientOriginalExtension();

            $file_name = "notulensi-" . $data['judul'] . "." . $extension;

            $data['file'] = $images->storeAs('file', $file_name, 'public');
        } else {
            unset($data['file']);
        }

        $notulen = NotulensiRapat::findOrFail($id);

        $notulen->update($data);

        return redirect()->route('notulensi-rapat.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notulen = NotulensiRapat::findOrFail($id);

        $notulen->delete();

        return redirect()->route('notulensi-rapat.index');
    }
}
