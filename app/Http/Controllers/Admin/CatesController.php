<?php

namespace App\Http\Controllers\Admin;

use App\Cate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CatesController extends Controller
{
    public function info()
    {
        $cates = Cate::paginate(15);
        $cates = $cates->toArray();
        $cates['status'] = 0;
        $cates['message']  = 'ok';
        return $cates;
    }
}
