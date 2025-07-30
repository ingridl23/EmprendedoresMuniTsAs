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
        'hora_apertura',
        'hora_cierre',
        'participa_feria',
        'cerrado',
        'emprendedor_id',
    ];


    public function AsociarEmprendedor()
    {
        return $this->belongsTo(Emprendedor::class, 'emprendedor_id');
    }


    public static function crearHorario($dia, $hora_apertura, $hora_cierre, $participa_feria, $cerrado, $emprendedor_id)
    {
        $horario =  Horario::create([

            'dia' => $dia,
            'hora_apertura' => $hora_apertura,
            'hora_cierre' => $hora_cierre,
            'participa_feria' => $participa_feria,
            'cerrado' => $cerrado,
            'emprendedor_id' => $emprendedor_id,

        ]);


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
