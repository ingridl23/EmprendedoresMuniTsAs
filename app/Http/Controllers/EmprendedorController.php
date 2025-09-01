<?php

namespace App\Http\Controllers;

use App\Models\Emprendedor;
use App\Models\categoria;
use App\Models\direccion;
use App\Http\Requests\EmprendedorRequest;
use App\constants;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EmprendedoresExport;
use Maatwebsite\Excel\Excel as ExcelFormat; // alias para evitar confusión
use App\Exports\EmprendedoresExportCollection;

/**
 * Class EmprendedorController
 * @package App\Http\Controllers
 */
class EmprendedorController extends Controller
{



    public function __construct()
    {
        $this->middleware('can:filtrar emprendedores', [
            'only' => [
                'showForm',
                'export'
            ]
        ]);
    }

    public function showForm()
    {
        $categorias = categoria::all();
        return view("administradores.formExcelEmprendedores", compact('categorias'));
    }


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




    public function emprendedores()
    {
        $emprendedoresPorCategoria = Emprendedor::obtenerCategoriasEmprendedoresAgrupados();
        $categorias = categoria::obtenerCategorias();
        $emprendedores = Emprendedor::with('imagenes')->get();
        //  return response()->json($emprendedores);
        return view('emprendedor.templateEmprendedores', compact('emprendedoresPorCategoria', 'emprendedores', 'categorias'));
    }

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

    public function showEmprendimientoId($id)
    {
        if (is_numeric($id) && $id > constants::VALORMIN) {
            // $emprendimiento = Emprendedor::find($id);
            $emprendimiento = Emprendedor::showEmprendimientoId($id);
            if ($emprendimiento != null) {
                return view("emprendedor.templateEmprendedor", compact('emprendimiento'));
            }
        }
        //return view("errors.mensaje")->with('mensaje', "No se encuentra cargado ningún emprendimiento");
    }


    public function showFormCrearEmprendimiento()
    {
        return view('administradores.formNuevoEmprendimiento');
    }
}
