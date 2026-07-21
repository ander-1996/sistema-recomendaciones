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
    Schema::table('recomendaciones', function (Blueprint $table) {

        $table->string('institucion_origen')
            ->nullable()
            ->after('institucion_id');

    });
}


public function down(): void
{
    Schema::table('recomendaciones', function (Blueprint $table) {

        $table->dropColumn('institucion_origen');

    });
}
};
