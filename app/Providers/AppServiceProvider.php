<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
        Gate::define('owner', function ($user) {
            return $user && $user->role && strtolower((string) $user->role->nama) === 'owner';
        });

        Gate::define('admin', function ($user) {
            $roleName = strtolower((string) ($user->role->nama ?? ''));

            return $user && $user->role && $roleName === 'admin';
        });
    }
}
