<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CompteOmPay;

class CompteOmPaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CompteOmPay::factory(8)
            ->create([
                'devise' => 'XOF',
                'actif' => true
            ]);
    }
}
