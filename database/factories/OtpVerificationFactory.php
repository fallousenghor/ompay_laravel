<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OtpVerification>
 */
class OtpVerificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'numero_telephone' => fake()->unique()->phoneNumber(),
            'code_otp' => fake()->numerify('######'), // 6-digit code
            'expiration' => Carbon::now()->addMinutes(5), // Expires in 5 minutes
            'utilise' => fake()->boolean(20), // 20% chance of being used
        ];
    }
}
