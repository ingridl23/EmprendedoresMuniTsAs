<?php

namespace App\Http\Controllers;

use App\Http\Requests\validacionNuevoEmprendimiento;
use App\Http\Requests\validacionEditarEmprendimiento;
use App\Http\Controllers\EmprendedorController;
use App\Http\Controllers\DireccionController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\user;
use App\Models\Emprendedor;
use App\Models\redes;
use App\Models\direccion;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\constants;

class administradorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:crear emprendimiento', [
            'only' => [
                'crearEmprendimiento',
                'showFormCrearEmprendimiento'
            ]
        ]);
        $this->middleware('can:ver emprendimiento', [
            'only' => [
                'emprendedores'
            ]
        ]);
        $this->middleware('can:editar emprendimiento', [
            'only' => [
                'editarEmprendimiento',
                'showFormEditarEmprendimiento'
            ]
        ]);
        $this->middleware('can:eliminar emprendimiento', [
            'only' => [
                'eliminarEmprendimiento'
            ]
        ]);
    }

    public function emprendedores(){
        $emprendedores = Emprendedor::paginate(10);
        return view('emprendedor.index', compact('emprendedores'))
            ->with('i', (request()->input('page', 1) - 1) * $emprendedores->perPage());
        
        // return view("emprendedor.index", compact("emprendedores"));
    }

    public function showFormCrearEmprendimiento()
    {
        return view('administradores.formNuevoEmprendimiento');
    }

    public function crearEmprendimiento(validacionNuevoEmprendimiento $request)
    {
        $imagen = $request->file("imagen");
        $path = $imagen->store('img', 'public');
        Emprendedor::crearEmprendimiento($request, $path);
        return redirect('/emprendedores');
    }

    public function showFormEditarEmprendimiento($id)
    {
        if (is_numeric($id) && $id > constants::VALORMIN) {
            $emprendimiento = Emprendedor::showEmprendimientoId($id);
            if ($emprendimiento != null) {
                return view("administradores.formEditarEmprendimiento", compact('emprendimiento'));
            }
        };

        return view("/error");
    }

    public function editarEmprendimiento($id, validacionEditarEMprendimiento $request)
    {
        $emprendimiento = Emprendedor::find($id);
        $redes = redes::find($emprendimiento->redes_id);
        $direccion = direccion::find($emprendimiento->direccion_id);
        if ($redes != null && $emprendimiento != null) {
            if ($redes->instagram != $request->input('instagram') || $redes->facebook != $request->input('facebook')
                || $redes->whatsapp != $request->input('whatsapp')) {
                $redes->instagram = $request->input('instagram');
                $redes->facebook = $request->input('facebook');
                $redes->whatsapp = $request->input('whatsapp');
            }
            if ($direccion->ciudad != $request->input('ciudad') || $direccion->localidad !=$request->input('localidad') || $direccion->calle != $request->input('calle')
                || $direccion->altura != $request->input('altura')) {
                $direccion->ciudad = $request->input('ciudad');
                $direccion->localidad=$request->input('localidad');
                $direccion->calle = $request->input('calle');
                $direccion->altura = $request->input('altura');
            }
            if ($request->file('imagen') != null) {
                Storage::disk('public')->delete($emprendimiento->imagen);
                $imagen = $request->file("imagen");
                $path = $imagen->store('img', 'public');
                $emprendimiento->imagen = $path;
            }
            $emprendimiento->nombre = $request->input('nombre');
            $emprendimiento->descripcion = $request->input('descripcion');
            $emprendimiento->categoria = $request->input('categoria');

            Emprendedor::editarEmprendimiento($emprendimiento);
            redes::editarEmprendimiento($redes);
            direccion::editarEmprendimiento($direccion);
            return redirect('/emprendedores');
        }
        //return view("/");
        //return redirect("emprendedores.emprendedor", compact('emprendimiento'));
    }

    public function eliminarEmprendimiento($id)
    {
        $emprendimiento = Emprendedor::find($id);
        if ($emprendimiento != null) {
            $redes = redes::find($emprendimiento->redes_id);
            $direccion = direccion::find($emprendimiento->direccion_id);
            if ($redes != null && $direccion) {
                Storage::disk('public')->delete($emprendimiento->imagen);
                Emprendedor::eliminarEmprendimiento($emprendimiento);
                redes::eliminarEmprendimiento($redes);
                direccion::eliminarEmprendimiento($direccion);
                return redirect('/');
            }
        }
        //return redirect("/error", "Emprendimiento incorrecto, ingrese uno válido");
    }
}
