<?php

namespace App\Http\Controllers;

use App\constants;
use App\Models\Noticias;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;

class noticiasController extends Controller
{


    public function showNoticias()
    {

        $noticias = Noticias::getUltimasNoticias();
        return view('layouts.noticias', compact('noticias'))
            ->with('i', (request()->input('page', 1) - 1) * $noticias->perPage());
    }


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

    /*Filtro de busqueda de noticias por titulo*/
    public function filterNoticiasByTittle(Request $request)
    {
        $busqueda = $request->query('busqueda');
        $noticias = Noticias::where('titulo', 'LIKE', '%' . $busqueda . '%')
            // ->orWhere('categoria', 'LIKE', '%' . $busqueda . '%')
            ->get();
        return response()->json($noticias);
    }
    /*Filtro de busqueda de noticias por categoria*/
    public function filterNoticiasByCategory(Request $request)
    {
        $busqueda = $request->query('busqueda');
        $noticias = Noticias::where('categoria', 'LIKE', '%' . $busqueda . '%')
            // ->orWhere('categoria', 'LIKE', '%' . $busqueda . '%')
            ->get();
        return response()->json($noticias);
    }

    /*Filtro de busqueda de noticias por fecha*/
    public function filterNoticiasByDate(Request $request)
    {
        $busqueda = $request->query('busqueda');
        $noticias = Noticias::where('created_at', 'LIKE', '%' . $busqueda . '%')
            // ->orWhere('categoria', 'LIKE', '%' . $busqueda . '%')
            ->get();
        return response()->json($noticias);
    }
    public function showFormCrearNoticia()
    {
        return view('administradores.noticias.formNuevaNoticia');
    }
}
