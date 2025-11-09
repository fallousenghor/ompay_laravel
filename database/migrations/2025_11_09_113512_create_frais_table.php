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
        Schema::create('frais', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('type_operation_id');
            $table->decimal('frais_fixe', 15, 2)->default(0);
            $table->decimal('pourcentage_frais', 5, 4)->default(0); // pourcentage en fraction (ex: 0.015 = 1.5%)
            $table->string('devise', 3)->default('XOF');
            $table->timestamps();

            $table->foreign('type_operation_id')->references('id')->on('type_operations');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('frais');
    }
};
