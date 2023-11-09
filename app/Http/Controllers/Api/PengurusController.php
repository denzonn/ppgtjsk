<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AnggotaBidang;
use App\Models\Bidang;
use App\Models\JabatanBidang;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class PengurusController extends BaseController
{
    public function index()
    {
        $pengurus = AnggotaBidang::all();

        return $this->sendResponse($pengurus, 'Successfully get all pengurus');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'foto' => 'required|image|mimes:png,jpg,svg,jpeg|max:5120',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $images = $request->file('foto');

            $extension = $images->getClientOriginalExtension();

            $file_name = "foto-pengurus" . $data['nama_anggota'] . "." . $extension;

            $data['foto'] = $images->storeAs('assets/foto-pengurus', $file_name, 'public');
        }

        AnggotaBidang::create($data);

        return $this->sendResponse($data, 'Successfully create pengurus');
    }

    public function edit($id)
    {
        $pengurus = AnggotaBidang::findOrFail($id);

        return $this->sendResponse($pengurus, 'Successfully get pengurus');
    }

    public function getJabatan($id) {
        $pengurus = AnggotaBidang::findOrFail($id);

        $jabatan = JabatanBidang::all()->except($pengurus->jabatans_id);

        return $this->sendResponse($jabatan, 'Successfully get jabatan except choose data');
    }

    public function getBidang($id) {
        $pengurus = AnggotaBidang::findOrFail($id);

        $bidang = Bidang::all()->except($pengurus->bidangs_id);

        return $this->sendResponse($bidang, 'Successfully get bidang except choose data');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'foto' => 'image|mimes:png,jpg,svg,jpeg|max:5120',
        ]);

        $data = $request->all();

        $pengurus = AnggotaBidang::findOrFail($id);

        if ($request->hasFile('foto')) {
            $images = $request->file('foto');

            $extension = $images->getClientOriginalExtension();

            $file_name = "foto-pengurus" . $data['nama_anggota'] . "." . $extension;

            $data['foto'] = $images->storeAs('assets/foto-pengurus', $file_name, 'public');
        } else {
            unset($data['foto']);
        }

        $pengurus->update($data);

        return $this->sendResponse($pengurus, 'Successfully update pengurus');
    }

    public function destroy($id)
    {
        $pengurus = AnggotaBidang::findOrFail($id);

        $pengurus->delete();

        return $this->sendResponse($pengurus, 'Successfully delete pengurus');
    }
}
