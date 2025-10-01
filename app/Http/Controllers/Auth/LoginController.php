<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle a user's authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function authenticate(Request $request)
    {
        // 1. Validate the incoming request data
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'remember' => ['nullable', 'boolean'], // Validate the "Remember Me" field
        ]);

        // 2. Attempt to authenticate the user
        // We use the 'remember' value from the form to persist the session.
        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']], $request->boolean('remember'))) {
            // If authentication is successful, regenerate the session to prevent session fixation attacks.
            $request->session()->regenerate();

            // 3. Redirect the user based on their role
            if (Auth::user()->role === 'admin') {
                // If the user is an admin, redirect them to the admin dashboard.
                return redirect()->intended(route('admin.dashboard'));
            }

            // For all other users, redirect to the standard user dashboard.
            return redirect()->intended(route('dashboard'));
        }

        // 4. If authentication fails, redirect back to the login page
        // with an error message and the email they entered.
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
    
    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        // Log the user out.
        Auth::logout();

        // Invalidate the session to clear all session data.
        $request->session()->invalidate();

        // Regenerate the CSRF token for security.
        $request->session()->regenerateToken();

        // Redirect the user to the homepage.
        return redirect('/');
    }
}

