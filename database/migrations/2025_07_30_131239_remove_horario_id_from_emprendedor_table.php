<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveHorarioIdFromEmprendedorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('emprendedor', function (Blueprint $table) {
            $table->dropForeign(['horario_id']);
            $table->dropColumn('horario_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('emprendedor', function (Blueprint $table) {
            //
        });
    }
}
