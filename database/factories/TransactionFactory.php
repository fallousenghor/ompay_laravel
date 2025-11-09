<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\CompteOmPay;
use App\Models\TypeOperation;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
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
            'compte_source_id' => CompteOmPay::factory(),
            'compte_destination_id' => CompteOmPay::factory(),
            'type_operation_id' => TypeOperation::factory(),
            'montant' => fake()->randomFloat(2, 100, 50000),
            'frais' => fake()->randomFloat(2, 0, 1000),
            'devise' => 'XOF',
            'statut' => fake()->randomElement(['en_attente', 'en_cours', 'validee', 'echouee', 'remboursee']),
            'reference' => fake()->unique()->uuid(),
            'meta_donnees' => [
                'description' => fake()->sentence(),
                'canal' => fake()->randomElement(['mobile', 'web', 'api']),
            ],
        ];
    }
}
