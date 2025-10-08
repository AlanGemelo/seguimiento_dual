<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class reporteGeneral implements FromCollection, WithHeadings, WithStyles, WithColumnWidths
{
    /**
     * Recupera la colección de datos para el reporte.
     */
    public function collection()
    {
        $data = DB::select("
            SELECT
                e.matricula AS Matricula,

                IFNULL(CONCAT(e.name, ' ', e.apellidoP, ' ', e.apellidoM), 'No disponible') AS Alumno,

                IFNULL(c.nombre, 'No disponible') AS Nombre_Carrera,

                IFNULL(e.inicio, 'No disponible') AS Fecha_Inicio,
                IFNULL(e.fin, 'No disponible') AS Fecha_Termino,

                CASE e.status
                    WHEN 0 THEN 'Primera vez'
                    WHEN 1 THEN 'Renovación Dual'
                    WHEN 2 THEN 'Reprobación'
                    WHEN 3 THEN 'Término de convenio'
                    WHEN 4 THEN 'Ciclo de renovación concluido'
                    WHEN 5 THEN 'Término del PE'
                    ELSE 'Desconocido'
                END AS Estatus_Estudiante,

                CASE 
                    WHEN e.beca = 0 THEN 'Sí'
                    WHEN e.beca = 1 THEN 'No'
                    ELSE 'No disponible'
                END AS Beca,

                CASE 
                    WHEN e.tipoBeca = 0 THEN 'Apoyo por Empresa'
                    WHEN e.tipoBeca = 1 THEN 'Beca Dual Comecyt'
                    ELSE 'No disponible'
                END AS Tipo_Beca,

                IFNULL(CONCAT(ma.name, ' ', ma.apellidoP, ' ', ma.apellidoM), 'No disponible') AS Mentor_Academico,

                (
                    SELECT COUNT(*)
                    FROM estudiantes e2
                    WHERE e2.academico_id = e.academico_id
                ) AS Num_Alumnos_Mentor,

                IFNULL(emp.nombre, 'No disponible') AS Empresa,

                IFNULL(CONCAT(mi.name, ' ', mi.apellidoP, ' ', mi.apellidoM), 'No disponible') AS Mentor_Industrial,

                IFNULL(e.nombre_proyecto, 'No disponible') AS Proyecto

            FROM estudiantes e
            LEFT JOIN carreras c ON e.carrera_id = c.id
            LEFT JOIN users ma ON e.academico_id = ma.id AND ma.rol_id = 2
            LEFT JOIN empresas emp ON e.empresa_id = emp.id
            LEFT JOIN mentor_industrials mi ON e.asesorin_id = mi.id

            ORDER BY Alumno ASC;
        ");

        return collect($data);
    }

    /**
     * Define los encabezados de las columnas del Excel.
     */
    public function headings(): array
    {
        return [
            'Matricula',
            'Alumno',
            'Nombre_Carrera',
            'Fecha_Inicio',
            'Fecha_Termino',
            'Estatus_Estudiante',
            'Beca',
            'Tipo_Beca',
            'Mentor_Academico',
            'Num_Alumnos_Mentor',
            'Empresa',
            'Mentor_Industrial',
            'Proyecto',
        ];
    }

    /**
     * Aplica estilos al archivo de Excel.
     */
    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => [
                    'bold' => true,
                    'size' => 12,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ];
    }

    /**
     * Define anchos personalizados para cada columna.
     */
    public function columnWidths(): array
    {
        return [
            'A' => 15, // Matricula
            'B' => 30, // Alumno
            'C' => 25, // Nombre_Carrera
            'D' => 15, // Fecha_Inicio
            'E' => 15, // Fecha_Termino
            'F' => 25, // Estatus_Estudiante
            'G' => 10, // Beca
            'H' => 25, // Tipo_Beca
            'I' => 30, // Mentor_Academico
            'J' => 15, // Num_Alumnos_Mentor
            'K' => 30, // Empresa
            'L' => 30, // Mentor_Industrial
            'M' => 40, // Proyecto
        ];
    }
}
