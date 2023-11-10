<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Inventaris;
use App\Models\JenisInventaris;
use Illuminate\Http\Request;

class InventarisController extends BaseController
{
    public function index()
    {
        $inventaris = Inventaris::all();

        return $this->sendResponse($inventaris, 'Success get all invetaris');
    }

    public function create()
    {
        $jenisInventaris = JenisInventaris::all();

        return $this->sendResponse($jenisInventaris, 'Success get all jenis invetaris');
    }

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

        return $this->sendResponse($data, 'Success create invetaris');
    }

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

        $data = [
            'inventaris' => $inventaris,
            'jenisInventaris' => $jenisInventaris,
            'keterangan' => $keterangan,
            'keteranganNoChoose' => $keteranganNoChoose
        ];

        return $this->sendResponse($data, 'Success get invetaris');
    }

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

        return $this->sendResponse($data, 'Success update invetaris');
    }

    public function destroy($id)
    {
        $inventaris = Inventaris::findOrFail($id);
        $inventaris->delete();

        return $this->sendResponse($inventaris, 'Success delete invetaris');
    }
}
