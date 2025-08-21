<?php

namespace App\Http\Controllers;

use App\Models\Emprendedor;
use App\Models\categoria;
use App\Http\Requests\EmprendedorRequest;
use App\constants;
use Illuminate\Http\Request;


/**
 * Class EmprendedorController
 * @package App\Http\Controllers
 */
class EmprendedorController extends Controller
{

    public function emprendedores()
    {
        $emprendedoresPorCategoria = Emprendedor::obtenerCategoriasEmprendedoresAgrupados();
        $categorias = categoria::obtenerCategorias();
        $emprendedores = Emprendedor::with('imagenes')->get();
        //  return response()->json($emprendedores);
        return view('emprendedor.templateEmprendedores', compact('emprendedoresPorCategoria', 'emprendedores', 'categorias'));
    }

    /*Filtro de busqueda de emprendedores por nombre*/
    public function filterEmprendimientosByName(Request $request)
    {
        $busqueda = $request->query('busqueda');
        $emprendimientos = Emprendedor::with(['redes', 'imagenes','categoria'])
            ->where('nombre', 'LIKE', '%' . $busqueda . '%')
            // ->orWhere('categoria', 'LIKE', '%' . $busqueda . '%')
            ->get();
        return response()->json($emprendimientos);
    }

    public function showEmprendimientoId($id)
    {
        if (is_numeric($id) && $id > constants::VALORMIN) {
            // $emprendimiento = Emprendedor::find($id);
            $emprendimiento = Emprendedor::showEmprendimientoId($id);
            if ($emprendimiento != null) {
                return view("emprendedor.templateEmprendedor", compact('emprendimiento'));
            }
        }
        //return view("errors.mensaje")->with('mensaje', "No se encuentra cargado ningún emprendimiento");
    }


    public function showFormCrearEmprendimiento()
    {
        return view('administradores.formNuevoEmprendimiento');
    }



}
