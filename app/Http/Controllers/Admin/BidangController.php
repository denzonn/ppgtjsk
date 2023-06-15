<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use Illuminate\Http\Request;

class BidangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bidang = Bidang::all();

        return view('pages.admin.pengurus.bidang.index', [
            'bidang' => $bidang
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.pengurus.bidang.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validasi 
        $this->validate($request, [
            'foto_bidang' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120'
        ]);

        $data = $request->all();

        if ($request->hasFile('foto_bidang')) {
            $images = $request->file('foto_bidang');

            $extension = $images->getClientOriginalExtension();

            $random = mt_rand(100, 999);

            $file_name = "foto_bidang" . $random . "." . $extension;

            $data['foto_bidang'] = $images->storeAs('assets/foto_bidang', $file_name, 'public');
        }

        Bidang::create($data);

        return redirect()->route('bidang.index');
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
        $bidang = Bidang::findOrFail($id);

        return view('pages.admin.pengurus.bidang.edit', [
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
        //Validasi 
        $this->validate($request, [
            'foto_bidang' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120'
        ]);

        $data = $request->all();

        if ($request->hasFile('foto_bidang')) {
            $images = $request->file('foto_bidang');

            $extension = $images->getClientOriginalExtension();

            $random = mt_rand(100, 999);

            $file_name = "foto_bidang" . $data['foto_bidang'] . "." . $extension;

            $data['foto_bidang'] = $images->storeAs('assets/foto_bidang', $file_name, 'public');
        } else {
            unset($data['foto_bidang']);
        }

        $bidang = Bidang::findOrFail($id);

        $bidang->update($data);

        return redirect()->route('bidang.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Cari data berdasarkan id
        $bidang = Bidang::findOrFail($id);

        // Hapus data
        $bidang->delete();

        return redirect()->route('bidang.index');
    }
}
