<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Horario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('horario', function (Blueprint $table) {
            $table->id();

            // Día de la semana
            $table->string('dia'); // Lunes, Martes, ..., Domingo

            // Hora de apertura y cierre
            $table->time('hora_apertura')->nullable();
            $table->time('hora_cierre')->nullable();

            // Participa en feria ese día
            $table->boolean('participa_feria')->default(false);

            // Cerrado ese día
            $table->boolean('cerrado')->default(false);



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
        Schema::table('horario', function (Blueprint $table) {
            //
        });
    }
}
