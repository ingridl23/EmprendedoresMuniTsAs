<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @class Redes
 * Representa las redes sociales de un emprendimiento/emprendedor dentro del sistema.
 *
 * @package App\Models
 * @property $id
 * @property $redes_id
 * @property $created_at
 * @property $updated_at
 * @property $instagram
 * @property $facebook
 * @property $whatsapp
 * @package App\Models
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Redes extends Model
{
    use HasFactory;

    /** @var string $table Nombre de la tabla asociada */
    protected $table = 'redes'; // tu tabla real
    /** @var array $fillable Campos asignables en masa */
    protected $fillable = [
        'instagram',
        'facebook',
        'whatsapp'
    ];


    /**
     * Relacion emprendedor y sus redes sociales:
     * Un emprendimiento/emprendedor puede tener varias redes sociales de como medio de comunicacion con sus clientes, pero las redes sociales pertenecen a un emprendimiento/emprendedor en particular.
     * @return \Illuminate\Database\Eloquent\Relations\hasOne , devuelve la coleccion encontrada de redes sociales.
     */
    public function emprendedor(): HasOne
    {
        return $this->hasOne(Emprendedor::class, 'redes_id', 'id');
    }



    /**
     * Modificar las redes sociales vinculadas a un emprendimiento/emprendedor:
     *  Permite al usuario administrador modificar los datos de las redes sociales de un emprendimiento/emprendedor asociado y vigente en el sistema.
     * @param mixed $redes, redes seleccionadas a modificar.
     * @return Response, devuelve el conjunto de redes sociales de un emprendimiento/emprendedor modificado.
     */
    public static function editarEmprendimiento($redes)
    {
        $cadena = "https";
        if (!strpos($redes->instagram, $cadena)) {
            if ($redes->instagram != null || $redes->instagram != "") {
                $redes->instagram = "https://instagram.com/{$redes->instagram}";
            }
        }
        if (!strpos($redes->facebook, $cadena)) {
            if ($redes->facebook != null || $redes->facebook != "") {
                $redes->facebook = "https://facebook.com/{$redes->facebook}";
            }
        }
        $redesEdit = $redes->save();
        return $redesEdit;
    }


    /**
     * Dar de baja las redes sociales vinculadas a un emprendimiento/emprendedor:
     *  Permite al usuario administrador eliminar los datos de las redes sociales de un emprendimiento/emprendedor asociado y eliminado del sistema.
     * @param mixed $redes, redes seleccionadas para dar de baja.
     * @return Response, devuelve el conjunto de redes sociales de un emprendimiento/emprendedor eliminado.
     */


    public static function eliminarEmprendimiento($redes)
    {
        $redesEliminar = $redes->delete();
        return $redesEliminar;
    }


    /**
     * Dar de alta redes sociales vinculadas a un emprendedor/emprendimiento:
     * Permite al usuario administrador crear y completar los datos de un emprendimiento/emprendedor vinculando la informacion de sus redes sociales.
     * @param mixed $instagram
     * @param mixed $facebook
     * @param mixed $whatsapp
     * @return Response, devuelve el conjunto por id de las redes sociales agregadas en el sistema que estan asociadas a un nuevo emprendimiento/emprendedor.
     */
    public static function crearRedes($instagram, $facebook, $whatsapp)
    {
        if (isset($instagram)) {
            $instagram = "https://instagram.com/{$instagram}";
        }
        if (isset($facebook)) {
            $facebook = "https://facebook.com/{$facebook}";
        }
        $redes = redes::create([
            'instagram' => $instagram,
            'facebook' => $facebook,
            'whatsapp' => $whatsapp,
        ]);
        return $redes->id;
    }
}
