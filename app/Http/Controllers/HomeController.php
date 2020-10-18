<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * 网站首页
     */
    public function index()
    {
        return view('home.index');
    }
}
