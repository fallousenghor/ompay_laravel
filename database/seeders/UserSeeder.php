<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::create([
            'id' => Str::uuid(),
            'telephone' => '221770000000',
            'nom_complet' => 'Admin Principal',
            'email' => 'admin@ompay.com',
            'code_pin_hash' => Hash::make('1234'),
            'statut_kyc' => 'verifie',
            'statut_compte' => 'actif',
            'role' => 'admin'
        ]);

        // Agents
        foreach(range(1, 3) as $i) {
            User::create([
                'id' => Str::uuid(),
                'telephone' => '22177' . str_pad($i, 7, '0', STR_PAD_LEFT),
                'nom_complet' => "Agent $i",
                'email' => "agent$i@ompay.com",
                'code_pin_hash' => Hash::make('1234'),
                'statut_kyc' => 'verifie',
                'statut_compte' => 'actif',
                'role' => 'agent'
            ]);
        }

        // Clients réguliers
        User::factory(10)->create();
    }
}
