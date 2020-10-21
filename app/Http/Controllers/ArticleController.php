<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * 前台新增文章界面
     */
    public function create()
    {
        return view('article.create');
    }
}
