<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JabatanBidang;
use Illuminate\Http\Request;

class JabatanController extends BaseController
{
    public function index()
    {
        $jabatan = JabatanBidang::all();
        
        return $this->sendResponse($jabatan, 'Successfully get all jabatan');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        JabatanBidang::create($data);

        return $this->sendResponse($data, 'Successfully create jabatan');
    }

    public function edit($id)
    {
        $jabatan = JabatanBidang::findOrFail($id);

        return $this->sendResponse($jabatan, 'Successfully get data jabatan');
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $item = JabatanBidang::findOrFail($id);

        $item->update($data);

        return $this->sendResponse($data, 'Successfully update jabatan');
    }

    public function destroy($id)
    {
        $item = JabatanBidang::findOrFail($id);
        $item->delete();

        return $this->sendResponse($item, 'Successfully delete jabatan');
    }
}
