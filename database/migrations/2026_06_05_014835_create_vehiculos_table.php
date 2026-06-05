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
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->id();
            $table->string('marca');
            $table->string('modelo');
            $table->year('anio');
            $table->string('color');
            $table->string('placa')->unique();
            $table->decimal('precio_dia', 8, 2);
            $table->string('imagen')->nullable();
            $table->text('descripcion')->nullable();
            $table->enum('estado', [
                'Disponible',
                'Reservado',
                'Mantenimiento'
            ])->default('Disponible');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiculos');
    }
};
