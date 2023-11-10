<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\KsbRequest;
use App\Models\FotoKsb;
use Illuminate\Http\Request;

class FotoKsbController extends BaseController
{
    public function index(){
        $fotoKsb = FotoKsb::all();
        
        return $this->sendResponse($fotoKsb, 'Successfully get all Foto KSB');
    }
    public function edit($id){
        $fotoKsb = FotoKsb::findOrFail($id);
        
        return $this->sendResponse($fotoKsb, 'Successfully get all Foto KSB');
    }
    public function update(KsbRequest $request, $id){
        $data = $request->all();
        $fotoKsb = FotoKsb::findOrFail($id);

        if ($request->hasFile('foto')) {
            $images = $request->file('foto');

            $extension = $images->getClientOriginalExtension();

            $file_name = "foto-ksb" . $fotoKsb->jabatan . "." . $extension;

            $data['foto'] = $images->storeAs('assets/foto-ksb', $file_name, 'public');
        } else {
            unset($data['foto']);
        }

        $fotoKsb->update($data);
        
        return $this->sendResponse($fotoKsb, 'Successfully get all Foto KSB');
    }
}
