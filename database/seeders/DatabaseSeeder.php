<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            $this->call([
                UserSeeder::class,
                CompteOmSeeder::class,
                CompteOmPaySeeder::class,
                TypeOperationSeeder::class,
                FraisSeeder::class,
                TransactionSeeder::class,
            ]);
        });
    }
}
