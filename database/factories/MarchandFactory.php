<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Marchand>
 */
class MarchandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code_marchand' => fake()->unique()->randomNumber(6),
            'nom' => fake()->company(),
            'categorie' => fake()->randomElement(['alimentation', 'transport', 'services', 'commerce', 'sante']),
            'telephone' => fake()->phoneNumber(),
            'adresse' => fake()->address(),
            'actif' => fake()->boolean(90), // 90% chance of being active
        ];
    }
}
