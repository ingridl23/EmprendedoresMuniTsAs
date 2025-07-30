<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Emprendedor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emprendedor', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion');
            $table->string('categoria');
            $table->foreignId('redes_id')->constrained('redes')->onDelete('cascade');
            $table->foreignId('direccion_id')->constrained('direccion')->onDelete('cascade');
            //  $table->foreignId('horario_id')->constrained('horario')->onDelete('cascade');


            $table->timestamps();
        });
    }






    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emprendedor');
    }
}
