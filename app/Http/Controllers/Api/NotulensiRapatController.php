<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\NotulensiRapat;
use Illuminate\Http\Request;

class NotulensiRapatController extends BaseController
{
    public function index()
    {
        $notulensi = NotulensiRapat::all();

        return $this->sendResponse($notulensi, 'Successfully get all Notulensi Rapat');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        if ($request->hasFile('file')) {
            $images = $request->file('file');

            $extension = $images->getClientOriginalExtension();

            $file_name = "notulensi-" . $data['judul'] . "." . $extension;

            $data['file'] = $images->storeAs('file', $file_name, 'public');
        }

        NotulensiRapat::create($data);

        return $this->sendResponse($data, 'Successfully create Notulensi Rapat');
    }

    public function edit($id)
    {
        $notulensi = NotulensiRapat::findOrFail($id);

        return $this->sendResponse($notulensi, 'Successfully get  Notulensi Rapat');
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        if ($request->hasFile('file')) {
            $images = $request->file('file');

            $extension = $images->getClientOriginalExtension();

            $file_name = "notulensi-" . $data['judul'] . "." . $extension;

            $data['file'] = $images->storeAs('file', $file_name, 'public');
        } else {
            unset($data['file']);
        }

        $notulen = NotulensiRapat::findOrFail($id);

        $notulen->update($data);

        return $this->sendResponse($data, 'Successfully update Notulensi Rapat');
    }

    public function destroy($id)
    {
        $notulensi = NotulensiRapat::findOrFail($id);

        $notulensi->delete();

        return $this->sendResponse($notulensi, 'Successfully delete Notulensi Rapat');
    }
}
