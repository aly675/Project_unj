<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // This middleware should only run on authenticated routes.
        // The 'auth' middleware should handle redirection for guests.
        // But as a safeguard, we check here too.
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // The user liked the strict check, so we will iterate through the
        // roles passed to the middleware and do a strict comparison.
        foreach ($roles as $role) {
            if ($user->role === $role) {
                return $next($request);
            }
        }

        // If no role matched, deny access.
        return response(view('errors.403'), 403);
    }
}
