<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $articles = Article::with(['cate','user'])->paginate(4);
        return view('home.index',compact('articles'));
    }

    public function hd()
    {
        // 向父节点追加子节点
//        $it = Category::find(2);
//        $caiwu = new Category();
//        $caiwu->name = "财务";
//        $caiwu->save();
//        $it->appendNode($caiwu);
        // 向父节点前追加子节点
//        $yanfa = Category::find(1);
//        $vue = new Category();
//        $vue->name = "VUE";
//        $vue->save();
//        $yanfa->prependNode($vue);
        // 向兄弟前追加节点
//        $caiwu = Category::find(8);
//        $hr = new Category();
//        $hr->name = "人力";
//        $hr->save();
//        $hr->insertBeforeNode($caiwu);
        // 向兄弟后追加节点
//        $vue  = Category::find(9);
//        $js = new Category();
//        $js->name = "JS";
//        $js->save();
//        $js->insertAfterNode($vue);

        // 获取全部父类（不含自己）
//        $js = Category::find(11);
//        return $js->ancestors;
        // 获取全部子类（不含自己，没有层级关系）
//        $it = Category::find(2);
//        dump($it->descendants);
//        return $it->descendants;
//        return Category::defaultOrder()->descendantsOf(2);
//        $js = Category::find(11);
//        $js->down();
        $tree = Category::get()->toTree();
        return $tree;
    }

}
