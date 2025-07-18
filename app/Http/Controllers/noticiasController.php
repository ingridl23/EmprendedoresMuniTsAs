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
                return view("layouts.noticia", compact('noticias'));
            }
        }
    }



    /*Filtro de busqueda de noticias por titulo*/
    public function filterNewByTittle(Request $request)
    {
        $busqueda = $request->query('busqueda');
        $noticias = Noticias::with('id')
            ->where('titulo', 'LIKE', '%' . $busqueda . '%')
            // ->orWhere('categoria', 'LIKE', '%' . $busqueda . '%')
            ->get();
        return response()->json($noticias);
    }


    public function showFormCrearNoticia()
    {
        return view('administradores.formNuevaNoticia');
    }
}
