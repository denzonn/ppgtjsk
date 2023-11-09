<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Saran;
use Illuminate\Http\Request;

class SaranController extends BaseController
{
    public function index()
    {
        $saran = Saran::all();

        return $this->sendResponse($saran, 'Successfully get all saran');
    }
}
