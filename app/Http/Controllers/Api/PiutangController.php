<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PiutangKeuangan;
use Illuminate\Http\Request;

class PiutangController extends BaseController
{
    public function index()
    {
        $piutang = PiutangKeuangan::all();

        return $this->sendResponse($piutang, 'Successfully get all piutang');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        if ($request->hasFile('photo')) {
            $images = $request->file('photo');

            $extension = $images->getClientOriginalExtension();

            // Buatkan str keterangan
            $str = \Str::slug($data['keterangan']);

            $file_name = "piutang" . $str . "." . $extension;

            $data['photo'] = $images->storeAs('assets/keuangan/piutang', $file_name, 'public');
        } else {
            $data['photo'] = asset('images/nodata.jpg');
        }

        $data['status'] = 'Belum Lunas';

        PiutangKeuangan::create($data);

        return $this->sendResponse($data, 'Successfully create piutang');
    }

    public function edit($id)
    {
        $piutang = PiutangKeuangan::findOrFail($id);

        return $this->sendResponse($piutang, 'Successfully get piutang');
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        if ($request->hasFile('photo')) {
            $images = $request->file('photo');

            $extension = $images->getClientOriginalExtension();

            // Buatkan str keterangan
            $str = \Str::slug($data['keterangan']);

            $file_name = "piutang" . $str . "." . $extension;

            $data['photo'] = $images->storeAs('assets/keuangan/piutang', $file_name, 'public');
        } else {
            unset($data['photo']);
        }

        $item = PiutangKeuangan::findOrFail($id);

        $item->update($data);

        return $this->sendResponse($data, 'Successfully update piutang');
    }
}
