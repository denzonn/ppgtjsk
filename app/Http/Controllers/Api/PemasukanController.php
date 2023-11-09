<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PemasukanKeuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PemasukanController extends BaseController
{
    public function index()
    {
        $pemasukan = PemasukanKeuangan::all();

        return $this->sendResponse($pemasukan, 'Successfully get all Pemasukan');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        if ($request->hasFile('photo')) {
            $images = $request->file('photo');

            $extension = $images->getClientOriginalExtension();

            // Buatkan str nama
            $str = \Str::slug($data['keterangan']);

            $file_name = "slip-masuk" . $str . "." . $extension;

            $data['photo'] = $images->storeAs('assets/keuangan/pemasukan', $file_name, 'public');
        } else {
            $data['photo'] = asset('images/nodata.jpg');
        }

        PemasukanKeuangan::create($data);

        return $this->sendResponse($data, 'Successfully create Pemasukan');
    }

    public function edit($id)
    {
        $pemasukan = PemasukanKeuangan::findOrFail($id);

        return $this->sendResponse($pemasukan, 'Successfully get Pemasukan');
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $item = PemasukanKeuangan::findOrFail($id);


        if ($request->hasFile('photo')) {
            //Hapus foto lama
            Storage::disk('local')->delete('public/' . $item->photo);

            $images = $request->file('photo');

            $extension = $images->getClientOriginalExtension();

            // Buatkan str nama
            $str = \Str::slug($data['keterangan']);

            $file_name = "slip-masuk" . $str . "." . $extension;

            $data['photo'] = $images->storeAs('assets/keuangan/pemasukan', $file_name, 'public');
        } else {
            unset($data['photo']);
        }
        $item->update($data);

        return $this->sendResponse($data, 'Successfully update Pemasukan');
    }

    public function destroy($id)
    {
        $pemasukan = PemasukanKeuangan::findOrFail($id);

        $pemasukan->delete();

        return $this->sendResponse($pemasukan, 'Successfully delete Pemasukan');
    }

}
