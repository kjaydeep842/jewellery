<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Otp;
use App\Models\User;
use App\Services\TwilioService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    protected $twilioService;

    public function __construct(TwilioService $twilioService)
    {
        $this->twilioService = $twilioService;
    }

    /**
     * Show mobile number entry form
     */
    public function showMobileForm()
    {
        return view('frontend.auth.enter_mobile');
    }

    /**
     * Send OTP to mobile number
     */
    public function sendOtp(Request $request)
    {

        Log::info('OTP Send Request', [
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent()
        ]);

        $validator = Validator::make($request->all(), [
            'full_phone' => 'required|string',
            'otp_notify' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            Log::warning('OTP Send Validation Failed', [
                'errors' => $validator->errors()->toArray()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Please enter a valid mobile number.',
                'errors' => $validator->errors()
            ], 422);
        }

        $phone = $request->full_phone;

        // Check rate limit
        if (Otp::hasReachedRateLimit($phone)) {
            Log::warning('OTP Rate Limit Exceeded', ['phone' => $phone]);
            return response()->json([
                'success' => false,
                'message' => 'Too many OTP requests. Please try again after 10 minutes.'
            ], 429);
        }

        try {
            // Generate OTP
            $otpCode = Otp::generate($phone);

            Log::info('OTP Generated', ['phone' => $phone]);

            // Send OTP via Twilio
            $sent = $this->twilioService->sendOtp($phone, $otpCode);

            if (!$sent) {
                Log::error('OTP Send Failed', ['phone' => $phone]);
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to send OTP. Please try again.'
                ], 500);
            }

            // Store phone and notify preference in session
            session([
                'otp_phone' => $phone,
                'otp_notify' => $request->otp_notify ?? false
            ]);

            Log::info('OTP Sent Successfully', ['phone' => $phone]);

            return response()->json([
                'success' => true,
                'message' => 'OTP sent successfully!',
                'redirect' => route('frontend.auth.verify-otp')
            ]);
        } catch (\Exception $e) {
            Log::error('OTP Send Exception', [
                'phone' => $phone,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'An error occurred. Please try again.'
            ], 500);
        }
    }

    /**
     * Show OTP verification form
     */
    public function showOtpForm()
    {
        if (!session('otp_phone')) {
            return redirect()->route('frontend.auth.mobile');
        }

        return view('frontend.auth.verify_otp', [
            'phone' => session('otp_phone')
        ]);
    }

    /**
     * Verify OTP and login user
     */
    public function verifyOtp(Request $request)
    {
        Log::info('OTP Verify Request', [
            'ip' => $request->ip(),
            'session_phone' => session('otp_phone')
        ]);

        $validator = Validator::make($request->all(), [
            'otp' => 'required|digits:6',
        ]);

        if ($validator->fails()) {
            Log::warning('OTP Verify Validation Failed');
            return response()->json([
                'success' => false,
                'message' => 'Please enter a valid 6-digit OTP.',
                'errors' => $validator->errors()
            ], 422);
        }

        $phone = session('otp_phone');

        if (!$phone) {
            Log::warning('OTP Verify Session Expired');
            return response()->json([
                'success' => false,
                'message' => 'Session expired. Please start again.',
                'redirect' => route('frontend.auth.mobile')
            ], 400);
        }

        // Verify OTP
        if (!Otp::verify($phone, $request->otp)) {
            Log::warning('OTP Verification Failed', [
                'phone' => $phone,
                'attempted_otp' => $request->otp
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Invalid or expired OTP. Please try again.'
            ], 422);
        }

        Log::info('OTP Verified Successfully', ['phone' => $phone]);

        try {
            // Capture pending wishlist action BEFORE login (in case session migration clears it)
            $pendingProductId = session()->pull('pending_wishlist_product_id');

            // Find or create user
            $user = User::where('phone', $phone)->first();

            if (!$user) {
                // Create new user
                $user = User::create([
                    'phone' => $phone,
                    'phone_verified_at' => now(),
                    'otp_notify' => session('otp_notify', false),
                    'name' => 'User', // Default name, can be updated later
                    'email' => null, // Email is optional
                ]);
                Log::info('New User Created', [
                    'user_id' => $user->id,
                    'phone' => $phone
                ]);
            } else {
                // Update verification status
                $user->update([
                    'phone_verified_at' => now(),
                    'otp_notify' => session('otp_notify', $user->otp_notify),
                ]);
                Log::info('Existing User Updated', [
                    'user_id' => $user->id,
                    'phone' => $phone
                ]);
            }

            // Login user
            Auth::login($user, true);
            Log::info('User Logged In', [
                'user_id' => $user->id,
                'phone' => $phone
            ]);

            // Execute pending wishlist addition if captured
            if ($pendingProductId) {
                \App\Models\Wishlist::firstOrCreate([
                    'user_id' => $user->id,
                    'product_id' => $pendingProductId,
                ]);
            }

            // Clean up OTP session data
            session()->forget(['otp_phone', 'otp_notify']);

            // Clean up old OTPs
            Otp::cleanup();

            // Determine redirect URL: intended URL or default to profile
            $redirectUrl = session()->pull('url.intended', route('profile.edit'));

            return response()->json([
                'success' => true,
                'message' => 'Login successful!',
                'redirect' => $redirectUrl
            ]);
        } catch (\Exception $e) {
            Log::error('OTP Verify Exception', [
                'phone' => $phone,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'An error occurred. Please try again.'
            ], 500);
        }
    }

    /**
     * Resend OTP
     */
    public function resendOtp(Request $request)
    {
        Log::info('OTP Resend Request', [
            'ip' => $request->ip(),
            'session_phone' => session('otp_phone')
        ]);

        $phone = session('otp_phone');

        if (!$phone) {
            Log::warning('OTP Resend Session Expired');
            return response()->json([
                'success' => false,
                'message' => 'Session expired. Please start again.',
                'redirect' => route('frontend.auth.mobile')
            ], 400);
        }

        // Check rate limit
        if (Otp::hasReachedRateLimit($phone)) {
            Log::warning('OTP Resend Rate Limit Exceeded', ['phone' => $phone]);
            return response()->json([
                'success' => false,
                'message' => 'Too many OTP requests. Please try again after 10 minutes.'
            ], 429);
        }

        try {
            // Generate new OTP
            $otpCode = Otp::generate($phone);
            Log::info('OTP Regenerated for Resend', ['phone' => $phone]);

            // Send OTP via Twilio
            $sent = $this->twilioService->sendOtp($phone, $otpCode);

            if (!$sent) {
                Log::error('OTP Resend Failed', ['phone' => $phone]);
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to send OTP. Please try again.'
                ], 500);
            }

            Log::info('OTP Resent Successfully', ['phone' => $phone]);

            return response()->json([
                'success' => true,
                'message' => 'OTP resent successfully!'
            ]);
        } catch (\Exception $e) {
            Log::error('OTP Resend Exception', [
                'phone' => $phone,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'An error occurred. Please try again.'
            ], 500);
        }
    }

    /**
     * Logout user
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
