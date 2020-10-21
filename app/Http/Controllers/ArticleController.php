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

    /**
     * 接受富文编辑器图片上传
     */
    public function upload(Request $request)
    {
        $urls = [];

        foreach ($request->file() as $file) {
            $urls[] = Storage::url($file->store('article', 'public'));
        }
        return [
            'errno' =>  0,
            'data'  =>  $urls
        ];
    }
}
