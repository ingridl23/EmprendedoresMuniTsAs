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
        $emprendimiento=emprendedores::find($id);
        $redesId=$emprendimiento->redes_id;
        if(isset($redesId)){
            $informacionRedes=redes::find($redesId);
            return view("emprendedores.emprendedor", compact("emprendimiento", "informacionRedes"));
        }
        return view("emprendedores.emprendedor", compact("emprendimiento"));
    }



}
