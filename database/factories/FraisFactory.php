<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\TypeOperation;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Frais>
 */
class FraisFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type_operation_id' => TypeOperation::factory(),
            'frais_fixe' => fake()->randomFloat(2, 0, 500),
            'pourcentage_frais' => fake()->randomFloat(4, 0, 0.05), // Max 5%
            'devise' => 'XOF',
        ];
    }
}
