<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SuperAdminMiddleware
{
    public function handle($request, Closure $next)
    {
        // Check if the authenticated user is a Super Admin
        if (Auth::check() && Auth::user()->user_type !== 'Super Admin') {
            return response()->json(['error' => 'Unauthorized. Only Super Admin can change user types.'], 403);
        }

        return $next($request);
    }
}
