<?php

namespace App\Http\Controllers;
use App\Models\emprendedores;
use Emprendedores as GlobalEmprendedores;
use Illuminate\Http\Request;

class EmprendedorController extends Controller
{
    public function productos($id) {} // devolvera un listado de productos

    public function ubicacion() {} // devolvera la seccion de contacto del emprendedor

    public function info() {} // defolvera informacion del emprendedor

    public function getEmprendimientos(){
        $emprendimientos = emprendedores::with('redes')->paginate(20);
        return view('emprendedores.filterEmprendedores')->with('emprendimientos', $emprendimientos);
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
}
