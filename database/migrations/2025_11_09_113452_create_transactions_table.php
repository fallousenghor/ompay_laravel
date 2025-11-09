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
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('compte_source_id');
            $table->uuid('compte_destination_id')->nullable();
            $table->uuid('type_operation_id');
            $table->decimal('montant', 15, 2);
            $table->string('devise', 3)->default('XOF');
            $table->enum('statut', ['en_attente', 'en_cours', 'validee', 'echouee', 'remboursee'])->default('en_attente');
            $table->string('reference', 100)->unique();
            $table->json('meta_donnees')->nullable()->comment('Stockage des calculs (frais, montant total) et autres métadonnées');
            $table->timestamps();

            $table->foreign('compte_source_id')->references('id')->on('comptes_ompay');
            $table->foreign('compte_destination_id')->references('id')->on('comptes_ompay');
            $table->foreign('type_operation_id')->references('id')->on('type_operations');
            $table->index(['compte_source_id', 'statut']);
            $table->index(['reference']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
