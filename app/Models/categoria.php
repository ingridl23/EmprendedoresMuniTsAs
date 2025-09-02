<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Emprendedor;

/**
 * @class Categoria
 *
 * Representa una categoría dentro del sistema.
 *
 * @package App\Models
 * @property int $id Identificador único
 * @property string $categoria Nombre de la categoría
 * @property string|null $descripcion Descripción de la categoría
 * @property string|null $imagen Imagen asociada
 * @property \Carbon\Carbon $created_at Fecha de creación
 * @property \Carbon\Carbon $updated_at Fecha de última actualización
 *
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Categoria extends Model
{
    /** @var string $table Nombre de la tabla asociada */
    protected $table = "categoria";

    use HasFactory;
    /** @var array $fillable Campos asignables en masa */
    protected $fillable = [
        'categoria'
    ];


    /**
     * Relación: una categoría puede tener muchos emprendedores.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function EmprendedorCategoria()
    {
        return $this->hasMany(Emprendedor::class, 'categoria_id', 'id');
    }


    /**
     * Obtener todas las categorías registradas en el sistema.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */

    public static function obtenerCategorias()
    {
        $categorias = categoria::all();
        return $categorias;
    }
}
