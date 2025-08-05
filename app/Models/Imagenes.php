<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\imagenesFactory;
use App\Models\Emprendedor;

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
class Imagenes extends Model
{


    protected $table = 'imagenes'; //  tabla real


    protected static function newFactory()
    {
        return ImagenesFactory::new();
    }
    use HasFactory;

    protected $fillable = [
        'img_id',
        'url',
        'public_id',
        'emprendedor_id',



    ];


    public function EmprendedorImagen()
    {
        return $this->belongsTo(Emprendedor::class, 'emprendedor_id');
    }


    public static function find($id_emprendedor){
        $imagenes=Imagenes::where("emprendedor_id", $id_emprendedor)->get();
        return $imagenes;
    }

}
