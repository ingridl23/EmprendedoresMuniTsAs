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


    /**
     * Carga de emprendimietos aleatorios dentor de la homepage:
     * Se devuelve la seccion dentro de la homepage  de los ultimos emprendimientos publicadosdentro del sistema.
     * @return Response , se devuelve y redirige al templeate de la homepage.
     */
    public function index()
    {
        $ultimos = Emprendedor::traerAleatoriamenteSeis();
        return view('layouts.templateEmprendedoreshome', compact('ultimos'));
    }

    /***
     * Login de usuarios:
     * Permite visualizar el formulario de logueo para el ingreso de usuarios con rol de adminstradores .
     * @return Response, interfaz funcional del ingreso por rol al sistema.
     */
    public function showlogin()
    {
        return view("auth.login");
    }
}
