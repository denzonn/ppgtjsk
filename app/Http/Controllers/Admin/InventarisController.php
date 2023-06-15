<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inventaris;
use App\Models\JenisInventaris;
use Illuminate\Http\Request;

class InventarisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invertaris = Inventaris::all();

        return view('pages.admin.inventaris.index', [
            'inventaris' => $invertaris,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jenisInventaris = JenisInventaris::all();

        return view('pages.admin.inventaris.create', [
            'jenisInventaris' => $jenisInventaris,
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

        $this->validate($request, [
            'photo' => 'required|image|max:3072',
        ]);

        if ($request->hasFile('photo')) {
            $images = $request->file('photo');

            $extension = $images->getClientOriginalExtension();

            $file_name = "inventaris-" . $data['nama'] . "." . $extension;

            $data['photo'] = $images->storeAs('photo', $file_name, 'public');
        }

        Inventaris::create($data);

        return redirect()->route('inventaris.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $inventaris = Inventaris::findOrFail($id);

        $jenisInventaris = JenisInventaris::all()->except($inventaris->jenis_inventaris_id);

        $keterangan = [
            'Baik' => 'Baik',
            'Rusak' => 'Rusak',
            'Hilang' => 'Hilang',
        ];

        $keteranganNoChoose = array_diff($keterangan, [$inventaris->keterangan]);

        return view('pages.admin.inventaris.edit', [
            'inventaris' => $inventaris,
            'jenisInventaris' => $jenisInventaris,
            'keterangan' => $keterangan,
            'keteranganNoChoose' => $keteranganNoChoose,
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

            $file_name = "inventaris-" . $data['nama'] . "." . $extension;

            $data['photo'] = $images->storeAs('photo', $file_name, 'public');
        } else {
            unset($data['photo']);
        }

        $inventaris = Inventaris::findOrFail($id);

        $inventaris->update($data);

        return redirect()->route('inventaris.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Inventaris::findOrFail($id)->delete();

        return redirect()->route('inventaris.index');
    }

    public function print()
    {
        $inventaris = Inventaris::all();

        return view('pages.admin.inventaris.print', [
            'inventaris' => $inventaris,
        ]);
    }
}
