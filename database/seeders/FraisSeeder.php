<?php

namespace Database\Seeders;

use App\Models\Frais;
use App\Models\TypeOperation;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class FraisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fraisConfig = [
            'depot_om' => ['fixe' => 0, 'pourcentage' => 0],
            'retrait_om' => ['fixe' => 500, 'pourcentage' => 0.01],
            'transfert_om' => ['fixe' => 100, 'pourcentage' => 0.02],
            'paiement_marchand' => ['fixe' => 0, 'pourcentage' => 0.015]
        ];

        foreach ($fraisConfig as $code => $config) {
            $typeOperation = TypeOperation::where('code', $code)->first();
            if ($typeOperation) {
                Frais::create([
                    'id' => Str::uuid(),
                    'type_operation_id' => $typeOperation->id,
                    'frais_fixe' => $config['fixe'],
                    'pourcentage_frais' => $config['pourcentage'],
                    'devise' => 'XOF'
                ]);
            }
        }
    }
}
