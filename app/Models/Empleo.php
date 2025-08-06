<?php

namespace App\Models;


use App\constants;
use Database\Factories\EmpleoFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * Class Empleo
 *
 * @property $id
 * @property $nombre
 * @property $edad
 * @property $asunto
 * @property $email
 * @property $telefono
 * @property $dni
 * @property $ciudad
 * @property $localidad
 * @property $formacion
 * @property $nombre_curso
 * @property $description
 *  @property $referencia_laboral
 *  @property $referencia_rubro
 *  @property $referencia_actividad
 *  @property $contratista
 *  @property $referencia_telefonica
 * @property $cud
 * @property $dependencia
 * @property $cv_path
 * @property $created_at
 * @property $updated_at
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Empleo extends Model
{

    protected $table = "empleos";

    protected static function newFactory()
    {
        return EmpleoFactory::new();
    }


    use HasFactory;


    protected $fillable = [
        'nombre',
        'edad',
        'asunto',
        'email',
        'telefono',
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
        'cv_path',
    ];

    //traer todos los desempleados sin filtrar directamente todos
    /*  public static function showBuscadoresDeEmpleo()
    {

        $desempleados = self::all();
        return $desempleados->isNotEmpty() ? $desempleados : null;
    }

    //traer los ultimos 50 desempleados anotados con la edad ingresada
    public static function traerUltimosDesempleadosEdad($edad)
    {
        return self::where('edad', $edad)->latest()->limit(50)->get();
    }*/
}
