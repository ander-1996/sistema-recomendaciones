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
    Schema::create('recomendacions', function (Blueprint $table) {
        $table->id();

        // Institución a la que pertenece la recomendación
        $table->foreignId('institucion_id')
              ->constrained()
              ->cascadeOnDelete();

        // Información general
        $table->string('titulo');
        $table->text('descripcion');

        // Clasificación
        $table->enum('tipo', [
            'Academica',
            'Administrativa',
            'Infraestructura',
            'Convivencia',
            'Otra'
        ]);

        $table->enum('prioridad', [
            'Alta',
            'Media',
            'Baja'
        ]);

        // Seguimiento
        $table->enum('estado', [
            'Pendiente',
            'En proceso',
            'Cumplida'
        ])->default('Pendiente');

        $table->date('fecha_recomendacion');

        $table->date('fecha_cumplimiento')
              ->nullable();

        $table->text('observaciones')
              ->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recomendacions');
    }
};
