<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CompteOm>
 */
class CompteOmFactory extends Factory
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
            'numero_telephone' => fake()->unique()->phoneNumber(),
            'identifiant_om' => fake()->unique()->randomNumber(8),
            'solde_om' => fake()->randomFloat(2, 0, 10000),
            'devise' => 'XOF',
            'actif' => fake()->boolean(80), // 80% chance of being active
        ];
    }
}
