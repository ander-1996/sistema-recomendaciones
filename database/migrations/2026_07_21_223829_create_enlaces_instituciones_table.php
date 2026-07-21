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
    Schema::create('enlaces_instituciones', function (Blueprint $table) {

        $table->id();

        $table->foreignId('institucion_id')
            ->constrained()
            ->cascadeOnDelete();

        $table->string('token')
            ->unique();

        $table->boolean('activo')
            ->default(true);

        $table->timestamps();

    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enlaces_instituciones');
    }
};
