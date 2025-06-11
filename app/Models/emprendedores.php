<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\constants;

class emprendedores extends Model
{
    use HasFactory;
    protected $fillable=[
        'nombre',
        'descripcion',
        'categoria',
        'imagen',
        'redes_id',
    ];

    public function redes(): HasOne{
        return $this->hasOne(redes::class);
        //en el controller se puede usar para buscar las redes como $phone = User::find(1)->phone;
    }

    public static function showEmprendimientos(){
        $emprendimientos= emprendedores::select(['id','nombre','descripcion', 'imagen'])->get();
        if(count($emprendimientos)>constants::VALORMIN){
            return $emprendimientos;
        }
        return null;
    }

    public static function showEmprendimientoId($id){
        $emprendimiento=emprendedores::join('redes', 'redes_id', '=', 'redes.id')->where('emprendedores.id',$id)->get();
        if(count($emprendimiento)>constants::VALORMIN){
            $emprendimiento=$emprendimiento[0];
            return $emprendimiento;
        }
        return null;
    }

    public static function filterEmprendimientos($categoria, $nombre){
         $emprendimientos=emprendedores::query()->when($categoria, function($query, $categoria){
            return $query->where('categoria','like','%'.$categoria.'%');
        })
        ->when($nombre, function($query, $nombre){
            return $query->where('nombre','like','%'.$nombre.'%');
        })
        ->get();
        return $emprendimientos;
    }

     public static function filterEmprendimientosCategoria($categoria){
         $emprendimientos=emprendedores::query()->when($categoria, function($query, $categoria){
            return $query->where('categoria','like','%'.$categoria.'%');
        })->get();
        return $emprendimientos;
    }

        public static function filterEmprendimientosNombre($nombre){
         $emprendimientos=emprendedores::query()->when($nombre, function($query, $nombre){
            return $query->where('nombre','like','%'.$nombre.'%');
        })->get();
        return $emprendimientos;
    }

    
}
