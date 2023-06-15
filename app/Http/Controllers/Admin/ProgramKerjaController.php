<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use App\Models\ProgramKerja;
use Illuminate\Http\Request;

class ProgramKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $program = ProgramKerja::all();

        return view('pages.admin.program-kerja.index', [
            'program' => $program
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bidang = Bidang::all();

        return view('pages.admin.program-kerja.create', [
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
        ProgramKerja::create([
            'name' => $request->name,
            'bidang_id' => $request->bidang_id,
            'description' => $request->description,
        ]);

        return redirect()->route('program-kerja.index');
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
        $program = ProgramKerja::findOrFail($id);

        return view('pages.admin.program-kerja.edit', [
            'program' => $program,
            'bidang' => Bidang::all()->except($program->bidang_id)
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
        ProgramKerja::findOrFail($id)->update([
            'name' => $request->name,
            'bidang_id' => $request->bidang_id,
            'description' => $request->description,
        ]);

        return redirect()->route('program-kerja.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProgramKerja::findOrFail($id)->delete();

        return redirect()->route('program-kerja.index');
    }
}
