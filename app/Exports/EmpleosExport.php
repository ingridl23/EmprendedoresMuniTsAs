<?php

namespace App\Exports;


use App\Models\Empleo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmpleosExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Empleo::select('id', 'nombre', 'asunto', 'email', 'telefono', 'cv_path', 'created_at')->get();
    }

    public function headings(): array
    {
        return ['ID', 'Nombre', 'Asunto', 'Email', 'Teléfono', 'CV (ruta)', 'Fecha de envío'];
    }
}
