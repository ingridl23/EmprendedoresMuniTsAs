<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EmpleosExport;
use Maatwebsite\Excel\Excel as ExcelFormat; // alias para evitar confusión
use App\Exports\EmpleosExportCollection;
use App\Models\Empleo;


class EmpleosController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showForm()
    {
        return view("administradores.formExcel");
    }



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
        });
*/

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
        });
*/
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
            return back()->with('error', 'No se encontraron registros para los filtros seleccionados.');
        } else {

            return Excel::download(new EmpleosExport($empleos), 'solicitantes.xlsx');
        }
    }
}
