<?php

namespace App\Http\Controllers;

use App\Http\Requests\validacionEmprendimiento;
use App\Http\Requests\validacionEditarEmprendimiento;
use App\Http\Controllers\EmprendedorController;
use App\Http\Controllers\DireccionController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\user;
use App\Models\Emprendedor;
use App\Models\Noticias;
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


        //para noticias
        $this->middleware('can:insertar noticia', [
            'only' => [
                'insertarNoticia'
            ]
        ]);

        $this->middleware('can:editar noticia', [
            'only' => [
                'editarNoticia'
            ]
        ]);

        $this->middleware('can:eliminar noticia', [
            'only' => [
                'eliminarNoticia'
            ]
        ]);
    }

    public function emprendedores()
    {
        $emprendedores = Emprendedor::paginate(10);
        return view('emprendedor.index', compact('emprendedores'))
            ->with('i', (request()->input('page', 1) - 1) * $emprendedores->perPage());

        // return view("emprendedor.index", compact("emprendedores"));
    }

    public function showFormCrearEmprendimiento()
    {
        return view('administradores.formNuevoEmprendimiento');
    }

    public function crearEmprendimiento(validacionEmprendimiento $request)
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
                $emprendimiento->redes->instagram=$this->obtenerRedes($emprendimiento->redes->instagram);
                $emprendimiento->redes->facebook=$this->obtenerRedes($emprendimiento->redes->facebook);
                return view("administradores.formEditarEmprendimiento", compact('emprendimiento'));
            }
        };

        return view("/error");
    }

    public function obtenerRedes($redes){
        $redes=rtrim($redes, '/');
        $posicion=strrpos($redes, '/');
        $usuarioNombre=substr($redes, $posicion+1);
        return $usuarioNombre;
    }

    public function editarEmprendimiento($id, validacionEditarEMprendimiento $request)
    {
        $emprendimiento = Emprendedor::find($id);
        $redes = redes::find($emprendimiento->redes_id);
        $redes->instagram=$this->obtenerRedes($redes->instagram);
        $redes->facebook=$this->obtenerRedes($redes->facebook);
        $direccion = direccion::find($emprendimiento->direccion_id);
        if ($redes != null && $emprendimiento != null) {
            if (
                $redes->instagram != $request->input('instagram') || $redes->facebook != $request->input('facebook')
                || $redes->whatsapp != $request->input('whatsapp')) {
                $redes->instagram = "https://instagram.com/{$request->input('instagram')}";
                $redes->facebook = "https://facebook.com/{$request->input('facebook')}";
                $redes->whatsapp = $request->input('whatsapp');
            }
            if (
                $direccion->ciudad != $request->input('ciudad') || $direccion->localidad != $request->input('localidad') || $direccion->calle != $request->input('calle')
                || $direccion->altura != $request->input('altura')
            ) {
                $direccion->ciudad = $request->input('ciudad');
                $direccion->localidad = $request->input('localidad');
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
                return redirect('/emprendedores')->with('success', '¡El emprendimiento ha sido eliminado!');
            }
        }
        //return redirect("/error", "Emprendimiento incorrecto, ingrese uno válido");
    }




    /**************************************** funciones del crud noticias*************************** */

    // visualizar create

    public function showFormCreateNoticia()
    {
        return view("administradores.formCrearNoticia");
    }
    //insertar noticia

    protected function  createNews(validacionEmprendimiento $request)
    {
        $titulo = $request->input("titulo");
        $descripcion = $request->textarea("descripcion");
        $categoria = $request->options("categoria");
        $imagen = $request->file("imagen");
        $path = $imagen->store('img', 'public');
        Noticias::createNews($request, $path);
        return redirect('/noticias');
    }

    //visualizar update

    public function showFormEditarNoticia()
    {
        return view("administradores.formEditarNoticia");
    }
    //editar noticia

    protected function updateNews($id, validacionEditarEMprendimiento $request)
    {


        $noticia = Noticias::find($id);


        if ($noticia != null) {

            if ($request->file('imagen') != null) {
                Storage::disk('public')->delete($noticia->imagen);
                $imagen = $request->file("imagen");
                $path = $imagen->store('img', 'public');
                $noticia->imagen = $path;
            }


            $noticia->titulo = $request->input('titulo');
            $noticia->descripcion = $request->input('descripcion');
            $noticia->categoria = $request->input('categoria');

            Noticias::updateNews($noticia);

            return redirect('/noticias');
        }
    }



    //eliminar noticia

    protected function deleteNewsById($id)
    {
        $noticia = Noticias::find($id);
        if ($noticia != null) {

            Storage::disk('public')->delete($noticia->imagen);
            Noticias::eliminarEmprendimiento($noticia);

            return redirect('/noticias')->with('success', '¡La noticia ha sido eliminada!');
        }
    }
}
