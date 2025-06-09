<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;

//controller para emprendedores  general
class HomeController extends Controller
{



    public function index()
    {

        return view('layouts.templateEmprendedoreshome');
    }
}
