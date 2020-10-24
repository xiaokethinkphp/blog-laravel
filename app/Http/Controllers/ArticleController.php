<?php

namespace App\Http\Controllers;

use App\Article;
use App\Cate;
use App\Http\Requests\ArticleRequest;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Gate;
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
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function lst(User $user)
    {
        $this->authorize('lst', Article::class);
//        if (Gate::authorize('lst')) {
            $articles = $user->articles()->paginate();
            return view('article.lst', compact('articles'));
//        }
    }

    /**
     * 修改文章界面
     * @param $user
     * @param $article
     */
    public function edit(User $user, Article $article)
    {
        $this->authorize('editOrDestroy', $article);
    }

    public function destory(User $user, Article $article)
    {

    }
}
