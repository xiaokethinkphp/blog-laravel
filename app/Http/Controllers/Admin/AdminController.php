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
        $credentials = request(['name', 'password']);

        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

}
