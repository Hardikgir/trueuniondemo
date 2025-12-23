<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class OtpController extends Controller
{
    /**
     * Send OTP to email or mobile number
     */
    public function sendOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email_or_mobile' => 'required|string',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $emailOrMobile = $request->email_or_mobile;
        
        // Check if it's an email or mobile number
        $isEmail = filter_var($emailOrMobile, FILTER_VALIDATE_EMAIL);
        
        // Generate a 6-digit OTP
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        
        // Store OTP in session (expires in 10 minutes)
        Session::put('otp', $otp);
        Session::put('otp_email_or_mobile', $emailOrMobile);
        Session::put('otp_expires_at', now()->addMinutes(10));
        
        if ($isEmail) {
            // Send OTP via email
            try {
                Mail::raw("Your OTP code is: {$otp}. This code will expire in 10 minutes.", function ($message) use ($emailOrMobile) {
                    $message->to($emailOrMobile)
                            ->subject('Your OTP Code - Union');
                });
                
                return redirect()->route('signup')->with('success', 'OTP has been sent to your email address.')->with('show_otp_verification', true);
            } catch (\Exception $e) {
                return back()->withErrors(['email_or_mobile' => 'Failed to send OTP. Please try again.'])->withInput();
            }
        } else {
            // For mobile OTP, you would integrate with an SMS service like Twilio
            // For now, we'll just store it and show it (for development)
            // In production, integrate with SMS gateway
            
            // TODO: Integrate with SMS service
            // For development, we'll show the OTP in a flash message
            return redirect()->route('signup')
                ->with('success', 'OTP has been sent to your mobile number.')
                ->with('otp_display', $otp) // Remove this in production
                ->with('show_otp_verification', true);
        }
    }

    /**
     * Verify OTP
     */
    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'otp' => 'required|string|size:6',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $enteredOtp = $request->otp;
        $storedOtp = Session::get('otp');
        $expiresAt = Session::get('otp_expires_at');

        // Check if OTP exists and hasn't expired
        if (!$storedOtp || !$expiresAt || now()->gt($expiresAt)) {
            return back()->withErrors(['otp' => 'OTP has expired. Please request a new one.'])->withInput();
        }

        // Verify OTP
        if ($enteredOtp !== $storedOtp) {
            return back()->withErrors(['otp' => 'Invalid OTP. Please try again.'])->withInput();
        }

        // OTP verified successfully
        Session::put('otp_verified', true);
        
        // Redirect to signup form with verified status
        return redirect()->route('signup')->with('success', 'OTP verified successfully! Please complete your registration.');
    }
}
