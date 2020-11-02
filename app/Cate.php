<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{
//    protected $with = ['children'];
    /**
     * 一个分类有多篇文章
     */
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
    /**
     * 无限级分类自关联
     */
    public function children()
    {
        return $this->hasMany(Cate::class, 'parent_id', 'id');
    }
}
