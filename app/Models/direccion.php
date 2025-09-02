<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Emprendedor;


/**
 * @class Direccion
 *
 * Representa una direccion dentro del sistema.
 *
 * @package App\Models
 * @property int $id Identificador único
 * @property string $ciudad Nombre de la ciudad
 * @property string $localidad nombre de la localidad dentro de la ciudad
 * @property string $calle nombre de la calle dentro de la localidad
 * @property int $altura dewcripcion numerica de la calle
 * @property \Carbon\Carbon $created_at Fecha de creación
 * @property \Carbon\Carbon $updated_at Fecha de última actualización
 *
 * @mixin \Illuminate\Database\Eloquent\Builder
 */


class direccion extends Model
{
    use HasFactory;
    /** @var string $table Nombre de la tabla asociada */
    protected $table = 'direccion'; // tu tabla real

    /** @var array $fillable Campos asignables en masa */
    protected $fillable = [
        'ciudad',
        'localidad',
        'calle',
        'altura'
    ];


    /**
     * Relación: una direccion pertenece a un emprendimiento.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function emprendedor(): HasOne
    {
        return $this->hasOne(Emprendedor::class, 'direccion_id', 'id');
    }



    /**
     * Dar de alta una direccion en el sistema:
     *
     * @return response, devuelve una direccion asociada a un emprendedor.
     */

    public static function crearDireccion($ciudad, $localidad, $calle, $altura)
    {
        $direccion = direccion::create([
            'ciudad' => $ciudad,
            'localidad' => $localidad,
            'calle' => $calle,
            'altura' => $altura,
        ]);
        return $direccion->id;
    }



    /**
     * Modificar una direccion en el sistema:
     * @param mixed $direccion, se recibe la direccion a modificar.
     * @return response, devuelve una direccion modificada asociada a un emprendedor.
     */
    public static function editarEmprendimiento($direccion)
    {
        $direccionEdit = $direccion->save();
        return $direccionEdit;
    }

    /**
     * Dar de baja una direccion en el sistema:
     * @param mixed $direccion, se recibe la direccion para eliminar.
     * @return response, devuelve una direccion eliminada asociada a un emprendedor.
     */

    public static function eliminarEmprendimiento($direccion)
    {
        $direccionEliminar = $direccion->delete();
        return $direccionEliminar;
    }
}
