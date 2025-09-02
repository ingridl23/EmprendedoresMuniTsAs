<?php

namespace App\Http\Controllers;

use App\Models\Emprendedor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

/**
 * @class HomeController
 *
 * @brief Controlador para la visualizacion del login y la homepage del sistema.
 *
 * Este controller define las 2 secciones mas importantes del sistema, la vista al acceso de usuario con roles y la presentacion del negocio.
 *
 * @package App\Http\Controllers
 */


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
