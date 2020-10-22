<?php

namespace App\Http\Controllers;

use App\Article;
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
     * 存储文章
     */
    public function store(Request $request)
    {
        $article = new Article();
        $article->title = $request->title;
        $article->user_id = auth()->id();
        $article->cate_id = $request->cate_id;
        $article->contents = $request->contents;
        $article->save();
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
