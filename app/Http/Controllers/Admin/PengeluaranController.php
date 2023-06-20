<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengeluaranKeuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengeluaran = PengeluaranKeuangan::all();

        return view('pages.admin.keuangan.pengeluaran.index', [
            'pengeluaran' => $pengeluaran
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.keuangan.pengeluaran.create');
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

            // Buatkan str nama
            $str = \Str::slug($data['keterangan']);

            $file_name = "slip-keluar" . $str . "." . $extension;

            $data['photo'] = $images->storeAs('assets/keuangan/pengeluaran', $file_name, 'public');
        } else {
            $data['photo'] = asset('images/nodata.jpg');
        }

        PengeluaranKeuangan::create($data);

        return redirect()->route('pengeluaran.index');
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
        $pengeluaran = PengeluaranKeuangan::findOrFail($id);

        return view('pages.admin.keuangan.pengeluaran.edit', [
            'pengeluaran' => $pengeluaran
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
        $item = PengeluaranKeuangan::findOrFail($id);


        if ($request->hasFile('photo')) {
            //Hapus foto lama
            Storage::disk('local')->delete('public/' . $item->photo);

            $images = $request->file('photo');

            $extension = $images->getClientOriginalExtension();

            // Buatkan str nama
            $str = \Str::slug($data['keterangan']);

            $file_name = "slip-keluar" . $str . "." . $extension;

            $data['photo'] = $images->storeAs('assets/keuangan/pengeluaran', $file_name, 'public');
        } else {
            unset($data['photo']);
        }
        $item->update($data);

        return redirect()->route('pengeluaran.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pengeluaran =  PengeluaranKeuangan::findOrFail($id);

        $pengeluaran->delete();

        return redirect()->route('pengeluaran.index');
    }
}
