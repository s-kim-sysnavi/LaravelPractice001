<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use app\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // 

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Gate::define('compare-user', function (User $authUser, User $targetUser) {
            return $authUser->id === $targetUser->id || $authUser->role === 'admin';
            
        });

        Gate::define('compare-user-delete', function (User $authUser, User $targetUser) {
            return $authUser->role === 'admin';
        });

        Gate::define('admin-delete-limit', function (User $authUser, User $targetUser) {
            return $authUser->role === 'admin' && $authUser->id === $targetUser->id;
        });
    }
}
