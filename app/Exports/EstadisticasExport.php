<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EstadisticasExport implements FromCollection, WithHeadings
{
    protected $estudiantes;

    public function __construct($estudiantes = null)
    {
        $this->estudiantes = $estudiantes ?: \App\Models\Estudiantes::with(['empresa', 'academico', 'asesorin', 'carrera'])->get();
    }

    public function collection()
    {
        return $this->estudiantes->map(function ($estudiante) {
            return [
                'matricula' => $estudiante->matricula,
                'nombre' => $estudiante->name,
                'activo' => $estudiante->activo ? 'Activo' : 'Inactivo',
                'cuatrimestre' => $estudiante->cuatrimestre,
                'beca' => $estudiante->beca ? 'Becado' : 'Sin Beca',
                'empresa' => $estudiante->empresa->nombre ?? 'Sin Empresa',
                'academico' => $estudiante->academico->name ?? 'Sin Académico',
                'asesorin' => $estudiante->asesorin->name ?? 'Sin Asesor Industrial',
                'Programa Educativo' => $estudiante->carrera->nombre ?? 'Sin Carrera',
                'proyecto' => $estudiante->nombre_proyecto,
                'inicio_dual' => $estudiante->inicio_dual,
                'fin_dual' => $estudiante->fin_dual,
                'inicio_ie' => $estudiante->inicio,
                'fin_ie' => $estudiante->fin,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Matrícula',
            'Nombre',
            'Activo',
            'Cuatrimestre',
            'Beca',
            'Empresa',
            'Académico',
            'Asesor Industrial',
            'Programa Educativo',
            'Proyecto',
            'Inicio Dual',
            'Fin Dual',
            'Inicio IE',
            'Fin IE',
        ];
    }
}
