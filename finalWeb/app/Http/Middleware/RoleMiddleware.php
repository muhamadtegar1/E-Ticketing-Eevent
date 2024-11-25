<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle($request, Closure $next, ...$roles)
    {
        // Pastikan pengguna sudah login
        if (auth()->check()) {
            $userRoles = auth()->user()->roles->pluck('name')->toArray(); // Ambil semua nama peran user
            
            // Cek apakah salah satu role yang diberikan cocok dengan role user
            if (array_intersect($roles, $userRoles)) {
                return $next($request);
            }
        }
    
        // Redirect jika role tidak cocok atau user belum login
        return redirect('/')->with('error', 'Unauthorized');
    }
}

