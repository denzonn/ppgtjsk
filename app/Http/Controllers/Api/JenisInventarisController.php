<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JenisInventaris;
use Illuminate\Http\Request;

class JenisInventarisController extends BaseController
{
    public function index()
    {
        $jenisInventaris = JenisInventaris::all();

        return $this->sendResponse($jenisInventaris, 'Successfully get all jenis inventaris');
    }

    public function store(Request $request)
    {
        $jenisInventaris = JenisInventaris::create([
            'nama' => $request->nama,
        ]);

        return $this->sendResponse($jenisInventaris, 'Successfully create jenis inventaris');
    }

    public function edit($id)
    {
        $jenisInventaris = JenisInventaris::findOrFail($id);

        return $this->sendResponse($jenisInventaris, 'Successfully get jenis inventaris');
    }

    public function update(Request $request, $id)
    {
        $jenisInventaris = JenisInventaris::findOrFail($id);
        $jenisInventaris->update([
            'nama' => $request->nama,
        ]);

        return $this->sendResponse($jenisInventaris, 'Successfully update jenis inventaris');
    }

    public function destroy($id)
    {
        $jenisInventaris = JenisInventaris::findOrFail($id);
        $jenisInventaris->delete();

        return $this->sendResponse($jenisInventaris, 'Successfully delete jenis inventaris');
    }
}
