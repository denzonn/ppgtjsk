<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use Illuminate\Http\Request;

class BidangController extends BaseController
{
    public function index()
    {
        $bidang = Bidang::all();

        return $this->sendResponse($bidang, 'Successfully get all bidang');
    }

    public function store(Request $request)
    {
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

        return $this->sendResponse($data, 'Successfully create bidang');
    }

    public function edit($id)
    {
        $bidang = Bidang::findOrFail($id);

        return $this->sendResponse($bidang, 'Successfully get bidang');
    }

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

            $file_name = "foto_bidang" . $random . "." . $extension;  // Use $random for the file name.

            $data['foto_bidang'] = $images->storeAs('assets/foto_bidang', $file_name, 'public');
        } else {
            unset($data['foto_bidang']);
        }

        $bidang = Bidang::findOrFail($id);

        $bidang->update($data);

        return $this->sendResponse($bidang, 'Successfully update bidang');
    }

    public function destroy($id)
    {
        // Cari data berdasarkan id
        $bidang = Bidang::findOrFail($id);

        // Hapus data
        $bidang->delete();

        return $this->sendResponse($bidang, 'Successfully delete bidang');
    }
}
