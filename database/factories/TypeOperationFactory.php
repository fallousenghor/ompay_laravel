<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\TypeOperation;

class TypeOperationFactory extends Factory
{
    protected $model = TypeOperation::class;

    public function definition(): array
    {
        $types = [
            'transfert_om', 'transfert_ompay', 'paiement_marchand',
            'paiement_numero', 'depot_om', 'retrait_om',
            'verification_compte', 'creation_ompay'
        ];

        return [
            'code' => $this->faker->unique()->randomElement($types),
            'description' => $this->faker->sentence(),
        ];
    }
}
