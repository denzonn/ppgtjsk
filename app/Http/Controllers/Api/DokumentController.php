<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dokument;
use Illuminate\Http\Request;

class DokumentController extends BaseController
{
    public function index()
    {
        $dokumen = Dokument::all();

        return $this->sendResponse($dokumen, 'Successfully get all dokument');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $this->validate($request, [
            'file' => 'required|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt|max:10000',
        ]);

        if ($request->hasFile('file')) {
            $images = $request->file('file');

            $extension = $images->getClientOriginalExtension();

            $file_name = "dokumen-" . $data['judul'] . "." . $extension;

            $data['file'] = $images->storeAs('file', $file_name, 'public');
        }

        Dokument::create($data);

        return $this->sendResponse($data, 'Successfully create dokument');
    }

    public function edit($id)
    {
        $dokumen = Dokument::findOrFail($id);

        return $this->sendResponse($dokumen, 'Successfully get  dokument');
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        if ($request->hasFile('file')) {
            $images = $request->file('file');

            $extension = $images->getClientOriginalExtension();

            $file_name = "dokumen-" . $data['judul'] . "." . $extension;

            $data['file'] = $images->storeAs('file', $file_name, 'public');
        } else {
            unset($data['file']);
        }

        $document = Dokument::findOrFail($id);

        $document->update($data);

        return $this->sendResponse($document, 'Successfully update dokument');
    }

    public function destroy($id)
    {
        $dokumen = Dokument::findOrFail($id);
        $dokumen->delete();

        return $this->sendResponse($dokumen, 'Successfully delete dokument');
    }
}
