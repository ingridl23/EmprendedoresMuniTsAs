<?php

namespace App\Models;


use App\constants;
use Database\Factories\EmpleoFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * @class Empleo
 * Representa un solicitante de empleo dentro del sistema.
 *
 * @package App\Models
 * @property $id
 * @property $nombre
 * @property $asunto
 * @property $email
 * @property $telefono
 * @property $edad
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


    /** @var string $table Nombre de la tabla asociada */
    protected $table = "empleos";


    protected static function newFactory()
    {
        return EmpleoFactory::new();
    }


    use HasFactory;

    /** @var array $fillable Campos asignables en masa */
    protected $fillable = [
        'nombre',
        'asunto',
        'email',
        'telefono',
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
        'cv_path',
        'created_at'
    ];
}
