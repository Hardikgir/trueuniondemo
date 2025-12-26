<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    /**
     * Register a new user
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'mobile_number' => 'nullable|string|unique:users',
            'gender' => 'required|in:male,female',
            'dob' => 'required|date',
            'country' => 'required|string',
            'state' => 'required|string',
            'city' => 'required|string',
        ]);

        $user = User::create([
            'full_name' => $validated['full_name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'mobile_number' => $validated['mobile_number'] ?? null,
            'gender' => $validated['gender'],
            'dob' => $validated['dob'],
            'country' => $validated['country'],
            'state' => $validated['state'],
            'city' => $validated['city'],
            'role' => 'user',
        ]);

        $token = $this->generateApiToken($user);

        return response()->json([
            'status' => 'success',
            'message' => 'User registered successfully',
            'data' => [
                'user' => $this->formatUser($user),
                'token' => $token,
            ],
        ], 201);
    }

    /**
     * Login user
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid email or password',
            ], 401);
        }

        $user = Auth::user();
        $user->refresh();

        if ($user->role === 'admin') {
            return response()->json([
                'status' => 'error',
                'message' => 'Admin users cannot login via API',
            ], 403);
        }

        $token = $this->generateApiToken($user);

        return response()->json([
            'status' => 'success',
            'message' => 'Login successful',
            'data' => [
                'user' => $this->formatUser($user),
                'token' => $token,
            ],
        ]);
    }

    /**
     * Logout user
     */
    public function logout(Request $request)
    {
        $user = $request->user();
        
        // Revoke token (if using Sanctum, use: $request->user()->currentAccessToken()->delete())
        // For custom token, you can delete from database or just return success
        
        return response()->json([
            'status' => 'success',
            'message' => 'Logged out successfully',
        ]);
    }

    /**
     * Get authenticated user
     */
    public function user(Request $request)
    {
        return response()->json([
            'status' => 'success',
            'data' => [
                'user' => $this->formatUser($request->user()),
            ],
        ]);
    }

    /**
     * Send OTP
     */
    public function sendOtp(Request $request)
    {
        $validated = $request->validate([
            'mobile_number' => 'required|string',
        ]);

        // Generate OTP (6 digits)
        $otp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        
        // Store OTP in session or cache (expires in 10 minutes)
        cache()->put("otp_{$validated['mobile_number']}", $otp, now()->addMinutes(10));

        // TODO: Send OTP via SMS service
        // For now, return OTP in response (remove in production)
        
        return response()->json([
            'status' => 'success',
            'message' => 'OTP sent successfully',
            'data' => [
                'otp' => $otp, // Remove in production
                'expires_in' => 600, // seconds
            ],
        ]);
    }

    /**
     * Verify OTP
     */
    public function verifyOtp(Request $request)
    {
        $validated = $request->validate([
            'mobile_number' => 'required|string',
            'otp' => 'required|string|size:6',
        ]);

        $storedOtp = cache()->get("otp_{$validated['mobile_number']}");

        if (!$storedOtp || $storedOtp !== $validated['otp']) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid or expired OTP',
            ], 400);
        }

        // Clear OTP
        cache()->forget("otp_{$validated['mobile_number']}");

        // Find or create user
        $user = User::where('mobile_number', $validated['mobile_number'])->first();

        if (!$user) {
            // Create new user with mobile number
            $user = User::create([
                'full_name' => 'User ' . substr($validated['mobile_number'], -4),
                'mobile_number' => $validated['mobile_number'],
                'email' => $validated['mobile_number'] . '@mobile.temp',
                'password' => Hash::make(Str::random(16)),
                'role' => 'user',
            ]);
        }

        $token = $this->generateApiToken($user);

        return response()->json([
            'status' => 'success',
            'message' => 'OTP verified successfully',
            'data' => [
                'user' => $this->formatUser($user),
                'token' => $token,
            ],
        ]);
    }

    /**
     * Google OAuth login
     */
    public function googleLogin(Request $request)
    {
        $validated = $request->validate([
            'access_token' => 'required|string',
        ]);

        try {
            // Get user info from Google
            $googleUser = Socialite::driver('google')->userFromToken($validated['access_token']);

            // Find or create user
            $user = User::firstOrNew(['google_id' => $googleUser->id]);
            
            if (!$user->exists) {
                $user->fill([
                    'full_name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'password' => Hash::make(Str::random(16)),
                ]);
                $user->save();
            } else {
                $user->update([
                    'full_name' => $googleUser->name,
                    'email' => $googleUser->email,
                ]);
            }

            $token = $this->generateApiToken($user);

            return response()->json([
                'status' => 'success',
                'message' => 'Google login successful',
                'data' => [
                    'user' => $this->formatUser($user),
                    'token' => $token,
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Google authentication failed',
                'error' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Refresh API token
     */
    public function refreshToken(Request $request)
    {
        $user = $request->user();
        $token = $this->generateApiToken($user);

        return response()->json([
            'status' => 'success',
            'message' => 'Token refreshed successfully',
            'data' => [
                'token' => $token,
            ],
        ]);
    }

    /**
     * Generate API token for user
     */
    private function generateApiToken(User $user): string
    {
        // Generate a random token
        $token = Str::random(60);
        
        // Store token in database (you can create a personal_access_tokens table for this)
        // For now, we'll use a simple approach and store in users table
        $user->update(['api_token' => hash('sha256', $token)]);
        
        return $token;
    }

    /**
     * Format user data for API response
     */
    private function formatUser(User $user): array
    {
        return [
            'id' => $user->id,
            'full_name' => $user->full_name,
            'email' => $user->email,
            'mobile_number' => $user->mobile_number,
            'profile_image' => $user->profile_image ? asset('storage/' . $user->profile_image) : null,
            'gender' => $user->gender,
            'dob' => $user->dob,
            'age' => $user->dob ? \Carbon\Carbon::parse($user->dob)->age : null,
            'country' => $user->country,
            'state' => $user->state,
            'city' => $user->city,
            'role' => $user->role,
            'created_at' => $user->created_at,
        ];
    }
}

