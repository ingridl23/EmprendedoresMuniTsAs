<?php

namespace App\Http\Controllers;

use App\constants;
use App\Models\Noticias;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;

/**
 * @class noticiasController
 *
 * @brief Controlador para la gestión y visualizacion depublicaciones del sistema.
 *
 * Este controller define las funcionalidades que puede realizar un usuario administrador sobre publicaciones del sitema como tambien algunas extras que pueden acceder los usuarios generales.
 *
 *
 * @package App\Http\Controllers
 */
class noticiasController extends Controller
{

    /**
     * Visualizar las publicaciones vigentes en el sistema:
     * @return \Illuminate\Http\RedirectResponse Redirige al usuario hacia la seccion de ultimas publicaciones .
     */
    public function showNoticias()
    {

        $noticias = Noticias::getUltimasNoticias();
        return view('layouts.noticias', compact('noticias'))
            ->with('i', (request()->input('page', 1) - 1) * $noticias->perPage());
    }


    /**
     * Visualizar una publicacion seleccionada:
     *
     *@return \Illuminate\Http\RedirectResponse Redirige al usuario hacia la seccion de la publicacion seleccionada .
     *
     */
    public function showNoticia($id)
    {
        if (is_numeric($id) && $id > constants::VALORMIN) {
            $noticia = Noticias::showNoticiasId($id);
            if ($noticia != null) {
                return view("layouts.noticia", compact('noticia'));
            }
        }
    }


    /**
     * Realizar una busqueda de una publicacion en especifica:
     * Validar los datos ingresados desde el formulario de busqueda y retorna los resultados que coincidan con los criterios propuestos por el usuario.
     *@return Response, devuelve al usuario una/s publicacion/es que coincidan con la busuqeda realizada, aplicando el campo "titulo".
     *


    /*Filtro de busqueda de noticias por titulo*/
    public function filterNoticiasByTittle(Request $request)
    {
        $busqueda = $request->query('busqueda');
        $noticias = Noticias::where('titulo', 'LIKE', '%' . $busqueda . '%')
            // ->orWhere('categoria', 'LIKE', '%' . $busqueda . '%')
            ->get();
        return response()->json($noticias);
    }

    /**
     * Realizar una busqueda de una publicacion en especifica:
     * Validar los datos ingresados desde el formulario de busqueda y retorna los resultados que coincidan con los criterios propuestos por el usuario.
     *@return Response, devuelve al usuario una/s publicacion/es que coincidan con la busuqeda realizada, aplicando el campo "categoria".
     *

    /*Filtro de busqueda de noticias por categoria*/
    public function filterNoticiasByCategory(Request $request)
    {
        $busqueda = $request->query('busqueda');
        $noticias = Noticias::where('categoria', 'LIKE', '%' . $busqueda . '%')
            // ->orWhere('categoria', 'LIKE', '%' . $busqueda . '%')
            ->get();
        return response()->json($noticias);
    }

    /**
     * Realizar una busqueda de una publicacion en especifica:
     * Validar los datos ingresados desde el formulario de busqueda y retorna los resultados que coincidan con los criterios propuestos por el usuario.
     *@return Response, devuelve al usuario una/s publicacion/es que coincidan con la busuqeda realizada, aplicando el campo "fecha".
     *

    /*Filtro de busqueda de noticias por fecha*/
    public function filterNoticiasByDate(Request $request)
    {
        $busqueda = $request->query('busqueda');
        $noticias = Noticias::where('created_at', 'LIKE', '%' . $busqueda . '%')
            // ->orWhere('categoria', 'LIKE', '%' . $busqueda . '%')
            ->get();
        return response()->json($noticias);
    }

    /**
     * Dar de alta una publicacion en el sistema:
     *  Validar los datos ingresados desde el formulario de busqueda y persistirlos en el sistema segun la logica de negocio..
     *@return Response, devuelve al usuario con rol de administrador la seccion de alta de publicaciones del sistema.
     **/
    public function showFormCrearNoticia()
    {
        return view('administradores.noticias.formNuevaNoticia');
    }
}
