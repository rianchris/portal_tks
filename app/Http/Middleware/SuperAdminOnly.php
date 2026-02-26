<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SuperAdminOnly
{
    public function handle(Request $request, Closure $next): Response
    {
        // Jika belum login
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Jika bukan Super Admin (role_id = 1)
        if (auth()->user()->role_id != 2) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
