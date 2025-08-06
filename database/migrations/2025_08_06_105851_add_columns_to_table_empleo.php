<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToTableEmpleo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empleos', function (Blueprint $table) {
            $table->unsignedTinyInteger('edad')->after('telefono');
            $table->unsignedInteger('dni')->after('edad');
            $table->string('ciudad')->after('dni');
            $table->string('localidad')->after('ciudad');
            $table->string('formacion')->after('localidad');
            $table->string('nombre_curso')->nullable()->after('formacion');
            $table->text('description')->nullable()->after('nombre_curso');
            $table->string('referencia_laboral')->nullable()->after('description');
            $table->string('referencia_rubro')->nullable()->after('referencia_laboral');
            $table->string('referencia_actividad')->nullable()->after('referencia_rubro');
            $table->string('contratista')->nullable()->after('referencia_actividad');
            $table->string('referencia_telefonica', 15)->after('contratista'); // numeros como texto para que puedan agregar caracteristicas tipo +54
            $table->boolean('cud')->default(false)->after('referencia_telefonica');
            $table->boolean('dependencia')->default(false)->after('cud');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('empleos', function (Blueprint $table) {
            $table->dropColumn([
                'edad',
                'dni',
                'ciudad',
                'localidad',
                'formacion',
                'nombre_curso',
                'description',
                'referencia_laboral',
                'referencia_rubro',
                'referencia_actividad',
                'contratista',
                'referencia_telefonica',
                'cud',
                'dependencia',
            ]);
        });
    }
}
