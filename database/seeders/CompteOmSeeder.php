<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CompteOm;

class CompteOmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CompteOm::factory(8)->create([
            'solde_om' => 1000000, // Solde initial de 1M
            'devise' => 'XOF',
            'actif' => true
        ]);
    }
}
