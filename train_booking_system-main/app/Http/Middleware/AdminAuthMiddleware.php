<?php

namespace App\Http\Middleware;

use Closure;
use App\Enums\UserTypeEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Session::has('admin')) {
            return redirect()->route('admin.login');
        }else{

            $allowedRoles = $roles;
            // Check if the user's role is allowed to access the route
            if (!in_array(session("admin")->type->value, $allowedRoles)) {
                abort(403, 'Unauthorized');
            }
        }

        return $next($request);
    }
}
