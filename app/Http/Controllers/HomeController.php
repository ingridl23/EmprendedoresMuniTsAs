<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//controller para emprendedores
class HomeController extends Controller
{

    /*funcion cuando solo el controlador contenga una unica funcion */
    public function index()
    {
        return view("welcome");
    }
}
