<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Session::has('user')) {
            return redirect()->route('cus.unauthorized');
        }

        return $next($request);
    }
}
