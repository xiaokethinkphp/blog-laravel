<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /**
     * 一篇文章属于一个分类
     */
    public function cate()
    {
        return $this->belongsTo(Cate::class);
    }
}
