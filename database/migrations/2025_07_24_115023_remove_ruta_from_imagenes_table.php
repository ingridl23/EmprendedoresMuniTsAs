<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveRutaFromImagenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
    */
    public function up()
    {
        Schema::table('imagenes', function (Blueprint $table) {
            $table->dropColumn('ruta');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
    */
    public function down()
    {
        Schema::table('imagenes', function (Blueprint $table) {
            $table->string('ruta')->nullable();
        });
    }
}
