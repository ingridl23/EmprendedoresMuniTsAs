<?php

namespace App\Http\Controllers;

use App\Http\Requests\validacionEmprendimiento;
use App\Http\Requests\validacionEditarEmprendimiento;
use App\Http\Controllers\EmprendedorController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\user;
use App\Models\emprendedores;
use App\Models\redes;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\constants;

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
                'editarEmprendimiento','showFormEditarEmprendimiento'
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

    public function crearEmprendimiento(validacionEmprendimiento $request){
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
        if(is_numeric($id) && $id>constants::VALORMIN){
            $emprendimiento=emprendedores::showEmprendimientoId($id);
            if($emprendimiento!=null){
                return view("administradores.formEditarEmprendimiento", compact('emprendimiento'));
            }
        };
        
        return view("/error");        
    }

    public function editarEmprendimiento($id, validacionEditarEmprendimiento $request){
        $emprendimiento=emprendedores::find($id);
        $redes= redes::find($emprendimiento->redes_id);
        if($redes!=null && $emprendimiento!=null){
            if($redes->instagram != $request->input('instagram') || $redes->facebook != $request->input('facebook')
            || $redes->whatsapp != $request->input('whatsapp')){
                $redes->instagram=$request->input('instagram');
                $redes->facebook=$request->input('facebook');
                $redes->whatsapp=$request->input('whatsapp');
                $redes->save();
            }
            if($request->file('imagen')!=null){
                Storage::disk('public')->delete($emprendimiento->imagen);
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
        return view("/view");
       //return redirect("emprendedores.emprendedor", compact('emprendimiento'));
    }

    public function eliminarEmprendimiento($id){
        $emprendimiento=emprendedores::find($id);
        $redes= redes::find($emprendimiento->redes_id);
    }
}
