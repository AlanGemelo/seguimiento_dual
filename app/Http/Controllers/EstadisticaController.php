<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Estudiantes;
use App\Models\User;
use App\Models\Empresa;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EstadisticasExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use App\Exports\reporteGeneral;
use Illuminate\Support\Str;
use App\Filters\EstudianteFilter;

class EstadisticaController extends Controller
{
    public function index()
    {

        // dd(session('direccion')->id);
        $user = Auth::user();
        $isAdmin = $user->rol_id === 1;
        $direccionId = $isAdmin ? null : session('direccion')->id;

        $empresas = $this->getEmpresas($direccionId, $isAdmin);
        $carreras = $this->getCarreras($direccionId, $isAdmin);
        $mentores = $this->getMentores($direccionId, $isAdmin);
        $becas = $this->getBecas($direccionId, $isAdmin);

        $chartEmpresa = $this->barChart(
            '',
            $empresas->pluck('nombre')->toArray(),
            $empresas->pluck('estudiantes_count')->toArray()
        );

        $chartCarrera = $this->barChart(
            '',
            $carreras->pluck('nombre')->toArray(),
            $carreras->pluck('estudiantes_count')->toArray()
        );

        $chartMentor = $this->barChart(
            '',
            $mentores->map(function ($m) {
                return trim($m->titulo . ' ' . $m->name . ' ' . $m->apellidoP . ' ' . $m->apellidoM);
            })->toArray(),
            $mentores->pluck('estudiantes_count')->toArray()
        );

        $chartBeca = $this->pieChart(
            '',
            $becas->pluck('tipoBeca')->map(fn($b) => match ($b) {
                1 => 'Beca Comecyt',
                0 => 'Apoyo por Empresa',
                default => 'Sin beca',
            })->toArray(),
            $becas->pluck('count')->toArray()
        );

        return view('estadisticas.index', compact(
            'chartEmpresa',
            'chartCarrera',
            'chartMentor',
            'chartBeca',
            'mentores',
            'empresas',
            'carreras'
        ));
    }

    private function getEmpresas($direccionId, $isAdmin)
    {
        return Empresa::when(!$isAdmin, function ($q) use ($direccionId) {
            $q->whereHas('direccionesCarrera', fn($sub) => $sub->where('direccion_id', $direccionId));
        })
            ->withCount('estudiantes')
            ->having('estudiantes_count', '>', 0)
            ->orderByDesc('estudiantes_count')
            ->take(10)
            ->get();
    }

    private function getCarreras($direccionId, $isAdmin)
    {
        return Carrera::when(!$isAdmin, fn($q) => $q->where('direccion_id', $direccionId))
            ->withCount('estudiantes')
            ->having('estudiantes_count', '>', 0)
            ->orderByDesc('estudiantes_count')
            ->take(10)
            ->get();
    }

    private function getMentores($direccionId, $isAdmin)
    {
        return User::mentoresAcademicos()
            ->when(!$isAdmin, fn($q) => $q->where('direccion_id', $direccionId))
            ->withCount('estudiantes')
            ->having('estudiantes_count', '>', 0)
            ->orderByDesc('estudiantes_count')
            ->take(10)
            ->get();
    }

    private function getBecas($direccionId, $isAdmin)
    {
        return Estudiantes::when(!$isAdmin, fn($q) => $q->where('direccion_id', $direccionId))
            ->select('tipoBeca', \DB::raw('count(*) as count'))
            ->groupBy('tipoBeca')
            ->get();
    }

    private function barChart($title, $labels, $data)
    {
        $chart = (new \ArielMejiaDev\LarapexCharts\BarChart)
            ->setTitle($title)
            ->setSubtitle('');

        foreach ($data as $i => $value) {
            $chart->addData(
                $labels[$i] ?? 'Dato',
                [$value]
            );
        }

        return $chart
            ->setXAxis([$title])
            ->setOptions([
                'tooltip' => [
                    'enabled' => false
                ]
            ]);
    }


    private function pieChart($title, $labels, $data)
    {
        return (new LarapexChart)->pieChart()
            ->setTitle($title)
            ->setLabels($labels)
            ->setDataset($data)
            ->setHeight(300)
            ->setColors([
                '#006837',
                '#0c4a6e',
                '#9ca3af',
                '#f59e0b',
                '#ef4444',
                '#8b5cf6',
                '#06b6d4',
                '#7c2d12',
            ]);
    }

    public function getEstudiantesPorStatus($status)
    {
        $user = Auth::user();

        $query = Estudiantes::where('status', $status);

        if ($user->rol_id !== 1) {
            $query->where('direccion_id', session('direccion')->id);
        }

        return response()->json($query->get());
    }


    public function getEstudiantesPorBeca()
    {
        $direccionId = session('direccion')->id;

        $data = Estudiantes::select(
            DB::raw("
            CASE 
                WHEN tipoBeca = 1 THEN 'COMECyT'
                WHEN tipoBeca = 0 THEN 'Apoyo por empresa'
                ELSE 'Sin beca'
            END AS beca
        "),
            DB::raw("COUNT(*) as total")
        )
            ->where('direccion_id', $direccionId)
            ->groupBy(DB::raw("
        CASE 
            WHEN tipoBeca = 1 THEN 'COMECyT'
            WHEN tipoBeca = 0 THEN 'Apoyo por empresa'
            ELSE 'Sin beca'
        END
    "))
            ->pluck('total', 'beca');

        return response()->json($data);
    }


    public function getEstudiantesPorMentor($mentorId)
    {
        return response()->json(
            Estudiantes::where('academico_id', $mentorId)
                ->where('direccion_id', session('direccion')->id)
                ->get()
        );
    }

    public function getEstudiantesPorEmpresa($empresaId)
    {
        return response()->json(
            Estudiantes::where('empresa_id', $empresaId)
                ->where('direccion_id', session('direccion')->id)
                ->get()
        );
    }

    public function getEstudiantesPorCarrera($carreraId)
    {
        return response()->json(
            Estudiantes::where('carrera_id', $carreraId)
                ->where('direccion_id', session('direccion')->id)
                ->get()
        );
    }

    public function exportEstudiantes($query, $filename)
    {
        return Excel::download(new EstadisticasExport($query->get()), $filename);
    }

    public function exportEstudiantesPorStatusExcel($estatus)
    {
        $fecha = now()->format('d-m-y_H-i-s');
        $query = Estudiantes::with(['empresa', 'academico', 'asesorin', 'carrera']);

        switch ($estatus) {
            case '0': // Activos
                $query->whereNull('deleted_at');
                $nombreArchivo = "estudiantes_activos_{$fecha}.xlsx";
                break;

            case '1': // Inactivos
                $query->onlyTrashed();
                $nombreArchivo = "estudiantes_inactivos_{$fecha}.xlsx";
                break;

            default:
                abort(404, 'Estatus no válido');
        }

        return $this->exportEstudiantes($query, $nombreArchivo);
    }
    public function exportEstudiantesPorBecaExcel($beca)
    {
        $fecha = now()->format('d-m-y_H-i-s');

        $nombreArchivo = $beca == 0
            ? "studiantes_becados_{$fecha}.xlsx"
            : "estudiantes_sin_beca_{$fecha}.xlsx";

        return $this->exportEstudiantes(
            Estudiantes::where('beca', $beca)
                ->where('direccion_id', session('direccion')->id)
                ->with(['empresa', 'academico', 'asesorin', 'carrera']),
            $nombreArchivo
        );
    }

    public function exportEstudiantesPorEmpresaExcel($empresaId)
    {
        $fecha = now()->format('d-m-y_H-i-s');
        $empresa = Empresa::findOrFail($empresaId);
        $nombreEmpresa = str_replace(' ', '_', $empresa->nombre);

        return $this->exportEstudiantes(
            Estudiantes::where('empresa_id', $empresaId)
                ->where('direccion_id', session('direccion')->id)
                ->with(['empresa', 'academico', 'asesorin', 'carrera']),
            "estudiantes_{$nombreEmpresa}_{$fecha}.xlsx"
        );
    }

    public function exportEstudiantesPorMentorExcel($mentorId)
    {
        $fecha = now()->format('d-m-y_H-i-s');
        $mentor = User::findOrFail($mentorId);
        $nombreMentor = str_replace(' ', '_', $mentor->name);

        return $this->exportEstudiantes(
            Estudiantes::where('academico_id', $mentorId)
                ->where('direccion_id', session('direccion')->id)
                ->with(['empresa', 'academico', 'asesorin', 'carrera']),
            "estudiantes_{$nombreMentor}_{$fecha}.xlsx"
        );
    }

    public function exportEstudiantesPorCarreraExcel($carreraId)
    {
        $fecha = now()->format('d-m-y_H-i-s');
        $carrera = Carrera::findOrFail($carreraId);
        $nombreCarrera = Str::slug($carrera->nombre, '_');

        return $this->exportEstudiantes(
            Estudiantes::where('carrera_id', $carreraId)
                ->where('direccion_id', session('direccion')->id)
                ->with(['empresa', 'academico', 'asesorin', 'carrera']),
            "estudiantes_{$nombreCarrera}_{$fecha}.xlsx"
        );
    }

    public function exportExcel()
    {
        $fecha = now()->format('d-m-y_H-i-s');
        return Excel::download(
            new EstadisticasExport(
                Estudiantes::where('direccion_id', session('direccion')->id)->get()
            ),
            "estadisticas_{$fecha}.xlsx"
        );
    }

    //Funcion para filtro avanzados
    public function getfiltroEstudiantes(Request $request)
    {
        // dd($request->all());
        // dd($request);
        // $query = Estudiantes::query()
        //     ->where('direccion_id', session('direccion')->id)
        //     ->with(['empresa', 'academico', 'carrera']);
        $query = Estudiantes::withTrashed()
            ->where('direccion_id', session('direccion')->id)
            ->with(['empresa', 'academico', 'carrera']);
        $query = EstudianteFilter::apply($query, $request);

        $estudiantes = $query->get();

        $data = $estudiantes->map(function ($e) {
            return [
                'Matrícula' => $e->matricula,
                'Nombre' => $e->name . ' ' . $e->apellidoP . ' ' . $e->apellidoM,
                'Categoría' => $e->activo == 1 ? 'Dual' : 'Candidato',
                'Estado' => $e->status,
                'Cuatrimestre' => $e->cuatrimestre,
                'Beca' => $e->beca,
                'Tipo de beca' => $e->tipoBeca,
                'Empresa' => $e->empresa->nombre ?? null,
                'Académico' => $e->academico->name ?? null,
                'Asesor Industrial' => $e->asesorin->name ?? null,
                'Programa Educativo' => $e->carrera->nombre ?? null,
                'Proyecto' => $e->nombre_proyecto,
                'Inicio Dual' => $e->inicio_dual,
                'Fin Dual' => $e->fin_dual,
                'Inicio IE' => $e->inicio,
                'Fin IE' => $e->fin,
            ];
        });

        return response()->json($data);
    }


    public function filtroEstudiantes(Request $request)
    {
        $query = Estudiantes::withTrashed()
            ->where('direccion_id', session('direccion')->id)
            ->with(['empresa', 'academico', 'carrera']);
        $query = EstudianteFilter::apply($query, $request);

        $estudiantes = $query->get();

        if ($request->wantsJson()) {
            return response()->json($estudiantes);
        }

        $fecha = now()->format('d-m-y_H-i-s');

        return Excel::download(
            new EstadisticasExport($estudiantes),
            "filtro_estudiantes_{$fecha}.xlsx"
        );
    }


    public function reporteGeneral()
    {
        $fecha = date('Y-m-d_H-i-s');
        $direccionId = session('direccion')->id;

        return Excel::download(new reporteGeneral, "reporte_general_dual_{$fecha}_{$direccionId}.xlsx");
    }

    public function filtrosAvanzados(Request $request)
    {
        $direccionId = session('direccion')->id;

        //Consulta Base (Filtros Primarios y Reglas Fijas)
        $baseQuery = Estudiantes::withTrashed()->where('direccion_id', $direccionId);

        if ($request->tipoAlumno === 'activo') {
            $baseQuery->whereNull('deleted_at')->where('activo', 1);
        } elseif ($request->tipoAlumno === 'inactivo') {
            $baseQuery->whereNotNull('deleted_at')->whereIn('status', [2, 3, 4, 5]);
        }

        if ($request->filled('estatus_academico')) {
            $baseQuery->where('status', $request->estatus_academico);
        }

        if ($request->filled('fechaFiltro') && $request->filled('fechaInicio') && $request->filled('fechaFin')) {
            $inicio = $request->fechaInicio . '-01';
            $fin = date('Y-m-t', strtotime($request->fechaFin . '-01')); // Último día del mes

            if ($request->fechaFiltro === 'inicio_dual' || $request->fechaFiltro === 'fin_dual') {
                $baseQuery->where('inicio_dual', '<=', $fin)
                    ->where(function ($q) use ($inicio) {
                        $q->whereNull('fin_dual')->orWhere('fin_dual', '>=', $inicio);
                    });
            }
        }

        // Closure para aplicar filtros secundarios dinámicamente
        $applyFilters = function ($query, $exclude = null) use ($request) {
            if ($exclude !== 'empresa_id' && $request->filled('empresa_id')) $query->where('empresa_id', $request->empresa_id);
            if ($exclude !== 'academico_id' && $request->filled('academico_id')) $query->where('academico_id', $request->academico_id);
            if ($exclude !== 'carrera_id' && $request->filled('carrera_id')) $query->where('carrera_id', $request->carrera_id);
            if ($exclude !== 'tipoBeca' && $request->filled('tipoBeca') && $request->tipoBeca !== 'sin') $query->where('tipoBeca', $request->tipoBeca);
            if ($exclude !== 'tipoBeca' && $request->tipoBeca === 'sin') $query->whereNull('tipoBeca');
            return $query;
        };

        // Obtener IDs disponibles (Ignorando su propio filtro)
        $empresasIds = (clone $baseQuery)->tap(fn($q) => $applyFilters($q, 'empresa_id'))->distinct()->pluck('empresa_id')->filter();
        $mentoresIds = (clone $baseQuery)->tap(fn($q) => $applyFilters($q, 'academico_id'))->distinct()->pluck('academico_id')->filter();
        $carrerasIds = (clone $baseQuery)->tap(fn($q) => $applyFilters($q, 'carrera_id'))->distinct()->pluck('carrera_id')->filter();

        $becasDisponibles = (clone $baseQuery)->tap(fn($q) => $applyFilters($q, 'tipoBeca'))->distinct()->pluck('tipoBeca');

        // Obtener Resultados Finales (Aplicando TODOS los filtros)
        $estudiantes = (clone $baseQuery)
            ->tap(fn($q) => $applyFilters($q))
            ->with(['empresa', 'academico', 'carrera'])
            ->get();

        // Retornar JSON para AJAX
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'resultados' => $estudiantes->map(fn($e) => [
                    'Matrícula' => $e->matricula,
                    'Nombre' => $e->name . ' ' . $e->apellidoP . ' ' . $e->apellidoM,
                    'Empresa' => $e->empresa->nombre ?? '',
                    'Programa Educativo' => $e->carrera->nombre ?? ''
                ]),
                'opciones' => [
                    'empresas' => Empresa::whereIn('id', $empresasIds)->get(['id', 'nombre']),
                    'mentores' => User::whereIn('id', $mentoresIds)->get(['id', 'name', 'apellidoP', 'apellidoM', 'titulo']),
                    'carreras' => Carrera::whereIn('id', $carrerasIds)->get(['id', 'nombre']),
                    'becas' => $becasDisponibles
                ]
            ]);
        }

        $fecha = now()->format('d-m-y_H-i-s');
        return Excel::download(new EstadisticasExport($estudiantes), "filtro_estudiantes_{$fecha}.xlsx");
    }
}
