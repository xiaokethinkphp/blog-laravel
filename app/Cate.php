<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{
    /**
     * 一个分类有多篇文章
     */
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
