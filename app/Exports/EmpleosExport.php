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
        return Empleo::select('id', 'nombre', 'edad', 'asunto', 'email', 'telefono', 'descripcion_laboral', 'cv_path', 'created_at')->get();
    }

    public function headings(): array
    {
        return ['ID', 'Nombre', 'Edad', 'Asunto', 'Email', 'Teléfono', 'Descripcion_laboral', 'CV (ruta)', 'Fecha de envío'];
    }
}
