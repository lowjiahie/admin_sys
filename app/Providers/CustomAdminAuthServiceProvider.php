<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
class CustomAdminAuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Check if the user is authenticated in the session
        $admin = Session::get('admin');

        // Share the user data with all views
        View::share('admin', $admin);
    }
}
