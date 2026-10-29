<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EmpleosExport;
use Maatwebsite\Excel\Excel as ExcelFormat; // alias para evitar confusión
use App\Exports\EmpleosExportCollection;
use App\Models\Empleo;
use Illuminate\Support\Facades\Storage;

/**
 * @class EmpleosController
 *
 * @brief Controlador para la gestión de solicitantes ingresados y persistidos en el sistema.
 *
 * Este controller define la operacion que un  usuario administrador puede realizar
 * sobre los datos persistidos.
 *
 * @package App\Http\Controllers
 */
class EmpleosController extends Controller
{

    /**
     * Constructor del controlador:
     *
     * Define los middlewares de autenticación y autorización necesarios
     * para restringir las acciones según los permisos del rol administrador.
     */

    public function __construct()
    {
        $this->middleware('auth')->only('descargarCv');
        $this->middleware('can:filtrar datos', [
            'only' => [
                'showForm',
                'export',
                'descargarCv'
            ]
        ]);
    }

    /**
     * Descargar el CV de un solicitante:
     *
     * Los CV se guardan en el disco privado (storage/app/cvs), fuera de la carpeta pública,
     * así que solo se pueden bajar por esta ruta, con sesión iniciada y el permiso "filtrar datos".
     *
     * @param int $id ID del solicitante (tabla empleos).
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function descargarCv($id)
    {
        $empleo = Empleo::findOrFail($id);
        if (!$empleo->cv_path || !Storage::disk('local')->exists($empleo->cv_path)) {
            abort(404);
        }
        return Storage::disk('local')->download($empleo->cv_path, "cv-solicitante-{$empleo->id}.pdf");
    }

    /**
     * Visualizar el formulario de descarga de datos persistidos de solicitantes de empleo:
     * Permite al usuario administrador la visualizacion y el acceso a el uso del formulario para la exportacion de los datos del sistema.
     * @return \Illuminate\Contracts\View\View Formulario de descarga.

     */

    public function showForm()
    {
        return view("administradores.formExcel");
    }

    /**
     * Exportar datos de solicitantes:
     *
     * Se Valida los filtros aplicados desde el formulario ,para su posterior  descarga automatica de los mismos.

     * @param Request $request Filtros del formulario de exportacion.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse|\Illuminate\Http\RedirectResponse Devuelve el archivo .xlsx con los datos filtrados, o redirige si no hay resultados.
     *
     * @throws \Exception Si ocurre un error al exportar datos.
     */

    public function export(Request $request)
    {
        $request->validate([
            'ciudad' => 'string|nullable',
            'edad' => 'integer|nullable',
            'created_at' => 'date|nullable',
            'cud' => 'boolean|nullable',
            'dni' => 'string|nullable',
            'nombre' => 'string|nullable',
        ]);

        $query = Empleo::query();

        /*
        $query->when($request->filled('ciudad'), function ($q) use ($request) {
            $ciudad = strtolower(trim($request->ciudad));
            $q->whereRaw('LOWER(ciudad) LIKE ?', ["%{$ciudad}%"]);
        });*/

        if ($request->filled('ciudad')) {
            $ciudad = strtolower(trim($request->ciudad));
            $query->whereRaw('LOWER(ciudad) LIKE ?', ["%{$ciudad}%"]);
        }

        /*    // Filtro edad >=
        $query->when($request->filled('edad'), function ($q) use ($request) {
            $q->where('edad', '>=', (int) $request->edad);
        });




        // Filtro fecha exacta (created_at)
        $query->when($request->filled('created_at'), function ($q) use ($request) {
            $q->whereDate('created_at', $request->created_at);
        });*/


        if ($request->filled('edad')) {
            $query->where('edad', '>=', (int) $request->edad);
        }

        if ($request->filled('created_at')) {
            $query->whereDate('created_at', $request->created_at);
        }



        /*
        // Filtro booleano cud
        $query->when($request->filled('cud'), function ($q) use ($request) {
            $q->where('cud', (bool) $request->cud);
        });


        // Filtro dni exacto
        $query->when($request->filled('dni'), function ($q) use ($request) {
            $q->where('dni', $request->dni);
        });


        // Filtro nombre con LIKE para coincidencia parcial
        $query->when($request->filled('nombre'), function ($q) use ($request) {
            $nombre = trim($request->nombre);
            $q->where('nombre', 'LIKE', "%{$nombre}%");
        });*/
        // Para cud, tené en cuenta que si no viene explícitamente el booleano, puede fallar el filtro
        if ($request->filled('cud')) {
            // Convertir a booleano estricto
            $cud = filter_var($request->cud, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
            if (!is_null($cud)) {
                $query->where('cud', $cud);
            }
        }

        if ($request->filled('dni')) {
            $query->where('dni', $request->dni);
        }

        if ($request->filled('nombre')) {
            $nombre = trim($request->nombre);
            $query->where('nombre', 'LIKE', "%{$nombre}%");
        }


        $empleos = $query->get();


        if ($empleos->isEmpty()) {
            $mensaje = [
                'titulo' => '¡Error!',
                'detalle' => 'No se encontraron registros para los filtros seleccionados.'
            ];
            return back()->with('error', $mensaje);
        } else {

            return Excel::download(new EmpleosExport($empleos), 'solicitantes.xlsx');
        }
    }
}
