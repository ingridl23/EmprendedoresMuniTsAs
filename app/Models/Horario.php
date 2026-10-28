<?php

namespace App\Models;

use App\Models\Emprendedor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



/**
 * @class Horario
 *
 * Representa un horario dentro del sistema.
 *
 * @package App\Models
 * @property int $emprendedor_id Identificador único
 * @property string $dia Nombre del dia
 * @property \Carbon\Carbon|null $hora_apertura hora de inicio
 * @property \Carbon\Carbon|null $hora_cierre hora de cierre
 * @property boolean $participa_feria  si participa de ferias o eventos
 * @property boolean $cerrado si permanece cerrado
 * @property \Carbon\Carbon $created_at Fecha de creación
 * @property \Carbon\Carbon $updated_at Fecha de última actualización
 *
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Horario extends Model
{
    use HasFactory;

    /** @var string $table Nombre de la tabla asociada */
    protected $table = 'horario'; //  tabla

    /** @var array<int, string> $fillable Atributos asignables de forma masiva */
    protected $fillable = [
        'dia',
        'hora_apertura',
        'hora_cierre',
        'participa_feria',
        'cerrado',
        'emprendedor_id',
    ];

    /**
     * Relación: un horario pertenece a un emprendimiento/emprendedor.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function AsociarEmprendedor()
    {
        return $this->belongsTo(Emprendedor::class, 'emprendedor_id');
    }

    /**
     *  Dar de alta horarios:
     *
     *  Una vez validados los datos del formulario se deben persistir,asociandolos a un emprendimiento/emprendedor.
     *
     * @param string $dia
     * @param \Carbon\Carbon|string|null $hora_apertura
     * @param \Carbon\Carbon|string|null $hora_cierre
     * @param boolean $participa_feria
     * @param boolean $cerrado
     * @param int $emprendedor_id
     * @return int Devuelve el ID del horario creado asociado a un emprendimiento.
     * @throws \Exception Si ocurre un error al persistir los datos en el sistema.
     */
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



    /**
     * Visualizar horarios:
     *
     * @param int $id ID del emprendimiento seleccionado.
     * @return \Illuminate\Database\Eloquent\Collection Devuelve los horarios asociados a un emprendimiento seleccionado.
     */
    public static function obtenerHorarios($id)
    {
        $horarios =  Horario::where('emprendedor_id', $id)->get();
        return $horarios;
    }


    /**
     * Modificar horarios:
     *
     * @param Horario $horario Horario modificado.
     * @return bool Devuelve true si el horario se guardó.
     */

    public static function editarHorarios(Horario $horario)
    {
        return $horario->save();
    }


    /**
     * Realizar busqueda de emprendimiento :
     *
     * @param int $idEmprendedor ID de identificacion para el emprendimiento seleccionado.
     * @return \Illuminate\Database\Eloquent\Collection Devuelve los horarios de un emprendimiento seleccionado.
     */

    public static function buscarPorIdEmprendedor($idEmprendedor)
    {
        $horarios = Horario::where('horario.emprendedor_id', $idEmprendedor)->get();
        return $horarios;
    }


    /**
     * Dar de baja un emprendimiento :
     *
     * @param \Illuminate\Database\Eloquent\Collection $horarios Horarios del emprendimiento a eliminar.
     * @return bool Devuelve true si se eliminaron todos los horarios.
     */
    public static function eliminarHorarios($horarios)
    {
        $totalHorarios = count($horarios);
        $totalEliminados = 0;
        foreach ($horarios as $horario) {
            $eliminado = $horario->delete();
            if ($eliminado) {
                $totalEliminados++;
            }
        }
        if ($totalEliminados == $totalHorarios) {
            return true;
        } else {
            return false;
        }
    }
};
