<?php

namespace App\Models;

use App\Models\Emprendedor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $table = 'horario'; //  tabla

    protected $fillable = [
        'dia',
        'hora_de_apertura',
        'hora_de_cierre',
        'participa_feria',
        'cerrado',
    ];


    public function AsociarEmprendedor()
    {
        return $this->belongsTo(Emprendedor::class, 'horarios_id', 'id');
    }

    public static function crearHorario($datos)
    {
        // Validar campos obligatorios
        return self::create([
            'dia' => $datos['dia'],
            'hora_de_apertura' => $datos['hora_de_apertura'],
            'hora_de_cierre' => $datos['hora_de_cierre'],
            'participa_feria' => $datos['participa_feria'] ?? false,
            'cerrado' => $datos['cerrado'] ?? false,
            'emprendedor_id' => $datos['emprendedor_id'],
        ]);
    }

    public static function editarHorarios(Horario $horario, $datos)
    {

        $horario->update([
            'hora_de_apertura' => $datos['hora_de_apertura'],
            'hora_de_cierre' => $datos['hora_de_cierre'],
            'participa_feria' => $datos['participa_feria'] ?? false,
            'cerrado' => $datos['cerrado'] ?? false,
        ]);

        $horario->save();
    }


    public static function eliminarHorarios(Horario $horario)
    {
        $horario->delete();
    }
};
