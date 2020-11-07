<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
    use NodeTrait;
    use SoftDeletes;
    /**
     * 一个分类有多篇文章
     */
    public function articles()
    {
        return $this->hasMany(Article::class,'cate_id');
    }

    /**
     * 删除单个分类
     * @param Category $category
     * @throws \Exception
     */
    public function deleteOne(Category $category)
    {
        // 删除分类下的文章
        $category->articles()->delete();
        // 删除该分类
        $category->delete();
    }
}
