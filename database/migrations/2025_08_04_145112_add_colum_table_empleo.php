<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumTableEmpleo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('empleos', function (Blueprint $table) {
            $table->string('asunto')->after('nombre'); // o después de otra columna si querés
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('empleos', function (Blueprint $table) {
            $table->dropColumn('asunto');
        });
    }
}
