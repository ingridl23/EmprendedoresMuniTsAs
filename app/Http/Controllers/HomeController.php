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
        $emprendimientos=Emprendedor::traerAleatoriamenteSeis();
        return view('layouts.templateEmprendedoreshome',compact('emprendimientos'));
    }


    public function showlogin()
    {
        return view("auth.login");
    }

    public function showUltimosEmprendedores()
    {
        $ultimosEmprendedores = Emprendedor::ultimosEmprendedores(); // método nuevo
        return view('layouts.templateEmprendedoresHome', compact('ultimosEmprendedores'));
        dd(Emprendedor::ultimosEmprendedores());
    }
}
