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
    Schema::create('institucion_recomendacion', function (Blueprint $table) {

        $table->id();

        $table->foreignId('recomendacion_id')
            ->constrained('recomendaciones')
            ->cascadeOnDelete();

        $table->foreignId('institucion_id')
            ->constrained('institucions')
            ->cascadeOnDelete();

        $table->timestamps();

    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('institucion_recomendacion');
    }
};
