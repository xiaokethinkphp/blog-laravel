<?php

namespace App\Http\Controllers;

use App\Article;
use App\Cate;
use App\Http\Requests\ArticleRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * 前台新增文章界面
     */
    public function create()
    {
        $cates = Cate::all();
        return view('article.create',compact('cates'));
    }

    /**
     * 存储文章
     * @param ArticleRequest $request
     * @return RedirectResponse|Redirector
     */
    public function store(ArticleRequest $request)
    {
        $article = new Article();
        $article->title = $request->title;
        $article->user_id = auth()->id();
        $article->cate_id = $request->cate_id;
        $article->contents = $request->contents;
        $article->save();
        return redirect(route('index'));
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

    /**
     * 个人文章列表
     * @param $user_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function lst($user_id)
    {
        $articles = Article::where('user_id', $user_id)->with('cate:id,name')->paginate();
        return view('article.lst', compact('articles'));
    }

    /**
     * 修改文章界面
     * @param $user_id
     * @param $id
     */
    public function edit($user_id, $id)
    {
        dump($user_id.'****************'.$id);
    }
}
