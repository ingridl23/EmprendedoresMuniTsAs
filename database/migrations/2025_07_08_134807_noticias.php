<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Noticias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */


    public function up()
    {


        Schema::create("noticias", function (Blueprint $table) {

            $table->id();
            $table->timestamps();
            $table->string('titulo');
            $table->text('descripcion');
            $table->string('categoria');
            $table->string('imagen');
            $table->string('imagen_public_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("noticias");
    }
}
