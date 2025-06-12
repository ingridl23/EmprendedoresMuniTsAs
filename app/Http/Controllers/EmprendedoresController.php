<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Emprendedores;  //modelo bbdd
class EmprendedoresController extends Controller
{


    public function emprendedores()
    {
        // cuando conectes modelo, descomentá esto
        // $emprendedores = Emprendedores::all();

        // return view("emprendedor.index", compact("emprendedores"));


        return view("layouts.index");
    }
}
