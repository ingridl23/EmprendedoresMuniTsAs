<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmprendedorIdToHorarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('horario', function (Blueprint $table) {
            $table->foreignId('emprendedor_id')->constrained('emprendedor')->onDelete('cascade');
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
            $table->dropForeign(['emprendedor_id']);
            $table->dropColumn('emprendedor_id');
        });
    }
}
