<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use app\Models\User;
use Illuminate\Support\Facades\Auth;


class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        // 

    }

    public function boot(): void
    {
        //gate機能を利用した認可処理
        // 認証しているユーザーが対象ユーザー、もしくは、adminユーザーの場合に認可
        Gate::define('compare-user', function (User $authUser, User $targetUser) {
            return $authUser->id === $targetUser->id || $authUser->role === 'admin';
        });

        // adminユーザーの場合に認可
        Gate::define('compare-user-delete', function (User $authUser, User $targetUser) {
            return $authUser->role === 'admin';
        });

        // 認証しているユーザーの権限と対象ユーザーの権限が同一、また、adminユーザーの場合に認可
        Gate::define('admin-delete-limit', function (User $authUser, User $targetUser) {
            return $authUser->role === 'admin' && $authUser->role === $targetUser->role;
        });
    }
}
