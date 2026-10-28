<?php

namespace App\Http\Controllers;

use App\Models\Emprendedor;
use App\Models\Categoria;
use App\Models\Direccion;
use App\Http\Requests\EmprendedorRequest;
use App\constants;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EmprendedoresExport;
use Maatwebsite\Excel\Excel as ExcelFormat; // alias para evitar confusión
use App\Exports\EmprendedoresExportCollection;

/**
 * Class EmprendedorController
 *  @brief Controlador para la gestión de emprendimientos.
 *
 * Este controller define las operaciones que un usuario puede realizar sobre emprendimientos.
 *
 * @package App\Http\Controllers
 */
class EmprendedorController extends Controller
{

    /**
     * Constructor del controlador:
     *
     * Define el middlewares de autenticación y autorización necesario
     * para restringir las acciones según los permisos de rol de usuarios.
     */

    public function __construct()
    {
        $this->middleware('can:filtrar datos', [
            'only' => [
                'showForm',
                'export'
            ]
        ]);
    }



    /**
     *Visualizar la seccion de exportacion de datos para solicitantes persistidos en el sistema:
     *
     *
     * @return \Illuminate\Contracts\View\View Formulario de exportacion de datos.
     *
     * @throws \Exception Si ocurre un error al mostrar la secion.
     */

    public function showForm()
    {
        $categorias = Categoria::all();
        return view("administradores.formExcelEmprendedores", compact('categorias'));
    }


    /**
     * Aplicar busqueda por filtros dentro de la seccion de exportacion de solicitantes de empleo:
     *
     * Se Valida los datos filtros aplicados  desde el formulario.
     *
     * @param Request $request Filtros del formulario de exportacion.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse|\Illuminate\Http\RedirectResponse Devuelve el archivo .xlsx con los datos filtrados, o redirige si no hay resultados.
     *
     * @throws \Exception Si ocurre un error al exportar datos.
     */

    //funcion de filtros para el excel

    public function export(Request $request)
    {
        $request->validate([
            'ciudad' => 'string|nullable',
            'created_at' => 'date|nullable',
            'categoria' => 'nullable',
            'nombre' => 'string|nullable',
        ]);

        $query = Emprendedor::with(['categoria', 'direccion']);


        // Filtro por ciudad usando la relación direccion
        if ($request->filled('ciudad')) {
            $ciudad = trim($request->ciudad);
            $query->whereHas('direccion', function ($q) use ($ciudad) {
                $q->where('ciudad', 'LIKE', "%{$ciudad}%");
            });
        }



        if ($request->filled('created_at')) {
            $query->whereDate('created_at', $request->created_at);
        }


        if ($request->filled('categoria')) {
            $query->where('categoria_id', $request->categoria);
        }

        if ($request->filled('nombreEm')) {
            // normalizo: quito espacios extra y paso a minúsculas
            $nombreNormalizado = strtolower(trim(preg_replace('/\s+/', ' ', $request->nombreEm)));

            // armo patrón LIKE que tolera cualquier cosa entre las palabras
            $tokens = preg_split('/\s+/', $nombreNormalizado);   // ["ropa","marta"]
            $like   = '%' . implode('%', $tokens) . '%';         // "%ropa%marta%"

            // aplico case-insensitive por si la colación no lo es
            $query->whereRaw('LOWER(nombre) LIKE ?', [$like]);

            // --- Variante "cualquier orden" (AND por palabra):
            // $query->where(function ($q) use ($tokens) {
            //     foreach ($tokens as $t) {
            //         $q->whereRaw('LOWER(nombre) LIKE ?', ["%{$t}%"]);
            //     }
            // });
        }

        //dd($request->all());



        $emprendedores = $query->get();



        if ($emprendedores->isEmpty()) {
            return back()->with('error', 'No se encontraron registros para los filtros seleccionados.');
        } else {

            return Excel::download(new EmprendedoresExport($emprendedores), 'emprendedores.xlsx');
        }
    }



    /**
     *Visualizar la seccion de emprendedores persistidos en el sistema:
     *
     *
     * @return \Illuminate\Contracts\View\View Seccion de emprendedores.
     *
     * @throws \Exception Si ocurre un error al mostrar la seccion.
     */


    public function emprendedores()
    {
        $emprendedoresPorCategoria = Emprendedor::obtenerCategoriasEmprendedoresAgrupados();
        $categorias = Categoria::obtenerCategorias();
        $emprendedores = Emprendedor::with('imagenes')->get();
        //  return response()->json($emprendedores);
        return view('emprendedor.templateEmprendedores', compact('emprendedoresPorCategoria', 'emprendedores', 'categorias'));
    }



    /**
     *Aplicar una busqueda eficiente para emprendedores dentro del sistema:
     *
     *
     * @param Request $request Contiene el parametro "busqueda".
     * @return \Illuminate\Http\JsonResponse Devuelve al usuario  un conjunto de emprendimientos que coincidan  con el filtro aplicado por el campo "nombre".
     *
     * @throws \Exception Si ocurre un error al mostrar la secion.
     */

    /*Filtro de busqueda de emprendedores por nombre*/
    public function filterEmprendimientosByName(Request $request)
    {
        $busqueda = $request->query('busqueda');
        $emprendimientos = Emprendedor::with(['redes', 'imagenes', 'categoria'])
            ->where('nombre', 'LIKE', '%' . $busqueda . '%')
            // ->orWhere('categoria', 'LIKE', '%' . $busqueda . '%')
            ->get();
        return response()->json($emprendimientos);
    }



    /**
     *Aplicar una busqueda eficiente para emprendedores dentro del sistema opcion 2:
     *
     * @param int $id ID perteneciente al emprendedor a modificar
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse Devuelve al usuario un emprendimiento seleccionado, o redirige si no existe.
     *
     * @throws \Exception Si ocurre un error al mostrar la seccion.
     */

    public function showEmprendimientoId($id)
    {
        if (is_numeric($id) && $id > constants::VALORMIN) {
            // $emprendimiento = Emprendedor::find($id);
            $emprendimiento = Emprendedor::showEmprendimientoId($id);
            if ($emprendimiento != null) {
                return view("emprendedor.templateEmprendedor", compact('emprendimiento'));
            }
        }
        $mensajes = [
            'titulo' => '¡Error!',
            'detalle' => 'No existe el usuario que desea buscar, intentelo nuevamente.'
        ];
        return redirect('/emprendedores')->with('error', $mensajes);
    }

    /**
     * visualizar El alta de un emprendimiento en el sistema:
     *
     *
     * @return \Illuminate\Contracts\View\View Seccion de altas de emprendimientos.
     *
     * @throws \Exception Si ocurre un error al mostrar la secion.
     */

    public function showFormCrearEmprendimiento()
    {
        return view('administradores.formNuevoEmprendimiento');
    }
}
