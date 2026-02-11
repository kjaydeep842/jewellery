<?php

return [
    /*
    |--------------------------------------------------------------------------
    | OTP Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for OTP-based authentication
    |
    */

    'length' => env('OTP_LENGTH', 6),
    'expiry_minutes' => env('OTP_EXPIRY_MINUTES', 5),
    'max_attempts' => env('OTP_MAX_ATTEMPTS', 3),
    'rate_limit_minutes' => env('OTP_RATE_LIMIT_MINUTES', 10),

    /*
    |--------------------------------------------------------------------------
    | Twilio Configuration
    |--------------------------------------------------------------------------
    */
    'twilio' => [
        'sid' => env('TWILIO_SID'),
        'auth_token' => env('TWILIO_AUTH_TOKEN'),
        'phone_number' => env('TWILIO_PHONE_NUMBER'),
    ],
];
