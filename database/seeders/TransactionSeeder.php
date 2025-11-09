<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction;
use App\Models\CompteOmPay;
use App\Models\TypeOperation;
use App\Services\TransactionService;
use Illuminate\Support\Str;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        $comptes = CompteOmPay::with('compteOm')->get();
        $types = TypeOperation::with('frais')->get();

        if ($comptes->isEmpty() || $types->isEmpty()) return;

        foreach(range(1, 25) as $i) {
            $compteSource = $comptes->random();
            $soldeDisponible = $compteSource->compteOm->solde_om;

            $transaction = Transaction::create([
                'id' => Str::uuid(),
                'compte_source_id' => $compteSource->id,
                'compte_destination_id' => $comptes->where('id', '!=', $compteSource->id)->random()->id,
                'type_operation_id' => $types->random()->id,
                'montant' => fake()->randomFloat(2, 100, min(50000, $soldeDisponible)), // Ne pas dépasser le solde
                'devise' => 'XOF',
                'statut' => 'validee',
                'reference' => Str::uuid(),
                'meta_donnees' => [
                    'description' => fake()->sentence(),
                    'canal' => fake()->randomElement(['mobile', 'web', 'api'])
                ]
            ]);
        }
    }
}
