<?php

namespace App\Http\Controllers;

use App\Http\Requests\validacionEmprendimiento;
use App\Http\Requests\validacionEditarEmprendimiento;
use App\Http\Requests\validacionNoticia;
use App\Http\Requests\validacionEditarNoticia;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\user;
use App\Models\Emprendedor;
use App\Models\Horario;
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
        $this->middleware('can:crear noticia', [
            'only' => [
                'createNoticia',
                'showFormCreateNoticia'
            ]
        ]);

        $this->middleware('can:editar noticia', [
            'only' => [
                'showFormEditNoticia',
                'editNoticia',
            ]
        ]);

        $this->middleware('can:eliminar noticia', [
            'only' => [
                'deleteNoticia'
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
        $categorias = Emprendedor::obtenerCategoriasEmprendedoresAgrupados();
        return view('administradores.formNuevoEmprendimiento', compact('categorias'));
    }



    public function crearEmprendimiento(validacionEmprendimiento $request)
    {
        $data = $request->validated();

        $idRedes = redes::crearRedes(
            $request->instagram,
            $request->facebook,
            $request->whatsapp
        );

        $idDireccion = direccion::crearDireccion(
            $request->ciudad,
            $request->localidad,
            $request->calle,
            $request->altura
        );



        $emprendimiento = Emprendedor::create([
            'nombre' => $data['nombre'],
            'categoria' => $data['categoria'],
            'descripcion' => $data['descripcion'],
            'redes_id' => $idRedes,
            'direccion_id' => $idDireccion,
        ]);

        foreach ($request->horarios as $dia => $datos) {
            $hora_apertura = $datos['hora_de_apertura'] ?? null;
            $hora_cierre = $datos['hora_de_cierre'] ?? null;
            $participa_feria = isset($datos['participa_feria']) ? 1 : 0;
            $cerrado = isset($datos['cerrado']) ? 1 : 0;

            // Evitar guardar si no hay datos relevantes
            if ($hora_apertura || $hora_cierre || $participa_feria || $cerrado) {
                $horario = Horario::create([
                    'dia' => $dia,
                    'hora_apertura' => $hora_apertura,
                    'hora_cierre' => $hora_cierre,
                    'participa_feria' => $participa_feria,
                    'cerrado' => $cerrado,
                    'emprendedor_id'  => $emprendimiento->id
                ]);
                // Vincular el horario al emprendedor
                $emprendimiento->horarios()->save($horario);
            }
        }


        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $imagen) {
                $path = $imagen->store('img', 'public');
                $emprendimiento->imagenes()->create(['url' => $path]);
            }
        }


        return redirect('/emprendedores')->with('success', 'Emprendimiento creado con éxito.');
    }




    public function showFormEditarEmprendimiento($id)
    {
        if (is_numeric($id) && $id > constants::VALORMIN) {
            $emprendimiento = Emprendedor::showEmprendimientoId($id);
            if ($emprendimiento != null) {
                $emprendimiento->redes->instagram = $this->obtenerRedes($emprendimiento->redes->instagram);
                $emprendimiento->redes->facebook = $this->obtenerRedes($emprendimiento->redes->facebook);
                $categorias = Emprendedor::obtenerCategorias();
                return view("administradores.formEditarEmprendimiento", compact('emprendimiento', 'categorias'));
            }
        };

        return view("/error");
    }

    public function obtenerRedes($redes)
    {
        $redes = rtrim($redes, '/');
        $posicion = strrpos($redes, '/');
        $usuarioNombre = substr($redes, $posicion + 1);
        return $usuarioNombre;
    }

    public function editarEmprendimiento($id, validacionEditarEMprendimiento $request)
    {
        $emprendimiento = Emprendedor::find($id);
        $redes = redes::find($emprendimiento->redes_id);
        $redes->instagram = $this->obtenerRedes($redes->instagram);
        $redes->facebook = $this->obtenerRedes($redes->facebook);
        $direccion = direccion::find($emprendimiento->direccion_id);
        if ($redes != null && $emprendimiento != null) {
            if (
                $redes->instagram != $request->input('instagram') || $redes->facebook != $request->input('facebook')
                || $redes->whatsapp != $request->input('whatsapp')
            ) {
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
            $emprendimiento->descripcion = Str::ucfirst($request->input('descripcion'));
            $emprendimiento->categoria = Str::ucfirst($request->select('categoria'));

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

    // visualizar plantilla con el formulario para cargar los datos

    public function obtenerCategorias()
    {
        $categorias = Noticias::obtenerCategorias();
        return $categorias;
    }



    //Muestra la vista del formulario para cargar los datos para la nueva noticia
    public function showFormCreateNoticia()
    {
        $categorias = $this->obtenerCategorias();
        return view("administradores.noticias.formCrearNoticia", compact("categorias"));
    }





    //Carga la noticia, con los datos enviados desde el formulario, en la BBDD
    public function createNoticia(validacionNoticia $request)
    {
        $imagen = $request->file("imagen");
        $path = $imagen->store('img', 'public');

        $descripcion = nl2br($request->descripcion);

        Noticias::createNoticia($request, $path);
        return redirect('/noticias');
    }


    //Direcciona para la vista que contiene el formulario con los datos de la noticia
    public function showFormEditNoticia($id)
    {
        $categorias = $this->obtenerCategorias();
        $noticia = Noticias::showNoticiasId($id);
        return view("administradores.noticias.formEditarNoticia", compact("noticia", "categorias"));
    }

    //editar noticia
    protected function editNoticia($id, validacionEditarNoticia $request)
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
            Noticias::editNoticia($noticia);

            return redirect('/noticias');
        }
    }



    //eliminar noticia

    protected function deleteNoticia($id)
    {
        $noticia = Noticias::find($id);
        if ($noticia != null) {
            Storage::disk('public')->delete($noticia->imagen);
            Noticias::deleteNoticia($noticia);
            return redirect('/noticias')->with('success', '¡La noticia ha sido eliminada!');
        }
    }
}
