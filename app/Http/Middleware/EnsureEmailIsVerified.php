<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureEmailIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is logged in and if their email is verified
        if (Auth::check() && is_null(Auth::user()->email_verified_at)) {
            // Redirect the user to a specific route if their email is not verified
            return redirect()->route('ver.show');
        }

        return $next($request);
    }
}
