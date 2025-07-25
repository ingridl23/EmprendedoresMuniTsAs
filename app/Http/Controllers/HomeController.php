<?php

namespace App\Http\Controllers;

use App\Models\Emprendedor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

//controller para emprendedores  general
class HomeController extends Controller
{

    /* public function __construct()
    {
        $this->middleware('auth');
    }*/

    public function index()
    {
        $ultimos = Emprendedor::traerAleatoriamenteSeis();
        return view('layouts.templateEmprendedoreshome', compact('ultimos'));
    }


    public function showlogin()
    {
        return view("auth.login");
    }
}
