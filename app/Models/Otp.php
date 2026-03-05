<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Otp extends Model
{
    protected $fillable = [
        'phone',
        'otp',
        'expires_at',
        'verified',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'verified' => 'boolean',
    ];

    /**
     * Generate a new OTP for a phone number
     */
    public static function generate(string $phone): string
    {
        // Delete any existing unverified OTPs for this phone
        self::where('phone', $phone)
            ->where('verified', false)
            ->delete();

        // Generate 6-digit OTP
        $otpCode = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Create new OTP record
        self::create([
            'phone' => $phone,
            'otp' => $otpCode,
            'expires_at' => Carbon::now()->addMinutes(config('otp.expiry_minutes', 5)),
            'verified' => false,
        ]);

        return $otpCode;
    }

    /**
     * Verify OTP for a phone number
     */
    public static function verify(string $phone, string $otp): bool
    {
        $otpRecord = self::where('phone', $phone)
            ->where('otp', $otp)
            ->where('verified', false)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if ($otpRecord) {
            $otpRecord->update(['verified' => true]);
            return true;
        }

        return false;
    }

    /**
     * Clean up expired OTPs
     */
    public static function cleanup(): void
    {
        self::where('expires_at', '<', Carbon::now())->delete();
    }

    /**
     * Check if phone has reached rate limit
     */
    public static function hasReachedRateLimit(string $phone): bool
    {
        $maxAttempts = config('otp.max_attempts', 3);
        $rateLimitMinutes = config('otp.rate_limit_minutes', 10);

        $recentAttempts = self::where('phone', $phone)
            ->where('created_at', '>', Carbon::now()->subMinutes($rateLimitMinutes))
            ->count();

        return $recentAttempts >= $maxAttempts;
    }
}
