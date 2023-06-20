<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PiutangKeuangan;
use Illuminate\Http\Request;

class PiutangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $piutang = PiutangKeuangan::all();

        return view('pages.admin.keuangan.piutang.index', [
            'piutang' => $piutang
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.keuangan.piutang.create');
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

            // Buatkan str keterangan
            $str = \Str::slug($data['keterangan']);

            $file_name = "piutang" . $str . "." . $extension;

            $data['photo'] = $images->storeAs('assets/keuangan/piutang', $file_name, 'public');
        } else {
            $data['photo'] = asset('images/nodata.jpg');
        }

        $data['status'] = 'Belum Lunas';

        PiutangKeuangan::create($data);

        return redirect()->route('piutang.index');
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
        $piutang = PiutangKeuangan::findOrFail($id);

        return view('pages.admin.keuangan.piutang.edit', [
            'piutang' => $piutang
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

            // Buatkan str keterangan
            $str = \Str::slug($data['keterangan']);

            $file_name = "piutang" . $str . "." . $extension;

            $data['photo'] = $images->storeAs('assets/keuangan/piutang', $file_name, 'public');
        } else {
            unset($data['photo']);
        }

        $item = PiutangKeuangan::findOrFail($id);

        $item->update($data);

        return redirect()->route('piutang.index');
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
