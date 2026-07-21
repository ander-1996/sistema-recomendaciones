<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('recomendaciones', function (Blueprint $table) {

            $table->string('nombre_contacto')->nullable()->after('institucion_id');
            $table->string('cargo_contacto')->nullable();
            $table->string('correo_contacto')->nullable();
            $table->string('telefono_contacto')->nullable();

        });
    }

    public function down(): void
    {
        Schema::table('recomendaciones', function (Blueprint $table) {

            $table->dropColumn([
                'nombre_contacto',
                'cargo_contacto',
                'correo_contacto',
                'telefono_contacto',
            ]);

        });
    }
};