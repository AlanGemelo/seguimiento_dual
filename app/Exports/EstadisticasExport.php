<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class EstadisticasExport implements FromCollection, WithHeadings, ShouldAutoSize,  WithEvents
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
                'nombre' => trim(
                    ($estudiante->name ?? '') . ' ' .
                        ($estudiante->apellidoP ?? '') . ' ' .
                        ($estudiante->apellidoM ?? '')
                ),
                'activo' => [
                    '0' => 'Candidato',
                    '1' => 'Dual',
                ][$estudiante->activo] ?? 'Desconocido',
                'status' => [
                    0 => 'Primera vez',
                    1 => 'Renovación Dual',
                    2 => 'Reprobación',
                    3 => 'Término de Convenio',
                    4 => 'Ciclo de Renovación Concluido',
                    5 => 'Término del PE',
                ][$estudiante->status] ?? 'Desconocido',
                'cuatrimestre' => $estudiante->cuatrimestre,
                'beca' => [
                    0 => 'Sí',
                    1 => 'No'
                ][$estudiante->beca] ?? 'N/A',
                'Tipo_beca' => [
                    0 => 'Apoyo por Empresa',
                    1 => 'Beca Dual Comecyt'
                ][$estudiante->tipoBeca] ?? 'N/A',
                'empresa' => $estudiante->empresa?->nombre ?? 'Sin Empresa',
                'academico' => $estudiante->academico
                    ? trim(
                        ($estudiante->academico->titulo ?? '') . ' ' .
                            ($estudiante->academico->name ?? '') . ' ' .
                            ($estudiante->academico->apellidoP ?? '') . ' ' .
                            ($estudiante->academico->apellidoM ?? '')
                    )
                    : 'Sin Académico',
                'asesorin' => $estudiante->asesorin
                    ? trim(
                        ($estudiante->asesorin->name ?? '') . ' ' .
                            ($estudiante->asesorin->apellidoP ?? '') . ' ' .
                            ($estudiante->asesorin->apellidoM ?? '')
                    )
                    : 'Sin Asesor Industrial',
                'Programa Educativo' => $estudiante->carrera?->nombre ?? 'Sin Carrera',
                'proyecto' => $estudiante->nombre_proyecto ?? 'N/A',
                'inicio_dual' => $estudiante->inicio_dual ?? 'N/A',
                'fin_dual' => $estudiante->fin_dual ?? 'N/A',
                'inicio_ie' => $estudiante->inicio ?? 'N/A',
                'fin_ie' => $estudiante->fin ?? 'N/A',
            ];
        });
    }

    public function headings(): array
    {
        return collect([
            'Matrícula',
            'Nombre',
            'Categoría',
            'Estado',
            'Cuatrimestre',
            'Beca',
            'Tipo de beca',
            'Empresa',
            'Académico',
            'Asesor Industrial',
            'Programa Educativo',
            'Proyecto',
            'Inicio Dual',
            'Fin Dual',
            'Inicio IE',
            'Fin IE',
        ])->map(fn($h) => Str::title($h))->toArray();
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                $sheet = $event->sheet->getDelegate();
                $sheet->getStyle('A1:P1000')->applyFromArray([
                    'font' => [
                        'color' => ['rgb' => '000000'],
                        'size' => 11,
                    ],
                ]);

                $sheet->getStyle('A1:P1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                ]);
            },
        ];
    }
}
