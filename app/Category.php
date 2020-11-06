<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
    use NodeTrait;
    /**
     * 一个分类有多篇文章
     */
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
