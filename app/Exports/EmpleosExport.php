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

    /**
     * @return \Illuminate\Support\Collection
     */
    /*rotected $filtros;

    public function __construct(array $filtros = [])
    {
        $this->filtros = $filtros;
    }

    public function collection()
    {
        $query = Empleo::select(
            'id',
            'nombre',
            'asunto',
            'email',
            'telefono',
            'edad',
            'dni',
            'ciudad',
            'localidad',
            'formacion',
            'nombre_curso',
            'description',
            'referencia_laboral',
            'referencia_rubro',
            'referencia_actividad',
            'contratista',
            'referencia_telefonica',
            'cud',
            'dependencia',
            'cv_path',
            'created_at'
        );

        //filtrar por ciudad
        if (isset($this->filtros['ciudad'])) {
            $query->where('ciudad', $this->filtros['ciudad']);
        }
        //filtrar por edad
        if (isset($this->filtros['edad'])) {
            $query->where('edad', $this->filtros['edad']);
        }
        //filtrar por fecha
        if (isset($this->filtros['created_at'])) {
            $query->whereDate('created_at', $this->filtros['created_at']);
        }
        //filtrar por si posee cud era boolean
        if (isset($this->filtros['cud'])) {
            $query->where('cud', $this->filtros['cud']);
        }
        //filtrar por dni
        if (isset($this->filtros['dni'])) {
            $query->where('dni', $this->filtros['dni']);
        }
        //filtrar por nombre
        if (isset($this->filtros['nombre'])) {
            $query->where('nombre', 'like', '%' . $this->filtros['nombre'] . '%');
        }

        return $query->get();
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
        */
}
