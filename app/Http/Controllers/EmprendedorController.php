<?php

namespace App\Http\Controllers;
use App\constants;
use Illuminate\Http\Request;
use App\Models\emprendedores;
use App\Models\redes;
class EmprendedorController extends Controller{

    public function __construct(){
        $this->middleware('auth');
    }
   public function showEmprendimientos(){
        //VER SI TRAER TODOS LOS DATOS O SOLO IMG, NOMBRE, DESCRIPCION PARA DESPUES
        //SI SE HACE CLICK EN EL EMPRENDIMIENTO SE MUESTREN TODOS LOS DATOS
        $emprendimientos= emprendedores::showEmprendimientos();
        if($emprendimientos!=null){
            return view("emprendedores.emprendedores", compact("emprendimientos"));
        }
        //return view("error");
    }

    public function showEmprendimientoId($id){
        if(is_numeric($id) && $id>constants::VALORMIN){
            $emprendimiento=emprendedores::showEmprendimientoId($id);
            if($emprendimiento!=null){
                return view("emprendedores.emprendedor", compact('emprendimiento'));
            }
        }
        return null; 
        //return view("error"); CREAR VISTA
    }

    public function filterEmprendimientos(Request $request){

        $request->validate([
            'categoria'=>'string|min:1|max:60',
            'nombre'=>'string|min:1|max:100'
        ]);
        $categoria=$request->categoria;
        $nombre=$request->nombre;
        $emprendimientos=emprendedores::filterEmprendimientos($categoria, $nombre);
        
        if(count($emprendimientos)>constants::VALORMIN){
            return view("emprendedores.emprendedores", compact("emprendimientos"));
        }
        else{
            return view("error");
        }
    }

    public function filterEmprendimientosCategoria(Request $request){
        $categoria=$request->categoria;
        $request->validate([
            'categoria'=>'string|min:1|max:60',
        ]);
        $emprendimientos=emprendedores::filterEmprendimientosCategoria($categoria);
        if(count($emprendimientos)>constants::VALORMIN){
           
            return view("emprendedores.emprendedores", compact("emprendimientos"));
        }
        else{
            return view("error");
        }
    }

        public function filterEmprendimientosNombre(Request $request){
        $nombre=$request->nombre;
        $request->validate([
            'nombre'=>'string|min:1|max:100'
        ]);
        $emprendimientos=emprendedores::filterEmprendimientosNombre($nombre);
        
        if(count($emprendimiento)>constants::VALORMIN){
            return view("emprendedores.emprendedores", compact("emprendimientos"));
        }
        else{
            return view("error");
        }
    }

    public function showFormCrearEmprendimiento(){
        return view('administradores.formNuevoEmprendimiento');
    }



}
