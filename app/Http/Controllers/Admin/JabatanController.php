<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JabatanBidang;
use App\Models\Periode;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jabatan = JabatanBidang::all();
        return view('pages.admin.pengurus.jabatan.index', [
            'jabatan' => $jabatan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.pengurus.jabatan.create');
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

        JabatanBidang::create($data);

        return redirect()->route('jabatan.index');
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
        $jabatan = JabatanBidang::findOrFail($id);

        return view('pages.admin.pengurus.jabatan.edit', [
            'jabatan' => $jabatan
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

        $item = JabatanBidang::findOrFail($id);

        $item->update($data);

        return redirect()->route('jabatan.index');
    }

    public function salinFormat()
    {
        $aktif = Periode::aktif();
        $sebelumnya = $aktif?->sebelumnya();
        if (! $sebelumnya) {
            return back()->with('error', 'Tidak ada periode sebelumnya untuk disalin.');
        }
        if (JabatanBidang::exists()) {
            return back()->with('error', 'Daftar sudah berisi data, format tidak disalin.');
        }

        DB::transaction(function () use ($aktif, $sebelumnya) {
            JabatanBidang::withoutGlobalScope('periode')->where('periode_id', $sebelumnya->id)->get()->each(
                fn ($x) => JabatanBidang::create(['periode_id' => $aktif->id, 'nama_jabatan' => $x->nama_jabatan])
            );
        });

        return back()->with('success', 'Format periode sebelumnya berhasil disalin.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = JabatanBidang::findOrFail($id);
        $item->delete();

        return redirect()->route('jabatan.index');
    }
}
