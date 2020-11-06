<?php

namespace App\Http\Controllers;

use App\Article;
use App\Cate;
use App\Category;
use App\Http\Requests\ArticleRequest;
use App\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ArticleController extends Controller
{
    /**
     * 前台新增文章界面
     */
    public function create()
    {
        // $cates = Cate::all();
        $categories = Category::get()->toTree();
        return view('article.create',compact('categories'));
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
     * @return Factory|View
     * @throws AuthorizationException
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
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function edit(User $user, Article $article)
    {
        $this->authorize('write', $article);
        $categories = Category::get()->toTree();
        return view('article.edit', compact('article', 'categories'));
    }

    /**
     * 修改文章提交
     * @param ArticleRequest $request
     * @param User $user
     * @param Article $article
     * @return RedirectResponse|Redirector
     * @throws AuthorizationException
     */
    public function update(ArticleRequest $request, User $user, Article $article)
    {
        $this->authorize('write',$article);
        $article->title = $request->title;
        $article->user_id = auth()->id();
        $article->cate_id = $request->cate_id;
        $article->contents = $request->contents;
        $article->save();
        return redirect(route('index'));
    }

    /**
     * 删除文章
     * @param User $user
     * @param Article $article
     * @throws AuthorizationException
     */

    public function destroy(User $user, Article $article)
    {
        $this->authorize('write', $article);
        $article->delete();
    }

    /**
     * 文章详情
     * @param Article $article
     * @return Factory|View
     */
    public function show(Article $article)
    {
        $article->user;
        $article->cate;
        return view('article.show', compact('article'));
    }
}
