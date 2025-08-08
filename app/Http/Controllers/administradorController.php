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
use App\Models\Imagenes;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\constants;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

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
                'showFormEditarEmprendimiento',
                'editarImagenesEmprendimiento'
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
        $categorias = Emprendedor::obtenerCategoriasEmprendedores();
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
                $uploadedFileUrl = Cloudinary::upload($imagen->getRealPath(), [
                    'folder' => 'emprendedores'  
                ]);
                $emprendimiento->imagenes()->create([
                    'url' => $uploadedFileUrl->getSecurePath(),
                    'public_id' => $uploadedFileUrl->getPublicId(),
                ]);
            }
        }

        $mensajes =[
                'titulo'=>'¡Creado!',
                'detalle' =>'Emprendimiento creado con éxito.'
        ];


        return redirect('/emprendedores')->with('success', $mensajes);
    }




    public function showFormEditarEmprendimiento($id)
    {
        if (is_numeric($id) && $id > constants::VALORMIN) {
            $emprendimiento = Emprendedor::showEmprendimientoId($id);
            if ($emprendimiento != null) {
                $emprendimiento->redes->instagram = $this->obtenerRedes($emprendimiento->redes->instagram);
                $emprendimiento->redes->facebook = $this->obtenerRedes($emprendimiento->redes->facebook);
                $categorias = Emprendedor::obtenerCategoriasEmprendedores();
                 $imagenes = imagenes::find($emprendimiento->id);
                return view("administradores.formEditarEmprendimiento", compact('emprendimiento', 'categorias', 'imagenes'));
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

    public function editarImagenesEmprendimiento($id, Request $request){
        $emprendimiento = Emprendedor::find($id);
        $imagenesBD= imagenes::find($emprendimiento->id);
        $imagenesRequest=$request->file("imagenes");
        
        $imagenesConservarJson = $request->input('imagenes_conservar');
        $imagenesConservar = json_decode($imagenesConservarJson, true); // true para array asociativo
        $idsConservar = collect($imagenesConservar)->pluck('id')->filter()->toArray();

        if(count($imagenesBD)>0){
            foreach ($imagenesBD as $imagen) {
                if(!in_array($imagen->id, $idsConservar)){
                    Cloudinary::uploadApi()->destroy($imagen->public_id);
                    imagenes::eliminarImagen($imagen);
                }
            }
        }
        if($imagenesRequest != null){
            if(count($imagenesBD)<5 && (count($imagenesRequest)+count($imagenesBD))<=5){
                foreach ($imagenesRequest as $imagen) {
                    $uploadedFileUrl = Cloudinary::upload($imagen->getRealPath(), [
                        'folder' => 'emprendedores'  
                    ]);
                    $emprendimiento->imagenes()->create([
                        'url' => $uploadedFileUrl->getSecurePath(),
                        'public_id' => $uploadedFileUrl->getPublicId(),
                    ]);
                }
         }
         else{
            return response()->json("Super la cantidad permitida");
         }
        }
        
        return response()->json($emprendimiento->imagenes());
    }

    public function editarEmprendimiento($id, validacionEditarEmprendimiento $request)
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

            $emprendimiento->nombre = $request->input('nombre');
            $emprendimiento->descripcion = Str::ucfirst($request->input('descripcion'));
            $emprendimiento->categoria = Str::ucfirst($request->input('categoria'));

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
            $imagenes = imagenes::find($emprendimiento->id);
            if ($redes != null && $direccion != null ) {
                foreach ($imagenes as $imagen) {
                    Cloudinary::uploadApi()->destroy($imagen->public_id);
                    Imagenes::eliminarImagen($imagen);
                }
                Emprendedor::eliminarEmprendimiento($emprendimiento);
                redes::eliminarEmprendimiento($redes);
                direccion::eliminarEmprendimiento($direccion);
                $mensajes =[
                    'titulo'=>'¡Eliminado!',
                'detalle' =>'Emprendimiento eliminado con éxito.'
                ];
                
                return redirect('/emprendedores')->with('success', $mensajes);
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





    //Carga la noticia, con los datos enviados desde el formulario, con carteles ante los posibles casos de error o de confirmacion
    public function createNoticia(validacionNoticia $request)
    {
        if ($request->hasFile('imagen')) {
            try {
                $imagen = $request->file('imagen');
                $uploadedFileUrl = Cloudinary::upload($imagen->getRealPath(), [
                    'folder' => 'noticias'  
                ]);
                $path=$uploadedFileUrl->getSecurePath();
                $imagen_public_id =  $uploadedFileUrl->getPublicId();
            }
            catch (\Exception $e) {
                $mensajes =[
                    'titulo'=>'¡Error!',
                    'detalle' =>'Ha sucedido un error al crear la noticia, intente nuevamente.'
                ];
                return redirect('/noticias')->with('error', $mensajes);
            }
        }
        else{
            $mensajes =[
                    'titulo'=>'¡Error!',
                    'detalle' =>'Ha sucedido un error en la carga de la imagen, intente nuevamente..'
                ];
                return redirect('/noticias')->with('error', $mensajes);
        }

        $descripcion = nl2br($request->descripcion);
        $creado = Noticias::createNoticia($request, $path, $imagen_public_id);
        if($creado && $creado != null){
            $mensajes =[
                'titulo'=>'Creado!',
                'detalle' =>'La noticia ha sido creada con éxito.'
            ];
            return redirect('/noticias')->with('success', $mensajes); 
        }
        else{
            $mensajes =[
                'titulo'=>'Error!',
                'detalle' =>'Ha sucedido un error al crear la noticia, intente nuevamente.'
            ];
            return redirect('/noticias')->with('error', $mensajes); 
        }
    }


    //Direcciona para la vista que contiene el formulario con los datos de la noticia
    public function showFormEditNoticia($id)
    {
        $categorias = $this->obtenerCategorias();
        $noticia = Noticias::showNoticiasId($id);
        return view("administradores.noticias.formEditarNoticia", compact("noticia", "categorias"));
    }


    //Obtener valor de adentro de $imagenRequest para poder comparar
    protected function editarImgsNoticias($id, Request $request){
        
        /*$noticia = Noticias::find($id)*/;
        $imagenRequest=$request->file("imagen");
        if ($imagenRequest != null) {
            return response()->json(['error' => $imagenRequest], 404);
        }
       
        /*if($imagenRequest != "undefined"){
            if(!in_array($noticia->imagen_public_id, $idsConservar)){
                Cloudinary::uploadApi()->destroy($noticia->imagen_public_id);
                $uploadedFileUrl = Cloudinary::upload($imagenRequest->getRealPath(), [
                    'folder' => 'emprendedores'  
                ]);
                $noticiaEditImg = Noticias::editarImagen($noticia, $noticia->imagen, $noticia->imagen_public_id);
            }
        }*/
        else{
             $mensajes =[
                    'titulo'=>'¡Error!',
                    'detalle' =>'Se necesita tener una imagen para poder editar la noticia.'
                ];
                return response()->json(['error' => $imagenRequest], 400);
        }
        
    }

    //editar noticia
    protected function editNoticia($id, validacionEditarNoticia $request)
    {
        $noticia = Noticias::find($id);
        if ($noticia != null) {
            $noticia->titulo = $request->input('titulo');
            $noticia->descripcion = $request->input('descripcion');
            $noticia->categoria = $request->input('categoria');
            Noticias::editNoticia($noticia);
            return redirect('/noticias');
        }
        else{
             $mensajes =[
                    'titulo'=>'¡Error!',
                    'detalle' =>'No se ha encontrado la noticia que se desea editar.'
                ];
                return redirect('/noticias')->with('error', $mensajes); 
        }
    }



    //eliminar noticia

    protected function deleteNoticia($id){
        $noticia = Noticias::find($id);
        if ($noticia != null) {
            try {
                Cloudinary::uploadApi()->destroy($noticia->imagen_public_id);   
            }
            catch (\Exception $e) {
                $mensajes =[
                    'titulo'=>'¡Error!',
                    'detalle' =>'Ha sucedido un error al eliminar la imagen, intente nuevamente.'
                ];
                return redirect('/noticias')->with('error', $mensajes);
            }
            $eliminado= Noticias::deleteNoticia($noticia);
            if($eliminado && $eliminado != null){
                $mensajes =[
                    'titulo'=>'¡Eliminado!',
                    'detalle' =>'La noticia ha sido eliminada con éxito.'
                ];
                return redirect('/noticias')->with('success', $mensajes); 
            }
            else{
                $mensajes =[
                    'titulo'=>'Error!',
                    'detalle' =>'Ha sucedido un error al eliminar el emprendimiento, intente nuevamente.'
                ];
                return redirect('/noticias')->with('error', $mensajes); 
            }
            
        }
        else{
            $mensajes =[
                    'titulo'=>'¡Error!',
                    'detalle' =>'No se ha encontrado la noticia que se desea eliminar.'
                ];
                return redirect('/noticias')->with('error', $mensajes); 
        }
    }
}
