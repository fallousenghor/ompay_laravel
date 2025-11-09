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
        Schema::create('comptes_ompay', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('utilisateur_id');
            $table->uuid('compte_om_id');
            $table->string('devise', 3)->default('XOF');
            $table->boolean('actif')->default(true);
            $table->timestamps();

            $table->foreign('utilisateur_id')->references('id')->on('users');
            $table->foreign('compte_om_id')->references('id')->on('comptes_om');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comptes_ompay');
    }
};
