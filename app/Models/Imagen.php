<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\imagenFactory;

/**
 * Class Emprendedor
 *
 * @property $img_id

 * @property $emprendedor_id
 * @property $url
 *
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Imagen extends Model
{


    protected $table = 'imagenes'; //  tabla real


    protected static function newFactory()
    {
        return imagenFactory::new();
    }
    use HasFactory;

    protected $fillable = [
        'img_id',
        'url',
        'emprendedor_id',



    ];


    public function EmprendedorImagen()
    {
        return $this->belongsTo(Emprendedor::class, 'emprendedor_id');
    }
}
