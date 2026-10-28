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
 * @property int $id
 * @property string $nombre
 * @property string $asunto
 * @property string $email
 * @property string|null $telefono
 * @property int $edad
 * @property int $dni
 * @property string $ciudad
 * @property string $localidad
 * @property string $formacion
 * @property string|null $nombre_curso
 * @property string|null $description
 * @property string|null $referencia_laboral
 * @property string|null $referencia_rubro
 * @property string|null $referencia_actividad
 * @property string|null $contratista
 * @property string $referencia_telefonica
 * @property bool $cud
 * @property bool $dependencia
 * @property string|null $cv_path
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
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

    /** @var array<int, string> $fillable Campos asignables en masa */
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
