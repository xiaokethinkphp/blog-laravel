<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Mews\Captcha\Facades\Captcha;

class AdminController extends Controller
{
    public function login()
    {
        $captcha = Captcha::create('default', true);
        return view('admin.login',compact('captcha'));
    }
    public function checkLogin(LoginRequest $request)
    {
        return ['code'=>1];
    }

}
