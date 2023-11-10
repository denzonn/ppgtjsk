<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin\Profil;
use Illuminate\Http\Request;

class ProfilController extends BaseController
{
    public function index()
    {
        $profil = Profil::all();

        return $this->sendResponse($profil, 'Successfully get all profil');
    }

    public function edit($id)
    {
        $profil = Profil::findOrFail($id);

        return $this->sendResponse($profil, 'Successfully get profil');
    }

    public function update(Request $request, $id)
    {
        $profil = Profil::findOrFail($id);
        $profil->update([
            'content' => $request->content,
        ]);

        return $this->sendResponse($profil, 'Successfully update profil');
    }
}
