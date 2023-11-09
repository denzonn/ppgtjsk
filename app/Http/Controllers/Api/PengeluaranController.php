<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PengeluaranKeuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengeluaranController extends BaseController
{
    public function index()
    {
        $pengeluaran = PengeluaranKeuangan::all();

        return $this->sendResponse($pengeluaran, 'Successfully get all pengeluaran');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        if ($request->hasFile('photo')) {
            $images = $request->file('photo');

            $extension = $images->getClientOriginalExtension();

            // Buatkan str nama
            $str = \Str::slug($data['keterangan']);

            $file_name = "slip-keluar" . $str . "." . $extension;

            $data['photo'] = $images->storeAs('assets/keuangan/pengeluaran', $file_name, 'public');
        } else {
            $data['photo'] = asset('images/nodata.jpg');
        }

        PengeluaranKeuangan::create($data);

        return $this->sendResponse($data, 'Successfully create pengeluaran');
    }

    public function edit($id)
    {
        $pengeluaran = PengeluaranKeuangan::findOrFail($id);

        return $this->sendResponse($pengeluaran, 'Successfully get pengeluaran');
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $item = PengeluaranKeuangan::findOrFail($id);


        if ($request->hasFile('photo')) {
            //Hapus foto lama
            Storage::disk('local')->delete('public/' . $item->photo);

            $images = $request->file('photo');

            $extension = $images->getClientOriginalExtension();

            // Buatkan str nama
            $str = \Str::slug($data['keterangan']);

            $file_name = "slip-keluar" . $str . "." . $extension;

            $data['photo'] = $images->storeAs('assets/keuangan/pengeluaran', $file_name, 'public');
        } else {
            unset($data['photo']);
        }
        $item->update($data);

        return $this->sendResponse($data, 'Successfully update pengeluaran');
    }

    public function destroy($id)
    {
        $pengeluaran =  PengeluaranKeuangan::findOrFail($id);

        $pengeluaran->delete();

        return $this->sendResponse($pengeluaran, 'Successfully delete pengeluaran');
    }
}
