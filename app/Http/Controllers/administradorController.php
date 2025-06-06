<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class administradorController extends Controller
{
    public function __construct(){
        $this->middleware('can:crear emprendimiento',[
            'only'=>[
                'crearEmprendimiento'
            ]
            ]);
    }
}
