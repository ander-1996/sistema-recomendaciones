<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
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


    public function down(): void
    {
        Schema::table('recomendacions', function (Blueprint $table) {

            $table->dropColumn([
                'codigo',
                'nombre_contacto',
                'cargo_contacto',
                'correo_contacto',
                'telefono_contacto',
                'hallazgo',
                'responsable_sugerido',
                'archivo_evidencia'
            ]);

        });
    }
};