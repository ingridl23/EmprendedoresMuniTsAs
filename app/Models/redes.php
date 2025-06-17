<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Redes extends Model{
    use HasFactory;
    protected $table = 'redes'; // tu tabla real

     public function emprendedor(): HasOne{
    return $this->hasOne(Emprendedor::class, 'redes_id', 'id');
    }
    
    protected $fillable=[
        'instagram',
        'facebook',
        'whatsapp',
    ];

    public static function editarEmprendimiento($redes){
        $redes->save();
    }

    public static function eliminarEmprendimiento($redes){
        $redes->delete();
    }
}
