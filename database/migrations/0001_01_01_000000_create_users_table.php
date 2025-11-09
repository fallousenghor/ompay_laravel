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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('telephone', 20)->unique();
            $table->string('nom_complet');
            $table->string('email')->nullable();
            $table->string('code_pin_hash');
            $table->enum('statut_kyc', ['en_attente', 'verifie', 'rejete'])->default('en_attente');
            $table->enum('statut_compte', ['actif', 'bloque', 'supprime'])->default('actif');
            $table->enum('role', ['client', 'admin', 'agent'])->default('client');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->id(); // ✅ Utilise un id plutôt que email comme clé primaire
            $table->string('email')->index(); // ✅ index au lieu de clé primaire
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};
