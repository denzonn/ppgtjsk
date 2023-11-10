<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Iuran;
use Illuminate\Http\Request;

class IuranController extends BaseController
{
    public function index()
    {
        $iuran = Iuran::all();

        return $this->sendResponse($iuran, 'Success get all iuran');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        Iuran::create($data);

        return $this->sendResponse($data, 'Success create iuran');
    }

    public function edit($id)
    {
        $iuran = Iuran::findOrFail($id);

        $keteranganOption = ['Januari', 'Januari-Februari', 'Januari-Maret', 'Januari-April', 'Januari-Mei', 'Januari-Juni', 'Januari-Juli', 'Januari-Agustus', 'Januari-September', 'Januari-Oktober', 'Januari-November', 'Januari-Desember'];

        $keteranganOptions = array_diff($keteranganOption, [$iuran->keterangan]);

        $data = [
            'iuran' => $iuran,
            'keteranganOptions' => $keteranganOptions,
        ];
        
        return $this->sendResponse($data, 'Success get iuran');
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $item = Iuran::findOrFail($id);

        $item->update($data);

        return $this->sendResponse($data, 'Success update iuran');
    }
}
