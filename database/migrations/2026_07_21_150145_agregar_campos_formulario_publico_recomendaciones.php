<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('recomendacions', function (Blueprint $table) {

        $table->string('codigo')->unique()->after('id');

        $table->string('nombre_contacto')->nullable();

        $table->string('cargo_contacto')->nullable();

        $table->string('correo_contacto')->nullable();

        $table->string('telefono_contacto')->nullable();

        $table->text('hallazgo')->nullable();

        $table->string('responsable_sugerido')->nullable();

        $table->string('archivo_evidencia')->nullable();

    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }

    
};
