<?php

namespace App\Http\Controllers;

use App\Http\Controllers\EmprendedorController;
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

        return view('layouts.templateEmprendedoreshome');
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
