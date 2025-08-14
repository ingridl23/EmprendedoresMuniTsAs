<?php

namespace App\Exports;


use App\Models\Empleo;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;


class EmpleosExport implements FromCollection, WithHeadings, WithMapping

{

    protected $empleos;

    public function __construct($empleos)
    {
        $this->empleos = $empleos;
    }

    public function collection()
    {
        return $this->empleos;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nombre',
            'Asunto',
            'Email',
            'Teléfono',
            'Edad',
            'DNI',
            'Ciudad',
            'Localidad',
            'Formación',
            'Nombre del Curso',
            'Descripción',
            'Referencia Laboral',
            'Rubro de Referencia',
            'Actividad Referida',
            'Contratista',
            'Teléfono de Referencia',
            'Posee CUD',
            'Relación de Dependencia',
            'CV (ruta)',
            'Fecha de Envío',
        ];
    }

    public function map($empleo): array
    {
        return [
            $empleo->id,
            $empleo->nombre,
            $empleo->asunto,
            $empleo->email,
            $empleo->telefono,
            $empleo->edad,
            $empleo->dni,
            $empleo->ciudad,
            $empleo->localidad,
            $empleo->formacion,
            $empleo->nombre_curso,
            $empleo->description,
            $empleo->referencia_laboral,
            $empleo->referencia_rubro,
            $empleo->referencia_actividad,
            $empleo->contratista,
            $empleo->referencia_telefonica,
            $empleo->cud ? 'Sí' : 'No',
            $empleo->dependencia ? 'Sí' : 'No',
            $empleo->cv_path,
            $empleo->created_at->format('Y-m-d'),
        ];
    }

    /*

    public function headings(): array
    {
        return [
            'ID',
            'Nombre',
            'Asunto',
            'Email',
            'Teléfono',
            'Edad',
            'DNI',
            'Ciudad',
            'Localidad',
            'Formación',
            'Nombre del Curso',
            'Descripción',
            'Referencia Laboral',
            'Rubro de Referencia',
            'Actividad Referida',
            'Contratista',
            'Teléfono de Referencia',
            'Posee CUD',
            'Relación de Dependencia',
            'CV (ruta)',
            'Fecha de Envío',
        ];
    }

        */
}
