<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class direccion extends Model
{
    use HasFactory;

     protected $table = 'direccion'; // tu tabla real

     protected $fillable = [
        'ciudad',
        'calle',
        'altura'
    ];

    public function emprendedor(): HasOne
    {
        return $this->hasOne(Emprendedor::class, 'direccion_id', 'id');
    }

    public function crearDireccion($ciudad, $calle, $altura){
        $direccion=direccion::create([
            'ciudad' =>$ciudad,
            'calle' =>$calle,
            'altura' =>$altura,
        ]);
        return $direccion->id;
    }

    public function editarEmprendimiento($direccion){
        $direccion->save();
    }

    public function eliminarEmprendimiento($direccion){
        $direccion->delete();
    }
}
