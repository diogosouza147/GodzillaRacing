<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('car_event', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_id')->constrained()->cascadeOnDelete();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->enum('payment_status', ['pago', 'pendente'])->default('pendente');
            $table->decimal('payment_value', 10, 2)->nullable();
            $table->timestamps();

            $table->unique(['car_id', 'event_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('car_event');
    }
};