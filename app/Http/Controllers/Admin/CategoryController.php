<?php

namespace App\Http\Controllers\Admin;

use App\Cate;
use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCollection;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function info()
    {
        $categories = Category::withDepth()->get()->toFlatTree();
        return new CategoryCollection($categories);
    }

    public function getChildren(Cate $cate)
    {
        dump($cate->with('children.children.children')->get());
    }
    /**
     * 添加分类页面
     */
    public function create()
    {
//        $categories = Category::withDepth()->get()->toFlatTree();
        $categories = Category::get()->toTree();
        return view('admin.createCategory',compact('categories'));
    }
}
