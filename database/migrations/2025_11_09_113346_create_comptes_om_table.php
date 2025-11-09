<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comptes_om', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('numero_telephone', 20)->unique();
            $table->string('identifiant_om', 50)->unique();
            $table->decimal('solde_om', 15, 2)->default(0);
            $table->string('devise', 3)->default('XOF');
            $table->boolean('actif')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comptes_om');
    }
};
