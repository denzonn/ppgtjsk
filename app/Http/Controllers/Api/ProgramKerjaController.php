<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use App\Models\ProgramKerja;
use Illuminate\Http\Request;

class ProgramKerjaController extends BaseController
{
    public function index()
    {
        $program = ProgramKerja::all();

        return $this->sendResponse($program, 'Successfully get all program kerja');
    }

    public function getBidang()
    {
        $bidang = Bidang::all();

        return $this->sendResponse($bidang, 'Successfully get bidang');
    }

    public function store(Request $request)
    {
        $program = ProgramKerja::create([
            'name' => $request->name,
            'bidang_id' => $request->bidang_id,
            'description' => $request->description,
        ]);

        return $this->sendResponse($program, 'Successfully create program kerja');
    }

    public function edit($id)
    {
        $program = ProgramKerja::findOrFail($id);

        return $this->sendResponse($program, 'Successfully get program kerja');
    }

    public function getBidangExcept($id)
    {
        $program = ProgramKerja::findOrFail($id);
        $bidang = Bidang::all()->except($program->bidang_id);

        return $this->sendResponse($bidang, 'Successfully get bidang');
    }

    public function update(Request $request, $id)
    {
        $program = ProgramKerja::findOrFail($id);
        
        $program->update([
            'name' => $request->name,
            'bidang_id' => $request->bidang_id,
            'description' => $request->description,
        ]);

        return $this->sendResponse($program, 'Successfully update program kerja');
    }

    public function destroy($id)
    {
        $program = ProgramKerja::findOrFail($id);
        
        $program->delete();

        return $this->sendResponse($program, 'Successfully delete program kerja');
    }
}
