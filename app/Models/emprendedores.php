<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class emprendedores extends Model
{
    use HasFactory;

    public function redes(): HasOne{
        return $this->hasOne(redes::class);
        //en el controller se puede usar para buscar las redes como $phone = User::find(1)->phone;
    }

    public static function showEmprendimientos(){
        $emprendimientos= emprendedores::select(['id','nombre','descripcion', 'imagen'])->get();
        return $emprendimientos;
    }
    
}
