<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EmpleosExport;

class EmpleosController extends Controller
{



    public function showForm()
    {
        return view("administradores.formExcel");
    }

    public function export(Request $request)
    {
        $filtros = $request->only(['ciudad', 'edad', 'created_at', 'cud', 'dni', 'nombre']);

        return Excel::download(new EmpleosExport($filtros), 'solicitantes.xlsx');
    }
}
