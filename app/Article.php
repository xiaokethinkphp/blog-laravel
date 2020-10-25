<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;
    /**
     * 一篇文章属于一个分类
     */
    public function cate()
    {
        return $this->belongsTo(Cate::class);
    }
    /**
     * 一篇文章属于一个用户
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
