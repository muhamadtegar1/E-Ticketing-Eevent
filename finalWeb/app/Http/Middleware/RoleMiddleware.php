<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle($request, Closure $next, $role)
    {
        if (Auth::check() && Auth::user()->roles->contains('name', $role)) {
            return $next($request);
        }

        // Redirect jika user tidak memiliki role yang sesuai
        return redirect('/')->with('error', 'Unauthorized');
    }
}

