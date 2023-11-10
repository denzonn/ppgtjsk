<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    public function index() {
        $user = User::all();

        return $this->sendResponse($user, 'Get data user successfully.');
    }
}
