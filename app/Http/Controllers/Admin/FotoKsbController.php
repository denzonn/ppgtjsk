<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\KsbRequest;
use App\Models\FotoKsb;
use Illuminate\Http\Request;

class FotoKsbController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = FotoKsb::all();
        return view('pages.admin.fotoksb.index', [
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $ksb = FotoKsb::findOrFail($id);

        return view('pages.admin.fotoksb.edit', [
            'ksb' => $ksb,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KsbRequest $request, $id)
    {
        $data = $request->all();
        $ksb = FotoKsb::findOrFail($id);

        if ($request->hasFile('foto')) {
            $images = $request->file('foto');

            $extension = $images->getClientOriginalExtension();

            $file_name = "foto-ksb" . $ksb->jabatan . "." . $extension;

            $data['foto'] = $images->storeAs('assets/foto-ksb', $file_name, 'public');
        } else {
            unset($data['foto']);
        }

        $ksb->update($data);

        return redirect()->route('foto-ksb.index')->with('success', 'Data KSB berhasil diubah!');;
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
}
