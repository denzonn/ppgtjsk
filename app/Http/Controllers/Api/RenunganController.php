<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RenunganHarian;
use Illuminate\Http\Request;

class RenunganController extends BaseController
{
    public function index(){
        $renungan = RenunganHarian::all();

        return $this->sendResponse($renungan, 'Success get renungan');
    }

    public function edit($id)
    {
        $renungan = RenunganHarian::findOrFail($id);

        return $this->sendResponse($renungan, 'Success get edit data renungan');
    }

    public function update(Request $request, $id)
    {
        $data = RenunganHarian::findOrFail($id);
        $renungan = $request->all();

        $data->update($renungan);

        return $this->sendResponse($renungan, 'Success update data renungan');
    }
}
