<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\KegiatanMingguan;
use Illuminate\Http\Request;

class KegiatanMingguanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kegiatan = KegiatanMingguan::all();

        return view('pages.admin.kegiatan_mingguan.index', [
            'kegiatan' => $kegiatan,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kegiatan = Kegiatan::all();

        return view('pages.admin.kegiatan_mingguan.create', [
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

        KegiatanMingguan::create($data);

        return redirect()->route('kegiatan-mingguan.index');
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
        $kegiatanMingguan = KegiatanMingguan::findOrFail($id);

        $kegiatan = Kegiatan::all()->except($kegiatanMingguan->kegiatan_id);

        return view('pages.admin.kegiatan_mingguan.edit', [
            'kegiatanMingguan' => $kegiatanMingguan,
            'kegiatan' => $kegiatan,
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

        KegiatanMingguan::findOrFail($id)->update($data);

        return redirect()->route('kegiatan-mingguan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        KegiatanMingguan::findOrFail($id)->delete();

        return redirect()->route('kegiatan-mingguan.index');
    }
}
