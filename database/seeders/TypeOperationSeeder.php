<?php

namespace Database\Seeders;

use App\Models\TypeOperation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TypeOperationSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            [
                'code' => 'depot_om',
                'description' => 'Dépôt sur compte Orange Money',
                'limite_min' => 100,
                'limite_max' => 1000000
            ],
            [
                'code' => 'retrait_om',
                'description' => 'Retrait depuis compte Orange Money',
                'limite_min' => 100,
                'limite_max' => 1000000
            ],
            [
                'code' => 'transfert_om',
                'description' => 'Transfert d\'argent vers un autre compte',
                'limite_min' => 100,
                'limite_max' => 1000000
            ],
            [
                'code' => 'paiement_marchand',
                'description' => 'Paiement chez un marchand',
                'limite_min' => 100,
                'limite_max' => 2000000
            ]
        ];

        foreach ($types as $type) {
            TypeOperation::create(array_merge(['id' => Str::uuid()], $type));
        }
    }
}
