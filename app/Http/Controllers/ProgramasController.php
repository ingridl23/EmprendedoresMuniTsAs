<?php

namespace App\Http\Controllers;

use App\Http\Controllers\EmprendedorController;
use App\Models\Emprendedor;
use Illuminate\Http\Request;
use App\Models\Emprendedor;

class ProgramasController extends Controller
{
    public function showProgramas()
    {
         $emprendimientos=Emprendedor::traerAleatoriamenteSeis();
        return view('layouts.programas',compact('emprendimientos'));
    }

    public function showEmprendedores()
    {
        $ultimosEmprendedores = Emprendedor::ultimosEmprendedores(); // método nuevo
        return view('layouts.programas', compact('ultimosEmprendedores'));
        dd(Emprendedor::ultimosEmprendedores());
    }
}
