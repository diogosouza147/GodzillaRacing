<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('plate')->unique()->comment('Placa do carro');
            $table->string('model');
            $table->string('brand')->nullable();
            $table->string('color')->nullable();
            $table->string('owner_name');
            $table->string('owner_phone')->nullable();
            $table->string('discord_id')->nullable()->comment('ID/usuário do Discord do dono');
            $table->enum('payment_status', ['pago', 'pendente'])->default('pendente');
            $table->decimal('payment_value', 10, 2)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};