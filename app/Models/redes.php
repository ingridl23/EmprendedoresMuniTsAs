<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Redes extends Model
{
    use HasFactory;

    protected $table = 'redes'; // tu tabla real

     protected $fillable = [
        'instagram',
        'facebook',
        'whatsapp'
    ];

    public function emprendedor(): HasOne
    {
        return $this->hasOne(Emprendedor::class, 'redes_id', 'id');
    }
    public static function editarEmprendimiento($redes){
        $cadena="https";
        if(!strpos($redes->instagram, $cadena)){
            $redes->instagram = "https://instagram.com/{$redes->instagram}";
        }
        if(!strpos($redes->facebook, $cadena)){
             $redes->facebook = "https://facebook.com/{$redes->facebook}";
        }
        $redes->save();
    }
    public static function eliminarEmprendimiento($redes){
        $redes->delete();
    }
    public static function crearRedes($instagram, $facebook, $whatsapp){
        if(isset($instagram)){
            $instagram = "https://instagram.com/{$instagram}";
        }
        if(isset($facebook)){
             $facebook = "https://facebook.com/{$facebook}";
        }
        $redes= redes::create([
            'instagram' => $instagram,
            'facebook' => $facebook,
            'whatsapp' => $whatsapp,
        ]);
        return $redes->id;
    }

}