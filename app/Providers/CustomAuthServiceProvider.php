<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
class CustomAuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            if (session()->has('admin')) {
                $view->with('admin', session('admin'));
            } else {
                $view->with('admin', null);
            }
    
            if (session()->has('user')) {
                $view->with('user', session('user'));
            } else {
                $view->with('user', null);
            }
        });
    }
}
