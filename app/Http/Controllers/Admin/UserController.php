<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function info()
    {
        $users = User::all();
        return [
            'code'  =>  0,
            'msg'   =>  '',
            'data'  =>  $users
        ];
    }
}
