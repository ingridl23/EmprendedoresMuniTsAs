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
 * @property $descripcionLaboral
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
        'cv_path',
        'descripcion'
    ];

    //traer todos los desempleados sin filtrar directamente todos
    public static function showBuscadoresDeEmpleo()
    {

        $desempleados = Empleo::all();
        if (count($desempleados) > constants::VALORMIN) {
            return $desempleados;
        }
        return null;
    }

    //traer los ultimos 50 desempleados anotados con la edad ingresada
    public static function traerUltimosDesempleados($edad)
    {
        $desempleados =  Empleo::groupBy($edad)->limit(50)->get();
        return $desempleados;
    }
}
