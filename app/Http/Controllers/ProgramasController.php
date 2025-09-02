<?php

namespace App\Http\Controllers;

use App\Http\Controllers\EmprendedorController;
use App\Models\Emprendedor;
use Illuminate\Http\Request;

class ProgramasController extends Controller
{

    /**
     * @class ProgramasController
     *
     * @brief Controlador para la presentacion de programas vigentes segun la logica de negocio.
     *
     * @package App\Http\Controllers
     */
    /**
     * @return \Illuminate\Http\RedirectResponse redirige la informacion a la seccion de programas retornando los ultimos emprendedores cargados aleatoriamente.
     */
    public function ShowPrograma()
    {

        // 1.1) Traigo los últimos 6 emprendedores
        $ultimos = Emprendedor::traerAleatoriamenteSeis();
        //  dd($ultimos->pluck('nombre')->toArray());

        // 1.2) Le paso $ultimos a la vista programas
        return view('layouts.programas', compact('ultimos'));
    }
}
