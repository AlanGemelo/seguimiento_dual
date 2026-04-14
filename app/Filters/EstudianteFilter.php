<?php

namespace App\Filters;

class EstudianteFilter
{
    public static function apply($query, $request)
    {
        return $query

            // Tipo de alumno: define el universo base según deleted_at
            ->when($request->tipoAlumno, function ($q) use ($request) {
                if ($request->tipoAlumno === 'activo') {
                    $q->whereNull('deleted_at')->where('activo', 1)->whereIn('status', [0, 1]); // activos reales
                }
                if ($request->tipoAlumno === 'inactivo') {
                    $q->whereNotNull('deleted_at')->whereIn('status', [2, 3, 4, 5]); // inactivos (soft delete)
                }
            })

            // Estatus académico: refina dentro del universo ya definido
            ->when($request->estatus_academico !== null && $request->estatus_academico !== '', function ($q) use ($request) {
                $q->where('status', $request->estatus_academico); // filtro puntual por status
            })

            // Empresa
            ->when($request->filled('empresa_id'), fn($q) => $q->where('empresa_id', $request->empresa_id)) // filtra por empresa

            // Mentor académico
            ->when($request->filled('academico_id'), fn($q) => $q->where('academico_id', $request->academico_id)) // filtra por mentor

            // Carrera
            ->when($request->filled('carrera_id'), fn($q) => $q->where('carrera_id', $request->carrera_id)) // filtra por carrera

            // Tipo de beca (incluye sin beca)
            ->when($request->filled('tipoBeca'), function ($q) use ($request) {
                if ($request->tipoBeca === 'sin') {
                    $q->whereNull('tipoBeca'); // sin beca
                } else {
                    $q->where('tipoBeca', $request->tipoBeca); // con beca específica
                }
            })

            // Filtro por campo de fecha específico
            ->when(
                $request->filled('fechaFiltro') &&
                    $request->filled('fechaInicio') &&
                    $request->filled('fechaFin'),
                function ($q) use ($request) {
                    $inicio = $request->fechaInicio . '-01'; // inicio mes
                    $fin = $request->fechaFin . '-31'; // fin mes
                    $q->whereBetween($request->fechaFiltro, [$inicio, $fin]); // filtro directo por campo
                }
            )

            // Filtro por periodo real (dual)
            ->when(
                !$request->filled('fechaFiltro') &&
                    $request->filled('fechaInicio') &&
                    $request->filled('fechaFin'),
                function ($q) use ($request) {
                    $inicio = $request->fechaInicio . '-01'; // inicio rango
                    $fin = $request->fechaFin . '-31'; // fin rango
                    $q->where('inicio_dual', '<=', $fin) // empezó antes del fin
                        ->where(function ($sub) use ($inicio) {
                            $sub->whereNull('fin_dual')->orWhere('fin_dual', '>=', $inicio); // sigue activo o terminó después
                        });
                }
            );
    }
}
