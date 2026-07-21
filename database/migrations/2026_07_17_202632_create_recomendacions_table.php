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
    Schema::create('recomendaciones', function (Blueprint $table) {

        $table->id();

        // Código consecutivo
        $table->string('codigo')->unique();

        // Institución
        $table->foreignId('institucion_id')
              ->constrained('institucions')
              ->cascadeOnDelete();

        // Información de la recomendación
        $table->longText('recomendacion');
        $table->enum('tipo', [
            'Curricular',
            'Académica',
            'Gestión',
            'Bienestar',
            'Evaluación',
            'Permanencia',
        ]);

        $table->longText('hallazgo');

        $table->enum('prioridad', [
            'Alta',
            'Media',
            'Baja',
        ]);

        // Seguimiento
        $table->string('responsable')->nullable();

        $table->date('fecha_inicio');

        $table->date('fecha_cumplimiento');

        $table->enum('estado', [
            'Pendiente',
            'En proceso',
            'Cumplida',
            'Vencida',
        ])->default('Pendiente');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recomendaciones');
    }
};
