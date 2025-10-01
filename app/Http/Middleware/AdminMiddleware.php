<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Allow access only if user is logged in and role is 'admin'
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // If AJAX or API request → return 403 JSON
        if ($request->expectsJson()) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        // Otherwise → redirect normal users back to their dashboard
        return redirect()->route('dashboard')
            ->with('error', 'You do not have permission to access the admin panel.');
    }
}
