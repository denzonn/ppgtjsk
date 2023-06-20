<?php

namespace App\Http\Controllers;

use App\Models\Admin\Profil;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function index()
    {
        $profil = Profil::all();

        return view('pages.profil', [
            'profil' => $profil
        ]);
    }
}
