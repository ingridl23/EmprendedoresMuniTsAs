<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class createEmpleosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');

            $table->string('email');
            $table->string('telefono')->nullable();
            $table->string('cv_path')->nullable(); // ruta al archivo PDF
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
        
    }
}
