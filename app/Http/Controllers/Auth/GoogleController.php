<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    // Redirect the user to the Google authentication page.
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Obtain the user information from Google.
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Find or create a user in your database
            $user = User::updateOrCreate([
                'google_id' => $googleUser->id,
            ], [
                'full_name' => $googleUser->name,
                'email' => $googleUser->email,
                'password' => bcrypt(str()->random(16)) // Create a random password
            ]);

            // Log the user in
            Auth::login($user);

            // Redirect to the homepage or dashboard
            return redirect('/');

        } catch (\Exception $e) {
            // If something goes wrong, redirect back to the login page with an error
            return redirect('/login')->with('error', 'Something went wrong with Google login.');
        }
    }
}