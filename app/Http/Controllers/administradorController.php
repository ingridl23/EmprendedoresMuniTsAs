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
        $path = $imagen->store('img', 'public');

        $emprendimiento= emprendedores::create([
            'nombre' => $request->nombre,
            'categoria' => $request->categoria,
            'descripcion' => $request->descripcion,
            'imagen' => $path,
            'redes_id'=>$redes->id,
        ]);

       return redirect('/emprendimientos');
    }

    public function showFormEditarEmprendimiento($id){
        $emprendimiento=emprendedores::find($id);
        return view("administradores.formNuevoEmprendimiento", compact('emprendimiento'));
    }

    public function editarEmprendimiento($id, validacionCrearEmprendimiento $request){
        $emprendimiento=emprendedores::showEmprendimientoId($id);
        $redes= redes::find($emprendimiento->redes_id);
        if($redes->instagram != $request->input('instagram') || $redes->facebook != $request->input('facebook')
            || $redes->whatsapp != $request->input('whatsapp')){
                $redes->instagram=$request->input('instagram');
                $redes->facebook=$request->input('facebook');
                $redes->whatsapp=$request->input('whatsapp');
                $redes->save();
            }
        
        if($emprendimiento->imagen != $request->input('imagen')){
            $imagen=$request->file("imagen");
            $path = $imagen->store('img', 'public');
            $emprendimiento->imagen=$path;
        }
        
        $emprendimiento->nombre=$request->input('nombre');
        $emprendimiento->descripcion=$request->input('descripcion');
        $emprendimiento->categoria=$request->input('categoria');
        $emprendimiento->save();
        
       return redirect('/emprendimientos');
    }
}
