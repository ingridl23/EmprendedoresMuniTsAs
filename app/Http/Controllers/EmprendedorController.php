<?php

namespace App\Http\Controllers;

use App\Models\Emprendedor;
use App\Http\Requests\EmprendedorRequest;
use App\constants;

/**
 * Class EmprendedorController
 * @package App\Http\Controllers
 */
class EmprendedorController extends Controller
{

    public function emprendedores()
    {
        $emprendedores = Emprendedor::paginate(10);
        return view('emprendedor.templateEmprendedores', compact('emprendedores'))
            ->with('i', (request()->input('page', 1) - 1) * $emprendedores->perPage());
        
    }

        /*Filtro de busqueda de emprendedores por nombre*/
    public function filterEmprendimientosByName(Request $request){
        $busqueda = $request->query('busqueda');
        $emprendimientos = Emprendedor::with('redes')
        ->where('nombre', 'LIKE', '%' . $busqueda . '%')
        // ->orWhere('categoria', 'LIKE', '%' . $busqueda . '%')
        ->get();
        //return response()->json($emprendimientos);
    }

    public function showEmprendimientoId($id){
        if(is_numeric($id) && $id>constants::VALORMIN){
            $emprendimiento=Emprendedor::showEmprendimientoId($id);
            if($emprendimiento!=null){
                return view("emprendedor.templateEmprendedor", compact('emprendimiento'));
            }
        }
         //return view("errors.mensaje")->with('mensaje', "No se encuentra cargado ningún emprendimiento");; 
    }

    public function showFormCrearEmprendimiento(){
        return view('administradores.formNuevoEmprendimiento');
    }
    
}
