<?php

namespace App\Exports;


use App\Models\Emprendedor;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;


class EmprendedoresExport implements FromCollection, WithHeadings, WithMapping

{

    protected $emprendedores;

    public function __construct($emprendedores)
    {
        $this->emprendedores = $emprendedores;
    }

    public function collection()
    {
        return $this->emprendedores;
    }

    public function headings(): array
    {
        return [

            'Nombre',
            'Descripción',
            'Ciudad',
            'Categoría',
            'Fecha de creación'
        ];
    }

    public function map($emprendedor): array
    {
        return [

            $emprendedor->nombre,
            $emprendedor->descripcion,
            $emprendedor->direccion ? $emprendedor->direccion->ciudad : '',
            $emprendedor->categoria ? $emprendedor->categoria->categoria : 'Sin categoría',
            $emprendedor->created_at->format('Y-m-d'),
        ];
    }
}
