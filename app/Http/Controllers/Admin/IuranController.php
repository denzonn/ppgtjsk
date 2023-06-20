<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Iuran;
use Illuminate\Http\Request;

class IuranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $iuran = Iuran::all();

        return view('pages.admin.iuran.index', [
            'iuran' => $iuran,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.iuran.create');
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

        Iuran::create($data);

        return redirect()->route('iuran.index');
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
        $iuran = Iuran::findOrFail($id);

        $keteranganOption = ['Januari', 'Januari-Februari', 'Januari-Maret', 'Januari-April', 'Januari-Mei', 'Januari-Juni', 'Januari-Juli', 'Januari-Agustus', 'Januari-September', 'Januari-Oktober', 'Januari-November', 'Januari-Desember'];

        $keteranganOptions = array_diff($keteranganOption, [$iuran->keterangan]);

        return view('pages.admin.iuran.edit', [
            'iuran' => $iuran,
            'keteranganOptions' => $keteranganOptions,
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

        $item = Iuran::findOrFail($id);

        $item->update($data);

        return redirect()->route('iuran.index');
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
