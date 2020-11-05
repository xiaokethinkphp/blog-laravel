<?php

namespace App\Http\Controllers\Admin;

use App\Cate;
use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCollection;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

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
    /**
     * 添加分类表单提交
     */
    public function store(Request $request)
    {
        $category = new Category;
        $category->name = $request->name;
        if ($request->parent_id)$category->parent_id = $request->parent_id;
        $category->save();
    }

    /**
     * 修改分类页面
     * @param Request $request
     * @param Category $category
     * @return Factory|View
     */
    public function edit(Request $request, Category $category)
    {
        $parent = $category->ancestors()->first();
        return view('admin.editCategory',compact('parent','category'));
    }

    /**
     * 修改分类提交
     * @param Request $request
     * @param Category $category
     */
    public function update(Request $request, Category $category)
    {
        $category->name = $request->name;
        $category->save();
    }
}
