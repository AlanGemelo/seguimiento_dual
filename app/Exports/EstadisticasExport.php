<?php

namespace App\Exports;

use App\Models\Estudiantes;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EstadisticasExport implements FromCollection, WithHeadings
{
    protected $estudiantes;

    public function __construct($estudiantes = null)
    {
        $this->estudiantes = $estudiantes ?: Estudiantes::all();
    }

    public function collection()
    {
        return $this->estudiantes;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nombre',
            'Email',
            'Teléfono',
            'Fecha de Registro',
            'Beca',
            'Activo',
            'Status',
            'Fecha de Creación',
            'Fecha de Actualización',
        ];
    }
}
