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
        Schema::create('seguimientos', function (Blueprint $table) {

            $table->id();

            // Recomendación
            $table->foreignId('recomendacion_id')
                ->constrained('recomendaciones')
                ->cascadeOnDelete();

            // Usuario que realizó el seguimiento
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Fecha del seguimiento
            $table->date('fecha');

            // Estado
            $table->enum('estado', [
                'Pendiente',
                'En proceso',
                'Cumplida',
                'Vencida',
            ]);

            // Porcentaje de avance
            $table->unsignedTinyInteger('porcentaje')->default(0);

            // Observaciones
            $table->longText('observacion');

            // Compromisos
            $table->longText('compromisos')->nullable();

            // Evidencia
            $table->string('evidencia')->nullable();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seguimientos');
    }
};