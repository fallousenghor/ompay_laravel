<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class OtpService
{
    public function generateOtp(string $telephone): string
    {
        $otp = str_pad((string)random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        Cache::put(
            "otp_{$telephone}",
            ['code' => $otp, 'attempts' => 0],
            now()->addMinutes(5)
        );

        return $otp;
    }

    public function verifyOtp(string $telephone, string $code): bool
    {
        $key = "otp_{$telephone}";
        $data = Cache::get($key);

        if (!$data) {
            return false;
        }

        if ($data['attempts'] >= 3) {
            Cache::forget($key);
            return false;
        }

        Cache::put($key, [
            'code' => $data['code'],
            'attempts' => $data['attempts'] + 1
        ], now()->addMinutes(5));

        return $data['code'] === $code;
    }
}
