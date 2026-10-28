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
 * @property int $altura descripcion numerica de la calle
 * @property \Carbon\Carbon $created_at Fecha de creación
 * @property \Carbon\Carbon $updated_at Fecha de última actualización
 *
 * @mixin \Illuminate\Database\Eloquent\Builder
 */


class Direccion extends Model
{
    use HasFactory;
    /** @var string $table Nombre de la tabla asociada */
    protected $table = 'direccion'; // tu tabla real

    /** @var array<int, string> $fillable Campos asignables en masa */
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
     * @param string $ciudad
     * @param string $localidad
     * @param string $calle
     * @param int $altura
     * @return int Devuelve el id de la direccion creada asociada a un emprendedor.
     */

    public static function crearDireccion($ciudad, $localidad, $calle, $altura)
    {
        $direccion = Direccion::create([
            'ciudad' => $ciudad,
            'localidad' => $localidad,
            'calle' => $calle,
            'altura' => $altura,
        ]);
        return $direccion->id;
    }



    /**
     * Modificar una direccion en el sistema:
     * @param Direccion $direccion Se recibe la direccion a modificar.
     * @return bool Devuelve true si la direccion se guardó.
     */
    public static function editarEmprendimiento($direccion)
    {
        $direccionEdit = $direccion->save();
        return $direccionEdit;
    }

    /**
     * Dar de baja una direccion en el sistema:
     * @param Direccion $direccion Se recibe la direccion para eliminar.
     * @return bool|null Devuelve true si la direccion se eliminó.
     */

    public static function eliminarEmprendimiento($direccion)
    {
        $direccionEliminar = $direccion->delete();
        return $direccionEliminar;
    }
}
