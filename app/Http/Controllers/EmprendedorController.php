<?php

namespace App\Http\Controllers;
use App\constants;
use emprendedores as GlobalEmprendedores;
use Illuminate\Http\Request;
use App\Models\emprendedores;
use App\Models\redes;
class EmprendedorController extends Controller{

    public function __construct(){
        $this->middleware('auth');
    }

    public function getEmprendimientos(){
        $emprendimientos = emprendedores::showEmprendimientos();
        if($emprendimientos!=null){
            return view('emprendedores.filterEmprendedores')->with('emprendimientos', $emprendimientos);
        }
        return view("errors.mensaje")->with('mensaje', "No se encuentra cargado ningún emprendimiento");
    }

    /*Filtro de busqueda de emprendedores por nombre*/
    public function filterEmprendimientosByName(Request $request){
        $busqueda = $request->query('busqueda');
        $emprendimientos = emprendedores::with('redes')
        ->where('nombre', 'LIKE', '%' . $busqueda . '%')
        // ->orWhere('categoria', 'LIKE', '%' . $busqueda . '%')
        ->get();
        return response()->json($emprendimientos);
    }

    public function showEmprendimientoId($id){
        if(is_numeric($id) && $id>constants::VALORMIN){
            $emprendimiento=emprendedores::showEmprendimientoId($id);
            if($emprendimiento!=null){
                return view("emprendedores.emprendedor", compact('emprendimiento'));
            }
        }
         return view("errors.mensaje")->with('mensaje', "No se encuentra cargado ningún emprendimiento");; 
    }

    public function showFormCrearEmprendimiento(){
        return view('administradores.formNuevoEmprendimiento');
    }

}
