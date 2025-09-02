<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\imagenesFactory;
use App\Models\Emprendedor;

/**
 * @class Imagenes
 *  Representa una imagen dentro del sistema.
 *
 * @package App\Models
 * @property $img_id , Identificador unico de la imagen
 * @property $emprendedor_id, Identificador unico del emprendimiento.
 * @property $url , ruta de almacenamiento para el recurso.
 *
 * @property $created_at , fechas de alta
 * @property $updated_at , fecha de modificacion
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Imagenes extends Model
{

    /** @var string $table Nombre de la tabla asociada */
    protected $table = 'imagenes'; //  tabla real


    protected static function newFactory()
    {
        return ImagenesFactory::new();
    }
    use HasFactory;
    /** @var array $fillable Campos asignables en masa */
    protected $fillable = [
        'id',
        'url',
        'public_id',
        'emprendedor_id',



    ];


    /**
     * Relación: una imagen pertenece a un emprendimiento.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function EmprendedorImagen()
    {
        return $this->belongsTo(Emprendedor::class, 'emprendedor_id');
    }

    /**
     * Busqueda de un emprendimiento en relacion a su imagen en el sistema:
     *@param mixed $id_emprendedor, ID de identificacion para el emprendimiento seleccionado
     * @return \Illuminate\Database\Eloquent\Collection , devuelve la coleccion encontrada de imagenes asociadas al emprendimiento seleccionado.
     */

    public static function find($id_emprendedor)
    {
        $imagenes = Imagenes::where("emprendedor_id", $id_emprendedor)->get();
        return $imagenes;
    }


    public static function buscar($id_emprendedor)
    {
        $imagenes = Imagenes::where("emprendedor_id", $id_emprendedor)->get();
        return $imagenes;
    }

    /**
     * Dar de baja un emprendimiento en relacion a su imagen en el sistema:
     *@param  Imagenes $imagen, imagen selecionada para eliminar.
     * @return Response , devuelve la imagen asociada al emprendimiento seleccionado.
     */

    public static function eliminarImagen(Imagenes $imagen)
    {
        $imagen->delete();
    }
}
