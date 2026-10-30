<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\ImagenesFactory;
use App\Models\Emprendedor;

/**
 * @class Imagenes
 *  Representa una imagen dentro del sistema.
 *
 * @package App\Models
 * @property int $id Identificador unico de la imagen
 * @property int $emprendedor_id Identificador unico del emprendimiento.
 * @property string|null $url Ruta de almacenamiento para el recurso.
 * @property string|null $public_id Identificador de la imagen en Cloudinary.
 *
 * @property \Carbon\Carbon|null $created_at Fecha de alta
 * @property \Carbon\Carbon|null $updated_at Fecha de modificacion
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
    /** @var array<int, string> $fillable Campos asignables en masa */
    protected $fillable = [
        'id',
        'url',
        'public_id',
        'emprendedor_id',



    ];


    /**
     * Relación: una imagen pertenece a un emprendimiento.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function EmprendedorImagen()
    {
        return $this->belongsTo(Emprendedor::class, 'emprendedor_id');
    }

    /**
     * Dar de baja un emprendimiento en relacion a su imagen en el sistema:
     * @param Imagenes $imagen Imagen selecionada para eliminar.
     * @return bool|null Devuelve true si la imagen se eliminó.
     */

    public static function eliminarImagen(Imagenes $imagen)
    {
        return $imagen->delete();
    }
}
