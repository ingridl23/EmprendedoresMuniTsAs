<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Emprendedor;

class direccion extends Model
{
    use HasFactory;

    protected $table = 'direccion'; // tu tabla real

    protected $fillable = [
        'ciudad',
        'localidad',
        'calle',
        'altura'
    ];

    public function emprendedor(): HasOne
    {
        return $this->hasOne(Emprendedor::class, 'direccion_id', 'id');
    }

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

    public static function editarEmprendimiento($direccion)
    {
        $direccion->save();
    }

    public static function eliminarEmprendimiento($direccion)
    {
        $direccion->delete();
    }
}
