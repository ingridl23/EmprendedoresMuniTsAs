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


    public static function crearHorario($dia, $hora_apertura, $hora_cierre, $participa_feria, $cerrado, $emprendedor_id)
    {
        $horario = new Horario();
        $horario->dia = $dia;
        $horario->hora_apertura = $hora_apertura;
        $horario->hora_cierre = $hora_cierre;
        $horario->participa_feria = $participa_feria;
        $horario->cerrado = $cerrado;
        $horario->emprendedor_id = $emprendedor_id;
        $horario->save();

        return $horario->id;
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
