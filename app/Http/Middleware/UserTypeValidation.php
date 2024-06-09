<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserTypeValidation
{
    public function handle(Request $request, Closure $next)
    {
        $userType = auth()->user()->user_type;

        if ($userType !== 'Super Admin' && $userType !== 'Admin') {
            return redirect('/')->with('error', 'Unauthorized access.');
        }

        return $next($request);
    }
}
