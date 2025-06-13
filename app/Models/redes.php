<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class redes extends Model
{
    use HasFactory;

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
