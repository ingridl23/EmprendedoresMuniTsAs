<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    /*funcion cuando solo el controlador contenga una unica funcion */
    public function invoke()
    {
        return view("welcome");
    }
}
