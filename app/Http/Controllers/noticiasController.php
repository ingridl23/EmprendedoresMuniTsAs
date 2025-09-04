<?php

namespace App\Http\Controllers;

use App\constants;
use App\Models\Noticias;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;

/**
 * @class noticiasController
 *
 * @brief Controlador para la gestión y visualizacion de publicaciones del sistema.
 *
 * Este controller define las funcionalidades que puede realizar los usuarios sobre las publicaciones del sistema .
 *
 *
 * @package App\Http\Controllers
 */
class noticiasController extends Controller
{

    /**
     * Visualizar las publicaciones vigentes en el sistema:
     * Permite a todos los usuarios acceder a la interfaz funcional de las publicaciones.
     * @return \Illuminate\Http\RedirectResponse Redirige al usuario hacia la seccion de ultimas publicaciones.
     */
    public function showNoticias()
    {

        $noticias = Noticias::getUltimasNoticias();
        return view('layouts.noticias', compact('noticias'))
            ->with('i', (request()->input('page', 1) - 1) * $noticias->perPage());
    }


    /**
     * Visualizar una publicacion seleccionada:
     * Permite a los usuarios interactuar con el sistema, permitiendo la seleccion de una publicacion y el acceso a la informacion detalla de la misma.
     *@return \Illuminate\Http\RedirectResponse Redirige al usuario hacia la seccion de la publicacion seleccionada.
     *
     */
    public function showNoticia($id)
    {
        if (is_numeric($id) && $id > constants::VALORMIN) {
            $noticia = Noticias::showNoticiasId($id);
            if ($noticia != null) {
                return view("layouts.noticia", compact('noticia'));
            }
            else{
                $mensajes = [
                    'titulo' => '¡Error!',
                    'detalle' => 'No se ha encontrado una noticia que coincida, intentelo nuevamente.'
                ];
                return redirect('/noticias')->with('error', $mensajes);
            }
        }
        else{
            $mensajes = [
                    'titulo' => '¡Error!',
                    'detalle' => 'Debe ingresar un número mayor a cero para buscar la noticia.'
                ];
            return redirect('/noticias')->with('error', $mensajes);
        }
    }


    /**
     * Realizar una busqueda de una publicacion:
     * Permite realizar busquedas (atajo visual) a los usuarios del sistema.
     *Se Validan los datos ingresados desde el formulario de busqueda y retorna los resultados que coincidan con los criterios propuestos por el usuario.
     *@return Response, devuelve al usuario una/s publicacion/es que coincidan con la busqueda realizada, aplicando el campo "titulo".
     *
    */

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
     * Realizar una busqueda de una publicacion :
     * Permite realizar busquedas (atajo visual) a los usuarios del sistema.
     * Se  Validan los datos ingresados desde el formulario de busqueda y retorna los resultados que coincidan con los criterios propuestos por el usuario.
     *@return Response, devuelve al usuario una/s publicacion/es que coincidan con la busqueda realizada, aplicando el campo "categoria".
     */

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
     * Realizar una busqueda de una publicacion :
     * Permite realizar busquedas (atajo visual) a los usuarios del sistema.
     * Se Validan los datos ingresados desde el formulario de busqueda y retorna los resultados que coincidan con los criterios propuestos por el usuario.
     *@return Response, devuelve al usuario una/s publicacion/es que coincidan con la busqueda realizada, aplicando el campo "fecha".
     */

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
     *  Se Validan los datos ingresados desde el formulario de busqueda y su persistencia en el sistema segun la logica de negocio.
     *@return Response, devuelve al usuario administrador la seccion de alta de publicaciones del sistema.
     **/
    public function showFormCrearNoticia()
    {
        return view('administradores.noticias.formNuevaNoticia');
    }
}
