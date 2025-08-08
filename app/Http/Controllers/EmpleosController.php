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


        $query->when($request->filled('ciudad'), function ($q) use ($request) {
            $q->where('ciudad', $request->ciudad);
        });

        $query->when($request->filled('edad'), function ($q) use ($request) {
            $q->where('edad', $request->edad);
        });

        $query->when($request->filled('created_at'), function ($q) use ($request) {
            $q->whereDate('created_at', $request->created_at);
        });

        $query->when($request->has('cud'), function ($q) use ($request) {
            $q->where('cud', $request->cud);
        });

        $query->when($request->filled('dni'), function ($q) use ($request) {
            $q->where('dni', $request->dni);
        });

        $query->when($request->filled('nombre'), function ($q) use ($request) {
            $q->where('nombre', 'like', '%' . $request->nombre . '%');
        });

        $empleos = $query->get();

        return Excel::download(new EmpleosExport($empleos), 'solicitantes.xlsx');
    }








    /* public function export(Request $request)
    {
        try {
            $filtros = $request->only(['ciudad', 'edad', 'created_at', 'cud', 'dni', 'nombre']);

            return Excel::download(
                new EmpleosExport($filtros),
                'solicitantes.xlsx',
                ExcelFormat::XLSX
            );
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }*/
}
