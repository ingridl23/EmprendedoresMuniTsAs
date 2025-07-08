<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class noticiasController extends Controller
{

    public function showNoticias()
    {
        return view("layouts.noticias");
    }


    public function showNoticia($id)
    {
        if (is_numeric($id) && $id > constants::VALORMIN) {
            $noticia = noticias::showNoticiasId($id);
            if ($noticia != null) {
                return view("layouts.noticias", compact('noticias'));
            }
        }
    }
}
