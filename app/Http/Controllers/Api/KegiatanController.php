<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\ProgramKerja;
use Illuminate\Http\Request;

class KegiatanController extends BaseController
{
    public function index()
    {
        $kegiatan = Kegiatan::all();

        return $this->sendResponse($kegiatan, 'Successfully get all kegiatan');
    }

    public function programKerja()
    {
        $program = ProgramKerja::all();

        return $this->sendResponse($program, 'Successfully get all program kerja');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $this->validate($request, [
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3072',
        ]);

        $data['slug'] = \Str::slug($request->name);

        if ($request->hasFile('photo')) {
            $images = $request->file('photo');

            $extension = $images->getClientOriginalExtension();

            $file_name = "kegiatan-" . $data['name'] . "." . $extension;

            $data['photo'] = $images->storeAs('photo', $file_name, 'public');
        }
        $data['bidang_id'] = ProgramKerja::findOrFail($request->program_id)->bidang_id;

        Kegiatan::create($data);

        return $this->sendResponse($data, 'Successfully create kegiatan');
    }

    public function edit($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        $program = ProgramKerja::all()->except($kegiatan->program_id);

        return $this->sendResponse($kegiatan, 'Successfully get  kegiatan');
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $data['slug'] = \Str::slug($request->name);

        if ($request->hasFile('photo')) {
            $images = $request->file('photo');

            $extension = $images->getClientOriginalExtension();

            $file_name = "kegiatan-" . $data['name'] . "." . $extension;

            $data['photo'] = $images->storeAs('photo', $file_name, 'public');
        } else {
            unset($data['photo']);
        }
        $data['bidang_id'] = ProgramKerja::findOrFail($request->program_id)->bidang_id;

        $kegiatan = Kegiatan::findOrFail($id);

        $kegiatan->update($data);

        return $this->sendResponse($kegiatan, 'Successfully update kegiatan');
    }

    public function destroy($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        $kegiatan->delete();

        return $this->sendResponse($kegiatan, 'Successfully delete kegiatan');
    }
}
