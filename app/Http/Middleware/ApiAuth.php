<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class ApiAuth
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken() ?? $request->header('X-API-Token');

        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Authentication token required',
            ], 401);
        }

        $hashedToken = hash('sha256', $token);
        $user = User::where('api_token', $hashedToken)->first();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid authentication token',
            ], 401);
        }

        if ($user->role === 'admin') {
            return response()->json([
                'status' => 'error',
                'message' => 'Admin users cannot access user API',
            ], 403);
        }

        // Set authenticated user
        auth()->setUser($user);

        return $next($request);
    }
}

