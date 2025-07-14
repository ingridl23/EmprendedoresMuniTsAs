<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProgramasController extends Controller
{
    public function showProgramas()
    {
        return view("layouts.programas");
    }
}
