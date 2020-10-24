<?php

namespace App\Policies;

use App\Article;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Request;

class ArticlePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function lst(User $user)
    {
        $user_param = request()->route()->user;
            return $user_param == $user
                ? Response::allow()
                : Response::deny('无法查看其它用户信息');
    }

    public function write(User $user, Article $article)
    {
        $user_param = request()->route()->user;
        return ($user_param == $user && $user->id == $article->user_id)
            ? Response::allow()
                : Response::deny('无法操作该文章');
    }

}
