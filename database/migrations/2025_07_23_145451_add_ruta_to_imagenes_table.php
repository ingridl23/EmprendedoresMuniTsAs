<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRutaToImagenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('imagenes', function (Blueprint $table) {
            $table->string('ruta')->after('img_id'); // o después de otra columna si querés
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
            $table->dropColumn('ruta');
        });
    }
}
