<?php

namespace App\Http\Controllers;

use App\Http\Controllers\EmprendedorController;
use App\Models\Emprendedor;
use Illuminate\Http\Request;

class ProgramasController extends Controller
{

    public function ShowPrograma()
    {
        // return view("layouts.programas");
        // 1.1) Traigo los últimos 6 emprendedores
        $ultimos = Emprendedor::ultimosEmprendedores();
        //  dd($ultimos->pluck('nombre')->toArray());

        // 1.2) Le paso $ultimos a la vista programas
        return view('layouts.programas', compact('ultimos'));
    }
}
