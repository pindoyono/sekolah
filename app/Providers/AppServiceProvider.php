<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
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
        //
        View::composer('*', function ($view) {
            if (Auth::check()) {
                if (auth()->check()) {
                    if (auth()->user()->hasRole('super_admin')) {
                        config(['filament-spatie-roles-permissions.should_register_on_navigation' => [
                            'permissions' => true,
                            'roles' => true,
                        ],
                        ]);
                    } else {
                        config(['filament-spatie-roles-permissions.should_register_on_navigation' => [
                            'permissions' => false,
                            'roles' => true,
                        ],
                        ]);
                    }
                }
            }
        });

    }
}
