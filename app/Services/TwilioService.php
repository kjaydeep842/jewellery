<?php

namespace App\Services;

use Twilio\Rest\Client;
use Illuminate\Support\Facades\Log;

class TwilioService
{
    protected $client;
    protected $fromNumber;

    public function __construct()
    {
        $sid = config('otp.twilio.sid');
        $token = config('otp.twilio.auth_token');
        $this->fromNumber = config('otp.twilio.phone_number');

        if ($sid && $token) {
            $this->client = new Client($sid, $token);
        }
    }

    /**
     * Send OTP via SMS
     */
    public function sendOtp(string $phone, string $otp): bool
    {
        try {
            // Log OTP generation
            Log::info("OTP Generation", [
                'phone' => $phone,
                'otp' => $otp,
                'timestamp' => now()->toDateTimeString()
            ]);

            // Check if Twilio is configured
            if (!$this->client) {
                Log::warning("Twilio not configured. Please add TWILIO_SID, TWILIO_AUTH_TOKEN, and TWILIO_PHONE_NUMBER to .env file");
                Log::info("OTP for {$phone}: {$otp} (SMS not sent - Twilio not configured)");
                return false;
            }

            // Send SMS via Twilio
            Log::info("Sending OTP via Twilio", [
                'phone' => $phone,
                'from' => $this->fromNumber
            ]);

            $message = $this->client->messages->create(
                $phone,
                [
                    'from' => $this->fromNumber,
                    'body' => "Your Tattsvi verification code is: {$otp}. Valid for 5 minutes. Do not share this code with anyone."
                ]
            );

            // Log successful SMS delivery
            Log::info("OTP SMS sent successfully", [
                'phone' => $phone,
                'message_sid' => $message->sid,
                'status' => $message->status,
                'otp' => $otp // Keep for debugging, remove in production if needed
            ]);

            return $message->sid !== null;
        } catch (\Twilio\Exceptions\RestException $e) {
            // Twilio-specific errors
            Log::error("Twilio API Error", [
                'phone' => $phone,
                'error_code' => $e->getCode(),
                'error_message' => $e->getMessage(),
                'status_code' => $e->getStatusCode()
            ]);
            return false;
        } catch (\Exception $e) {
            // General errors
            Log::error("Failed to send OTP", [
                'phone' => $phone,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return false;
        }
    }
}
