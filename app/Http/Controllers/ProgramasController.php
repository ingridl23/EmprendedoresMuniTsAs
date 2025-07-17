<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Emprendedor;

class ProgramasController extends Controller
{
    public function showProgramas()
    {
         $emprendimientos=Emprendedor::traerAleatoriamenteSeis();
        return view('layouts.programas',compact('emprendimientos'));
    }
}
