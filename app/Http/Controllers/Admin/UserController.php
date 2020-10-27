<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function info()
    {
        $users = User::paginate(9)->toArray();
        $users['status'] = 0;
        $users['message']   =   'ok';
        return $users;
    }
}
