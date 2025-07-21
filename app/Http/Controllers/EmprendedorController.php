<?php

namespace App\Http\Controllers;

use App\Models\Emprendedor;
use App\Http\Requests\EmprendedorRequest;
use App\constants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class EmprendedorController
 * @package App\Http\Controllers
 */
class EmprendedorController extends Controller
{

    public function emprendedores()
    {
        $emprendedoresPorCategoria = Emprendedor::obtenerCategorias();
        return view('emprendedor.templateEmprendedores', compact('emprendedoresPorCategoria'));
    }

    /*Filtro de busqueda de emprendedores por nombre*/
    public function filterEmprendimientosByName(Request $request)
    {
        $busqueda = $request->query('busqueda');
        $emprendimientos = Emprendedor::with('redes')
            ->where('nombre', 'LIKE', '%' . $busqueda . '%')
            // ->orWhere('categoria', 'LIKE', '%' . $busqueda . '%')
            ->get();
        return response()->json($emprendimientos);
    }

    public function showEmprendimientoId($id)
    {
        if (is_numeric($id) && $id > constants::VALORMIN) {
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

    public function obtenerRol()
    {
        $rol = false;
        if (Auth::check() && Auth::user()->hasRole('admin')) {
            $rol = true;
        }
        return response()->json($rol);
    }
}
