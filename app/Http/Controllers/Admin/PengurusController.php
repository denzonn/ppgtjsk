<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnggotaBidang;
use App\Models\Bidang;
use App\Models\JabatanBidang;
use Illuminate\Http\Request;

class PengurusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengurus = AnggotaBidang::all();

        return view('pages.admin.pengurus.index', [
            'pengurus' => $pengurus,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jabatan = JabatanBidang::all();
        $bidang = Bidang::all();

        return view('pages.admin.pengurus.pengurus.create', [
            'jabatan' => $jabatan,
            'bidang' => $bidang
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
        $this->validate($request, [
            'foto' => 'required|image|mimes:png,jpg,svg,jpeg|max:5120',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $images = $request->file('foto');

            $extension = $images->getClientOriginalExtension();

            $file_name = "foto-pengurus" . $data['nama_anggota'] . "." . $extension;

            $data['foto'] = $images->storeAs('assets/foto-pengurus', $file_name, 'public');
        }

        AnggotaBidang::create($data);

        return redirect()->route('pengurus.index');
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
        $pengurus = AnggotaBidang::findOrFail($id);

        $jabatan = JabatanBidang::all()->except($pengurus->jabatans_id);

        $bidang = Bidang::all()->except($pengurus->bidangs_id);

        return view('pages.admin.pengurus.pengurus.edit', [
            'pengurus' => $pengurus,
            'jabatan' => $jabatan,
            'bidang' => $bidang
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
        $this->validate($request, [
            'foto' => 'image|mimes:png,jpg,svg,jpeg|max:5120',
        ]);

        $data = $request->all();

        $pengurus = AnggotaBidang::findOrFail($id);

        if ($request->hasFile('foto')) {
            $images = $request->file('foto');

            $extension = $images->getClientOriginalExtension();

            $file_name = "foto-pengurus" . $data['nama_anggota'] . "." . $extension;

            $data['foto'] = $images->storeAs('assets/foto-pengurus', $file_name, 'public');
        } else {
            unset($data['foto']);
        }

        $pengurus->update($data);

        return redirect()->route('pengurus.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pengurus = AnggotaBidang::findOrFail($id);

        $pengurus->delete();

        return redirect()->route('pengurus.index');
    }
}
