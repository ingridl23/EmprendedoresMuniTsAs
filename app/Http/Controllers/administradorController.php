<?php

namespace App\Http\Controllers;

use App\Http\Requests\validacionCrearEmprendimiento;
use App\Http\Controllers\EmprendedorController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\user;
use App\Models\emprendedores;
use App\Models\redes;
use Illuminate\Support\Str;

class administradorController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('can:crear emprendimiento',[
            'only'=>[
                'crearEmprendimiento','showFormCrearEmprendimiento'
            ]
        ]);
        $this->middleware('can:editar emprendimiento',[
            'only'=>[
                'editarEmprendimiento','mostrarFormularioEditar'
            ]
        ]);
        $this->middleware('can:eliminar emprendimiento',[
            'only'=>[
                'eliminarEmprendimiento'
            ]
        ]);
    }
     public function showFormCrearEmprendimiento(){
        return view('administradores.formNuevoEmprendimiento');
    }

    public function crearEmprendimiento(validacionCrearEmprendimiento $request){
        $redes= redes::create([
            'instagram'=> $request->instagram,
            'facebook' => $request->facebook,
            'whatsapp' => $request->whatsapp,
        ]);

        $imagen=$request->file("imagen");
        $nombreImagen=Str::slug($request->nombre).uniqid().".".$imagen->guessExtension();
        $ruta=public_path("img/emprendimientos/");
        $imagen->move($ruta,$nombreImagen);
        $url=$ruta.$nombreImagen;

        $emprendimiento= emprendedores::create([
            'nombre' => $request->nombre,
            'categoria' => $request->categoria,
            'descripcion' => $request->descripcion,
            'imagen' => $url,
            'redes_id'=>$redes->id,
        ]);

       return redirect('/emprendimientos');
    }
}
