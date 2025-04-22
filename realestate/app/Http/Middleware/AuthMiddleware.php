<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!session('auth')) {
            return redirect('/')->with('error', 'You must be logged in to access this page.');
        }

        return $next($request);
    }
}
