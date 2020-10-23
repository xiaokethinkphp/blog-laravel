<?php

namespace App\Providers;

use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('lst', function ($user) {
            $user_param = request()->route()->user;
            return $user_param == $user
                ? Response::allow()
                : Response::deny('无法查看其它用户信息');
        });

        Gate::define('edit-or-destroy', function ($user) {
            $user_param = request()->route()->user;
            $article_param = request()->route()->article;
            return ($user == $user_param && $user->id == $article_param->user_id)
                ? Response::allow()
                : Response::deny('无法操作该文章');
        });
        //
    }
}
