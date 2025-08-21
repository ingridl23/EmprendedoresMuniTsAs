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

    public static function obtenerHorarios($id){
        $horarios =  Horario::where('emprendedor_id', $id)->get();
        return $horarios;
    }

    public static function editarHorarios(Horario $horario)
    {
        return $horario->save();

    }

    public static function buscarPorIdEmprendedor($idEmprendedor){
        $horarios = Horario::where('horario.emprendedor_id', $idEmprendedor)->get();
        return $horarios;
    }


    public static function eliminarHorarios($horarios)
    {
        $totalHorarios = count($horarios);
        $totalEliminados = 0;
        foreach ($horarios as $horario) {
            $eliminado = $horario->delete();
            if($eliminado){
                $totalEliminados++;
            }
        }
        if($totalEliminados == $totalHorarios){
            return true;
        }
        else{
            return false;
        }
        
    }
};
