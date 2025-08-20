<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Emprendedor;

/**
 * @property $id
 * @property $created_at
 * @property $updated_at
 * @property $nombre
 * @property $descripcion
 * @property $categoria
 * @property $imagen
 *  * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Categoria extends Model
{
    protected $table = "categoria";

    use HasFactory;

    protected $fillable = [
        'categoria'
    ];

    public function EmprendedorCategoria()
    {
        return $this->hasMany(Emprendedor::class);
    }

    public static function obtenerCategorias(){
        $categorias = categoria::all();
        return $categorias;
    }
}
