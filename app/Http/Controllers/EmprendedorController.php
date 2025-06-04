<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\emprendedores;
use App\Models\redes;
class EmprendedorController extends Controller{
   public function showEmprendimientos(){
        $emprendimientos= emprendedores::showEmprendimientos();
        //VER SI TRAER TODOS LOS DATOS O SOLO IMG, NOMBRE, DESCRIPCION PARA DESPUES
        //SI SE HACE CLICK EN EL EMPRENDIMIENTO SE MUESTREN TODOS LOS DATOS
        return view("emprendedores.emprendedores", compact("emprendimientos"));
    }

    public function showEmprendimientoId($id){
        $emprendimiento=emprendedores::join('redes', 'redes_id', '=', 'redes.id')->where('emprendedores.id',$id)->get();
        if(isset($emprendimiento)){
            return view("emprendedores.emprendedor", compact('emprendimiento'));
        }
        return view("error"); 
    }

    public function filterEmprendimientos(Request $request){
        if(isset($request->categoria) && isset($request->nombre)){
            //buscar filtro por los dos
        }
        else if(isset($request->categoria) && !isset($request->nombre)){
            //buscar por categoria
        }
        else if(!isset($request->categoria) && isset($request->nombre)){
            //buscar por nombre
        }
        else{
           return $this->showEmprendimientos();
        }
    }



}
