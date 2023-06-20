<?php

namespace App\Http\Controllers;

use App\Models\Iuran;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $iuran = Iuran::all();

        return view('pages.member', [
            'iuran' => $iuran
        ]);
    }
}
