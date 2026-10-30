<?php

namespace App\Http\Controllers;

use App\Http\Requests\validacionEmprendimiento;
use App\Http\Requests\validacionEditarEmprendimiento;
use App\Http\Requests\validacionNoticia;
use App\Http\Requests\validacionEditarNoticia;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;
use App\Models\User;
use App\Models\Emprendedor;
use App\Models\Horario;
use App\Models\Noticias;
use App\Models\Redes;
use App\Models\Direccion;
use App\Models\Imagenes;
use App\Models\Categoria;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\constants;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Auth;

/**
 * @class administradorController
 *
 * @brief Controlador para la gestión de emprendimientos y noticias por parte del rol administrador.
 *
 * Este controller define las operaciones que un administrador puede realizar
 * sobre emprendimientos y noticias: crear, editar, eliminar, filtrar y obtener información.
 *
 * @package App\Http\Controllers
 */

class administradorController extends Controller
{
    /**
     * Constructor del controlador.
     *
     * Define los middlewares de autenticación y autorización necesarios
     * para restringir las acciones según los permisos del rol administrador.
     */

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:crear emprendimiento', [
            'only' => [
                'crearEmprendimiento',
                'showFormCrearEmprendimiento'
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

        $this->middleware('can:ver rol', [
            'only' => [
                'obtenerRol'
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
                'editarImgsNoticias'
            ]
        ]);

        $this->middleware('can:eliminar noticia', [
            'only' => [
                'deleteNoticia'
            ]
        ]);




        $this->middleware('can:filtrar datos', [
            'only' => [
                'export',
                'showForm'
            ]
        ]);
        /**
        $this->middleware('can:filtrar datos emprendedores', [
            'only' => [
                'exportEm',
                'showFormEm'
            ]
        ]);
         */
    }

    /*public function emprendedores()
    {
        $emprendedores = Emprendedor::paginate(10);
        return view('emprendedor.index', compact('emprendedores'))
            ->with('i', (request()->input('page', 1) - 1) * $emprendedores->perPage());

        // return view("emprendedor.index", compact("emprendedores"));
    }*/


    /**
     * Visualizar para Crear un nuevo emprendimiento en el sistema:
     *
     *Se deben Validar los datos recibidos desde el formulario y  persistirlos en la base de datos,
     * asociando también redes sociales, dirección, horarios e imágenes.
     *
     * @return View Formulario de alta de emprendimiento con las categorias cargadas.
     */

    public function showFormCrearEmprendimiento()
    {
        $categorias = Categoria::obtenerCategorias();
        return view('administradores.emprendedores.formNuevoEmprendimiento', compact('categorias'));
    }


    /**
     *  Dar de alta un emprendimiento:
     *
     *  Una vez realizadas las validaciones, los datos del formulario de proveniente del formulario del usuario administrador, se deben persistir a la base de datos,asociando tambien redes sociales,
     *   direccion, horarios e imagenes.
     *
     * @param  validacionEmprendimiento $request Datos validados del emprendimiento.
     * @return \Illuminate\Http\RedirectResponse Redirige al listado de emprendedores.
     * @throws \Exception Si ocurre un error al persistir los datos en el sistema.
     */
    public function crearEmprendimiento(validacionEmprendimiento $request)
    {

        $data = $request->validated();
        $idRedes = Redes::crearRedes(
            $request->instagram,
            $request->facebook,
            $request->whatsapp
        );

        $idDireccion = Direccion::crearDireccion(
            $request->ciudad,
            $request->localidad,
            $request->calle,
            $request->altura
        );

        $emprendimiento = Emprendedor::create([
            'nombre' => $data['nombre'],
            'categoria_id' => $data['categoria'],
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
                try {
                    $uploadedFileUrl = Cloudinary::upload($imagen->getRealPath(), [
                        'folder' => 'emprendedores',
                        'quality' => '100'
                    ]);
                    $emprendimiento->imagenes()->create([
                        'url' => $uploadedFileUrl->getSecurePath(),
                        'public_id' => $uploadedFileUrl->getPublicId(),
                    ]);
                } catch (\Exception $e) {
                    $mensajes = [
                        'titulo' => '¡Error!',
                        'detalle' => 'Ha sucedido un error en la carga de las imagenes, intente nuevamente.'
                    ];
                    return redirect('/emprendedores')->with('error', $mensajes);
                }
            }
        }
        if ($idRedes && $idDireccion && $emprendimiento) {
            $mensajes = [
                'titulo' => '¡Creado!',
                'detalle' => 'Emprendimiento creado con éxito.'
            ];
            return redirect('/emprendedores')->with('success', $mensajes);
        } else {
            $mensajes = [
                'titulo' => '¡Error!',
                'detalle' => 'Ha sucedido un error al crear el emprendimiento, inténtelo nuevamente.'
            ];
            return redirect('/emprendedores')->with('error', $mensajes);
        }
    }

    /**
     * Formulario para realizar modificaciones en un emprendimiento:
     *
     * Al seleccionar un emprendimiento cargado se devuelven sus datos persistidos dentro del sistema. Y se da acceso al usuario administrador el permiso de uso para el formulario de
     * modificacion. Al validar los datos actualizados se los persiste nuevamente, asociando también redes sociales, dirección, horarios e imágenes que hayan sido modificadas.
     *
     * @param int $id ID del emprendimiento a modificar.
     *
     * @return View|RedirectResponse Formulario de edicion, o redireccion al listado si el emprendimiento no existe.
     */



    public function showFormEditarEmprendimiento($id)
    {
        if (is_numeric($id) && $id > constants::VALORMIN) {
            $emprendimiento = Emprendedor::showEmprendimientoId($id);
            if ($emprendimiento != null) {
                $emprendimiento->redes->instagram = $this->obtenerRedes($emprendimiento->redes->instagram);
                $emprendimiento->redes->facebook = $this->obtenerRedes($emprendimiento->redes->facebook);
                $categorias = Categoria::obtenerCategorias();
                $horarios = Horario::obtenerHorarios($id);
                $imagenes = $emprendimiento->imagenes;
                return view("administradores.emprendedores.formEditarEmprendimiento", compact('emprendimiento', 'categorias', 'imagenes', 'horarios'));
            } else {
                $mensajes = [
                    'titulo' => '¡Error!',
                    'detalle' => 'No se ha logrado encontrar el eprendimiento, inténtelo nuevamente.'
                ];
                return redirect('/emprendedores')->with('error', $mensajes);
            }
        } else {
            $mensajes = [
                'titulo' => '¡Error!',
                'detalle' => 'Debe ingresar un número mayor a cero para buscar y editar el emprendimiento.'
            ];
            return redirect('/emprendedores')->with('error', $mensajes);
        }
    }

    /**
     * Obtener el nombre de usuario desde la URL de una red social:
     *
     * @param string $redes URL completa de la red social.
     *
     * @return string Nombre de usuario extraído de la URL.
     */
    public function obtenerRedes($redes)
    {
        $redes = rtrim($redes, '/'); //Elimina todos los caracteres "/" que se encuentren al final
        $posicion = strrpos($redes, '/'); // posición del último '/'
        $usuarioNombre = substr($redes, $posicion + 1); // obtiene "El nombre del usuario en redes"
        return $usuarioNombre;
    }

    /**
     *Modificar imagenes de un  emprendimiento:
     *
     * Se deben iterar  las imagenes persistidas, en caso de no estar en el $request (imagenes_conservar) que llega por parametro, pasan a estar eliminadas.
     * Si el resultado de la coleccion no esta vacio, las imagenes (url) se agregan. Teniendo esta logica de negocio, solo se permitiran cinco imagenes asociadas por emprendedor/emprendimiento.
     *
     * @param int $id ID perteneciente al emprendedor a modificar
     * @param Request $request Viene en FormData con las nueva imagenes a cargar
     *
     * @return JsonResponse Envio de estado de la respuesta del fetch
     */
    public function editarImagenesEmprendimiento($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'imagenes' => 'array|max:5',
            'imagenes.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048|dimensions:max_width=1920,max_height=1080',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'redirect' => "/emprendedores/formEditarEmprendimiento/{$id}",
                'message' => [
                    'titulo' => '¡Error!',
                    'detalle' => 'Ha sucedido un error en la validación de la imagen',
                ],
                'status' => 'error',
            ], 400);
        };
        $emprendimiento = Emprendedor::find($id);
        $imagenesBD = Imagenes::where('emprendedor_id', $emprendimiento->id)->get();
        $imagenesRequest = $request->file("imagenes");
        $totalImagenesDB = count($imagenesBD);

        $imagenesConservarJson = $request->input('imagenes_conservar');
        $imagenesConservar = json_decode($imagenesConservarJson, true); // true para array asociativo
        $idsConservar = collect($imagenesConservar)->pluck('id')->filter()->toArray();

        if (count($imagenesBD) > 0) {
            foreach ($imagenesBD as $imagen) {
                if (!in_array($imagen->id, $idsConservar)) {
                    try {
                        Cloudinary::uploadApi()->destroy($imagen->public_id);
                        Imagenes::eliminarImagen($imagen);
                        $totalImagenesDB = $totalImagenesDB - 1;
                    } catch (\Exception $e) {
                        return response()->json(['error' => "No se ha podido cargar las imagenes"], 400);
                    }
                }
            }
        }
        if ($imagenesRequest != null) {
            if (count($imagenesBD) <= 5 && (count($imagenesRequest) + $totalImagenesDB) <= 5) {
                foreach ($imagenesRequest as $imagen) {
                    try {
                        $uploadedFileUrl = Cloudinary::upload($imagen->getRealPath(), [
                            'folder' => 'emprendedores'
                        ]);
                        $emprendimiento->imagenes()->create([
                            'url' => $uploadedFileUrl->getSecurePath(),
                            'public_id' => $uploadedFileUrl->getPublicId(),
                        ]);
                    } catch (\Exception $e) {
                        return response()->json(['error' => "No se ha podido cargar las imagenes"], 400);
                    }
                }
            } else {
                return response()->json([
                    'redirect' => "/noticias/formEditarNoticia/{$id}",
                    'message' => [
                        'titulo' => '¡Error!',
                        'detalle' => 'Ha excedido la cantidad de imagenes permitidas.',
                    ],
                    'status' => 'error',
                ], 400);
            }
        }
        return response()->json(['ok' => "No se ha cargado una nueva/s imagen/es"], 200);
    }

    public function obtenerRol()
    {
        $rol = false;
        if (Auth::check() && Auth::user()->hasRole('admin')) {
            $rol = true;
        }
        return response()->json($rol);
    }


    /**
     * Editar un emprendimiento:
     *
     * Se obtienen los datos del formulario para el emprendimiento seleccionado (redes, direccion, horarios, informacion) y es persistido en el sistema.
     *
     * @param int $id ID perteneciente al emprendedor a modificar
     * @param validacionEditarEmprendimiento $request Los nuevos datos del emprendimiento
     *
     * @return RedirectResponse Redirige al administrador a la página principal de emprendedores
     * @throws \Exception Si ocurre un error al persistir datos.
     */
    public function editarEmprendimiento($id, validacionEditarEmprendimiento $request)
    {
        $emprendimiento = Emprendedor::find($id);
        if ($emprendimiento != null) {
            $horarios = Horario::obtenerHorarios($id);
            $redes = Redes::find($emprendimiento->redes_id);
            $redes->instagram = $this->obtenerRedes($redes->instagram);
            $redes->facebook = $this->obtenerRedes($redes->facebook);
            $direccion = Direccion::find($emprendimiento->direccion_id);
            if ($redes != null) {
                $redes->instagram = $request->input('instagram');
                $redes->facebook = $request->input('facebook');
                if ($redes->whatsapp != $request->input('whatsapp')) {
                    $redes->whatsapp = $request->input('whatsapp');
                }
            }
            if ($direccion != null) {
                if (
                    $direccion->ciudad != $request->input('ciudad') || $direccion->localidad != $request->input('localidad') || $direccion->calle != $request->input('calle')
                    || $direccion->altura != $request->input('altura')
                ) {
                    $direccion->ciudad = $request->input('ciudad');
                    $direccion->localidad = $request->input('localidad');
                    $direccion->calle = $request->input('calle');
                    $direccion->altura = $request->input('altura');
                }
            }
            $emprendimiento->nombre = $request->input('nombre');
            $emprendimiento->descripcion = Str::ucfirst($request->input('descripcion'));
            $emprendimiento->categoria_id = $request->input('categoria');

            foreach ($request->horarios as $dia => $datos) {
                $diaHorarioViejo = $horarios->where('dia', $dia)->first();
                $hora_apertura = $datos['hora_de_apertura'] ?? null;
                $hora_cierre = $datos['hora_de_cierre'] ?? null;
                $participa_feria = isset($datos["participa_feria"]) ? 1 : 0;
                $cerrado = isset($datos['cerrado']) ? 1 : 0;

                // Al crear solo se guardan los días con datos, pero el formulario de edición manda los 7:
                // si el día no existe se crea, con la misma regla que crearEmprendimiento()
                if ($diaHorarioViejo === null) {
                    if (!($hora_apertura || $hora_cierre || $participa_feria || $cerrado)) {
                        continue;
                    }
                    $diaHorarioViejo = new Horario(['dia' => $dia, 'emprendedor_id' => $emprendimiento->id]);
                }

                $diaHorarioViejo->hora_apertura = $hora_apertura;
                $diaHorarioViejo->hora_cierre = $hora_cierre;
                $diaHorarioViejo->participa_feria = $participa_feria;
                $diaHorarioViejo->cerrado = $cerrado;
                $horariosActualizado = Horario::editarHorarios($diaHorarioViejo);
            }

            $emprendedorEdit = Emprendedor::editarEmprendimiento($emprendimiento);
            $redesEdit = Redes::editarEmprendimiento($redes);
            $direccionEdit = Direccion::editarEmprendimiento($direccion);

            if ($emprendedorEdit && $redesEdit && $direccionEdit) {
                $mensajes = [
                    'titulo' => '¡Editado!',
                    'detalle' => 'Emprendimiento editado con éxito.'
                ];

                return redirect('/emprendedores')->with('success', $mensajes);
            } else {
                $mensajes = [
                    'titulo' => '¡Error!',
                    'detalle' => 'Ha sucedido un error al editar el emprendimiento, inténtelo nuevamente.'
                ];

                return redirect('/emprendedores')->with('error', $mensajes);
            }
        } else {
            $mensajes = [
                'titulo' => '¡Error!',
                'detalle' => 'No se ha encontrado el emprendimiento que se desea editar, intentelo nuevamente.'
            ];
            return redirect('/emprendedores')->with('error', $mensajes);
        }
    }


    /**
     * Eliminar un emprendimiento con sus redes, direccion y horarios asociados:
     *
     * @param int $id, ID único del emprendimiento seleccionado
     *
     * @return RedirectResponse redirecciona a la página principal de emprendedimientos.
     *  @throws \Exception Si ocurre un error al persistir datos.
     */
    public function eliminarEmprendimiento($id)
    {
        $emprendimiento = Emprendedor::find($id);
        if ($emprendimiento != null) {
            $redes = Redes::find($emprendimiento->redes_id);
            $direccion = Direccion::find($emprendimiento->direccion_id);
            $imagenes = $emprendimiento->imagenes;
            $horarios = Horario::buscarPorIdEmprendedor($emprendimiento->id);
            if ($redes != null && $direccion != null) {
                foreach ($imagenes as $imagen) {
                    try {
                        Cloudinary::uploadApi()->destroy($imagen->public_id);
                        Imagenes::eliminarImagen($imagen);
                    } catch (\Exception $e) {
                        $mensajes = [
                            'titulo' => '¡Error!',
                            'detalle' => 'Ha sucedido un error al eliminar las imagenes del emprendimiento, intente nuevamente.'
                        ];
                        return redirect('/emprendedores')->with('error', $mensajes);
                    }
                }
                $emprendimientoEliminado = Emprendedor::eliminarEmprendimiento($emprendimiento);
                $redesEliminado = Redes::eliminarEmprendimiento($redes);
                $direccionEliminado = Direccion::eliminarEmprendimiento($direccion);
                $horarioEiminado = Horario::eliminarHorarios($horarios);
                if ($emprendimientoEliminado && $redesEliminado && $direccionEliminado && $horarioEiminado) {
                    $mensajes = [
                        'titulo' => '¡Eliminado!',
                        'detalle' => 'Emprendimiento eliminado con éxito.'
                    ];
                    return redirect('/emprendedores')->with('success', $mensajes);
                } else {
                    $mensajes = [
                        'titulo' => '¡Error!',
                        'detalle' => 'Error al borrar el emprendimiento, intentelo más tarde.'
                    ];
                    return redirect('/emprendedores')->with('error', $mensajes);
                }
            }
            $mensajes = [
                'titulo' => '¡Error!',
                'detalle' => 'El emprendimiento no tiene redes o dirección asociadas, no se pudo eliminar.'
            ];
            return redirect('/emprendedores')->with('error', $mensajes);
        } else {
            $mensajes = [
                'titulo' => '¡Error!',
                'detalle' => 'No se ha encontrado el emprendimiento que se desea eliminar, intentelo nuevamente.'
            ];
            return redirect('/emprendedores')->with('error', $mensajes);
        }
    }




    /**************************************** funciones del crud noticias *************************** */


    /**
     * Obtener las categorias presentes en el sistema:
     *
     * @return array<int, string> Categorias cargadas
     */
    public function obtenerCategorias()
    {
        $categorias = Noticias::obtenerCategorias();
        return $categorias;
    }



    /**
     * Visualizar el formulario de Altas de publicaciones:
     * Permite al usuario administrador acceder y dar uso del formulario de Altas para publicaciones.
     * @return View Retorna el formulario  para completar la alta de la publicacion.
     */
    public function showFormCreateNoticia()
    {
        $categorias = $this->obtenerCategorias();
        return view("administradores.noticias.formCrearNoticia", compact("categorias"));
    }





    /**
     * Dar alta de una publicacion:
     *
     * @param validacionNoticia $request Datos de la nueva publicacion
     *
     * @return RedirectResponse Redirige al usuario administrador a la homepage de noticias.
     *  @throws \Exception Si ocurre un error al persistir datos.
     */
    public function createNoticia(validacionNoticia $request)
    {
        if ($request->hasFile('imagen')) {
            try {
                $imagen = $request->file('imagen');
                $uploadedFileUrl = Cloudinary::upload($imagen->getRealPath(), [
                    'quality' => 'auto:best',
                    'folder' => 'noticias'
                ]);
                $path = $uploadedFileUrl->getSecurePath();
                $imagen_public_id =  $uploadedFileUrl->getPublicId();
            } catch (\Exception $e) {
                $mensajes = [
                    'titulo' => '¡Error!',
                    'detalle' => 'Ha sucedido un error en la carga de la imagen, intente nuevamente.'
                ];
                return redirect('/noticias')->with('error', $mensajes);
            }
        } else {
            $mensajes = [
                'titulo' => '¡Error!',
                'detalle' => 'Necesita cargar una imagen para poder agregar la noticia.'
            ];
            return redirect('/noticias')->with('error', $mensajes);
        }
        //nl2br Salto de linea
        $descripcion = nl2br($request->descripcion);
        $creado = Noticias::createNoticia($request, $path, $imagen_public_id);
        if ($creado && $creado != null) {
            $mensajes = [
                'titulo' => '¡Creado!',
                'detalle' => 'Noticia creada con éxito.'
            ];
            return redirect('/noticias')->with('success', $mensajes);
        } else {
            $mensajes = [
                'titulo' => '¡Error!',
                'detalle' => 'Ha sucedido un error al crear la noticia, inténtelo nuevamente.'
            ];
            return redirect('/noticias')->with('error', $mensajes);
        }
    }


    /**
     * Visualizar el formulario para la modificacion de publicaciones:
     *Permite al usuario administrador acceder y dar uso del formulario de modificaciones para publicaciones.
     * @param int $id ID perteneciente a la noticia que se va a mostrar para modificar
     *
     * @return View|RedirectResponse Muestra el formulario con los datos persistidos, o redirige si la noticia no existe.

     */
    public function showFormEditNoticia($id)
    {
        if (is_numeric($id) && $id > constants::VALORMIN) {
            $categorias = $this->obtenerCategorias();
            $noticia = Noticias::showNoticiasId($id);
            if ($noticia != null) {
                return view("administradores.noticias.formEditarNoticia", compact("noticia", "categorias"));
            } else {
                $mensajes = [
                    'titulo' => '¡Error!',
                    'detalle' => 'No se ha encontrado una noticia que coincida, intentelo nuevamente.'
                ];
                return redirect('/noticias')->with('error', $mensajes);
            }
        } else {
            $mensajes = [
                'titulo' => '¡Error!',
                'detalle' => 'Debe ingresar un número mayor a cero para buscar y editar una noticia.'
            ];

            return redirect('/noticias')->with('error', $mensajes);
        }
    }


    /**
     * Modificacion de la imagen ilustrativa de una publicacion:
     *
     * @param int $id ID unico de identificacion para la publicacion seleccionada.
     * @param Request $request Datos ingresados para la modificacion.
     *
     * @return JsonResponse Envio de estado de la respuesta del fetch
     */
    protected function editarImgsNoticias($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'imagen' => 'image|mimes:jpeg,jpg,png,webp|max:2048',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'redirect' => "/noticias/formEditarNoticia/{$id}",
                'message' => [
                    'titulo' => '¡Error!',
                    'detalle' => 'Ha sucedido un error en la validación de la imagen',
                ],
                'status' => 'error',
            ], 400);
        };

        $noticia = Noticias::find($id);
        $imagenRequest = $request->file("imagen");
        $formPublicId = $request->input("public_id");
        if ($imagenRequest != null) {
            if ($noticia->imagen_public_id != $formPublicId) {
                try {
                    Cloudinary::uploadApi()->destroy($noticia->imagen_public_id);
                    $uploadedFileUrl = Cloudinary::upload($imagenRequest->getRealPath(), [
                        'folder' => 'noticias'
                    ]);
                    $path = $uploadedFileUrl->getSecurePath();
                    $imagen_public_id =  $uploadedFileUrl->getPublicId();
                    $noticiaEditImg = Noticias::editarImagen($noticia, $path, $imagen_public_id);
                    return response()->json(['OK' => "La imagen es la misma"], 200);
                } catch (\Exception $e) {
                    return response()->json([
                        'redirect' => "/noticias/formEditarNoticia/{$id}",
                        'message' => [
                            'titulo' => '¡Error!',
                            'detalle' => 'Ha sucedido un error en la carga de la imagen',
                        ],
                        'status' => 'error',
                    ], 400);
                }
            } else {
                return response()->json(['OK' => "La imagen es la misma"], 200);
            }
        } else {
            return response()->json(['OK' => "No se cambió la imagen"], 200);
        }
    }

    /**
     * Modificacion de una publicacion:
     *
     * @param int $id ID unico de identificacion de la publicacion seleccionada.
     * @param validacionEditarNoticia $request Datos recibidos para persistir de la publicacion seleccionada.
     *
     * @return RedirectResponse Redirige al usuario administrador hacia la homepage  de noticias.
     *  @throws \Exception Si ocurre un error al persistir datos.
     */
    protected function editNoticia($id, validacionEditarNoticia $request)
    {
        $noticia = Noticias::find($id);
        if ($noticia != null) {
            $noticia->titulo = $request->input('titulo');
            $noticia->descripcion = $request->input('descripcion');
            $noticia->categoria = $request->input('categoria');
            Noticias::editNoticia($noticia);
            $mensajes = [
                'titulo' => '¡Editado!',
                'detalle' => 'Noticia editada con éxito.'
            ];

            return redirect('/noticias')->with('success', $mensajes);
        } else {
            $mensajes = [
                'titulo' => '¡Error!',
                'detalle' => 'Ha sucedido un error al editar la noticia, inténtelo nuevamente.'
            ];
            return redirect('/noticias')->with('error', $mensajes);
        }
    }



    /**
     * Dar de baja una publicacion:
     *
     * @param int $id, ID unico de identificacion de la publicacion seleccionada.
     *
     * @return RedirectResponse Redirige al usuario administrador a la homepage de noticias.
     *  @throws \Exception Si ocurre un error al persistir datos.
     */
    protected function deleteNoticia($id)
    {
        $noticia = Noticias::find($id);
        if ($noticia != null) {
            try {
                Cloudinary::uploadApi()->destroy($noticia->imagen_public_id);
            } catch (\Exception $e) {
                $mensajes = [
                    'titulo' => '¡Error!',
                    'detalle' => 'Ha sucedido un error al eliminar la imagen de la noticia, intente nuevamente.'
                ];
                return redirect('/noticias')->with('error', $mensajes);
            }
            $eliminado = Noticias::deleteNoticia($noticia);
            if ($eliminado && $eliminado != null) {
                $mensajes = [
                    'titulo' => '¡Eliminado!',
                    'detalle' => 'La noticia ha sido eliminada con éxito.'
                ];
                return redirect('/noticias')->with('success', $mensajes);
            } else {
                $mensajes = [
                    'titulo' => '¡Error!',
                    'detalle' => 'Ha sucedido un error al eliminar la noticia, intentelo más tarde.'
                ];
                return redirect('/noticias')->with('error', $mensajes);
            }
        } else {
            $mensajes = [
                'titulo' => '¡Error!',
                'detalle' => 'No se ha encontrado la noticia que se desea eliminar.'
            ];
            return redirect('/noticias')->with('error', $mensajes);
        }
    }
}
