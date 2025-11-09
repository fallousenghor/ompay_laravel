<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\CompteOm;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CompteOmPay>
 */
class CompteOmPayFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => (string) Str::uuid(),
            'utilisateur_id' => User::factory(),
            'compte_om_id' => CompteOm::factory(),
            'devise' => 'XOF',
            'actif' => fake()->boolean(90), // 90% chance of being active
        ];
    }
}
