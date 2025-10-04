<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Estudiantes;
use App\Models\User;
use App\Models\Empresa;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EstadisticasExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use App\Exports\reporteGeneral;

class EstadisticaController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        if ($user->rol_id === 1) {
            // Gráfica de Estudiantes por Empresa
            $empresas = Empresa::withCount('estudiantes')
                ->having('estudiantes_count', '>', 0)
                ->get();

            $totalEstudiantes = $empresas->sum('estudiantes_count');

            $labels = $empresas->map(function ($empresa) use ($totalEstudiantes) {
                $porcentaje = $totalEstudiantes > 0 ? round(($empresa->estudiantes_count / $totalEstudiantes) * 100, 1) : 0;
                return "{$empresa->nombre} ({$porcentaje}%)";
            });

            $chartEmpresa = (new LarapexChart)->pieChart()
                ->setTitle('Estudiantes por Empresa')
                ->setLabels($labels->toArray())
                ->setDataset($empresas->pluck('estudiantes_count')->toArray())
                ->setHeight(300)
                ->setColors(['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40']);

            // Gráfica de Estudiantes por Carrera
            $carreras = Carrera::withCount('estudiantes')
                ->having('estudiantes_count', '>', 0)
                ->get();

            $totalEstudiantes = $carreras->sum('estudiantes_count');

            $labels = $carreras->map(function ($carrera) use ($totalEstudiantes) {
                $porcentaje = $totalEstudiantes > 0 ? round(($carrera->estudiantes_count / $totalEstudiantes) * 100, 1) : 0;
                return "{$carrera->nombre} ({$porcentaje}%)";
            });

            $chartCarrera = (new LarapexChart)->pieChart()
                ->setTitle('Estudiantes por Carrera')
                ->setLabels($labels->toArray())
                ->setDataset($carreras->pluck('estudiantes_count')->toArray())
                ->setHeight(300)
                ->setColors(['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40']);

            // Gráfica de Estudiantes por Mentor Académico
            $mentores = User::mentoresAcademicos()->withCount('estudiantes')
                ->having('estudiantes_count', '>', 0)
                ->get();

            $totalEstudiantes = $mentores->sum('estudiantes_count');

            $labels = $mentores->map(function ($mentor) use ($totalEstudiantes) {
                $porcentaje = $totalEstudiantes > 0 ? round(($mentor->estudiantes_count / $totalEstudiantes) * 100, 1) : 0;
                return "{$mentor->name} ({$porcentaje}%)";
            });

            $chartMentor = (new LarapexChart)->pieChart()
                ->setTitle('Estudiantes por Mentor Académico')
                ->setLabels($labels->toArray())
                ->setDataset($mentores->pluck('estudiantes_count')->toArray())
                ->setHeight(300)
                ->setColors(['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40']);

            // Gráfica de Estudiantes Becados
            $becas = Estudiantes::select('tipoBeca', \DB::raw('count(*) as count'))
                ->groupBy('tipoBeca')
                ->get();
            $chartBeca = (new LarapexChart)->pieChart()
                ->setTitle('Estudiantes Becados')
                ->setLabels($becas->pluck('tipoBeca')->map(fn($beca) => $beca ? 'Beca Comecyt' : 'Apoyo por Empresa')->toArray())
                ->setDataset($becas->pluck('count')->toArray())
                ->setHeight(300)
                ->setColors(['#FF6384', '#36A2EB', '#FFCE56']);
        } else {
            $direccionId = session('direccion')->id;

            // Gráfica de Estudiantes por Empresa
            /*  $empresas = Empresa::whereHas('direccionesCarrera', function ($q) use ($direccionId) {
                $q->where('direccion_id', $direccionId);
            })->get(); */
            $empresas = Empresa::whereHas('direccionesCarrera', function ($q) use ($direccionId) {
                $q->where('direccion_id', $direccionId);
            })->withCount('estudiantes')->get();

            $labels = $empresas->map(function ($empresa) use ($totalEstudiantes) {
                $porcentaje = $totalEstudiantes > 0 ? round(($empresa->estudiantes_count / $totalEstudiantes) * 100, 1) : 0;
                return "{$empresa->nombre} ({$porcentaje}%)";
            });

            $chartEmpresa = (new LarapexChart)->pieChart()
                ->setTitle('Estudiantes por Empresa')
                ->setLabels($labels->toArray())
                ->setDataset($empresas->pluck('estudiantes_count')->toArray())
                ->setHeight(300)
                ->setColors(['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40']);

            // Gráfica de Estudiantes por Carrera
            $carreras = Carrera::where('direccion_id', $direccionId)->withCount('estudiantes')->get();

            $labels = $carreras->map(function ($carrera) use ($totalEstudiantes) {
                $porcentaje = $totalEstudiantes > 0 ? round(($carrera->estudiantes_count / $totalEstudiantes) * 100, 1) : 0;
                return "{$carrera->nombre} ({$porcentaje}%)";
            });

            $chartCarrera = (new LarapexChart)->pieChart()
                ->setTitle('Estudiantes por Carrera')
                ->setLabels($labels->toArray())
                ->setDataset($carreras->pluck('estudiantes_count')->toArray())
                ->setHeight(300)
                ->setColors(['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40']);

            // Gráfica de Estudiantes por Mentor Académico
            $mentores = User::mentoresAcademicos()->where('direccion_id', $direccionId)->withCount('estudiantes')->get();

            $labels = $mentores->map(function ($mentor) use ($totalEstudiantes) {
                $porcentaje = $totalEstudiantes > 0 ? round(($mentor->estudiantes_count / $totalEstudiantes) * 100, 1) : 0;
                return "{$mentor->nombre} ({$porcentaje}%)";
            });

            $chartMentor = (new LarapexChart)->pieChart()
                ->setTitle('Estudiantes por Mentor Académico')
                ->setLabels($labels->toArray())
                ->setDataset($mentores->pluck('estudiantes_count')->toArray())
                ->setHeight(300)
                ->setColors(['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40']);

            // Gráfica de Estudiantes Becados
            $becas = Estudiantes::where('direccion_id', $direccionId)
                ->select('tipoBeca', \DB::raw('count(*) as count'))
                ->groupBy('tipoBeca')
                ->get();

            $labels = $becas->map(function ($beca) use ($totalEstudiantes) {
                $porcentaje = $totalEstudiantes > 0 ? round(($beca->estudiantes_count / $totalEstudiantes) * 100, 1) : 0;
                return "{$beca->nombre} ({$porcentaje}%)";
            });

            $chartBeca = (new LarapexChart)->pieChart()
                ->setTitle('Estudiantes Becados')
                ->setLabels($becas->pluck('tipoBeca')->map(fn($beca) => $beca ? 'Apoyo por Empresa' : 'Beca Comecyt')->toArray())
                ->setDataset($becas->pluck('count')->toArray())
                ->setHeight(300)
                ->setColors(['#FF6384', '#36A2EB', '#FFCE56']);
        }

        return view('Estadistica.index', compact('chartEmpresa', 'chartCarrera', 'chartMentor', 'chartBeca', 'mentores', 'empresas', 'carreras'));
    }

    public function getEstudiantesPorStatus($status)
    {
        $user = Auth::user();

        if ($user->rol_id === 1) {
            $estudiantes = Estudiantes::where('status', $status)->get();
        } else {
            $direccionId = session('direccion')->id;
            $estudiantes = Estudiantes::where('status', $status)
                ->where('direccion_id', $direccionId)
                ->get();
        }


        return response()->json($estudiantes);
    }

    public function getEstudiantesPorBeca($beca)
    {
        $direccionId = session('direccion')->id;
        $becaValue = $beca === 'becados' ? 1 : 0;
        $estudiantes = Estudiantes::where('beca', $becaValue)
            ->where('direccion_id', $direccionId)
            ->get();
        return response()->json($estudiantes);
    }

    public function getEstudiantesPorMentor($mentorId)
    {
        $direccionId = session('direccion')->id;
        $estudiantes = Estudiantes::where('academico_id', $mentorId)
            ->where('direccion_id', $direccionId)
            ->get();
        return response()->json($estudiantes);
    }

    public function getEstudiantesPorEmpresa($empresaId)
    {
        $direccionId = session('direccion')->id;
        $estudiantes = Estudiantes::where('empresa_id', $empresaId)
            ->where('direccion_id', $direccionId)
            ->get();
        return response()->json($estudiantes);
    }

    public function getEstudiantesPorCarrera($carreraId)
    {
        $direccionId = session('direccion')->id;
        $estudiantes = Estudiantes::where('carrera_id', $carreraId)
            ->where('direccion_id', $direccionId)
            ->get();
        return response()->json($estudiantes);
    }

    public function exportEstudiantesPorStatusExcel($status)
    {
        $direccionId = session('direccion')->id;
        $estudiantes = Estudiantes::where('status', $status)
            ->where('direccion_id', $direccionId)
            ->with(['empresa', 'academico', 'asesorin', 'carrera'])
            ->get();
        return Excel::download(new EstadisticasExport($estudiantes), 'estudiantes_status.xlsx');
    }

    public function exportEstudiantesPorBecaExcel($beca)
    {
        $direccionId = session('direccion')->id;
        $becaValue = $beca === 'becados' ? 1 : 0;
        $estudiantes = Estudiantes::where('beca', $becaValue)
            ->where('direccion_id', $direccionId)
            ->with(['empresa', 'academico', 'asesorin', 'carrera'])
            ->get();
        return Excel::download(new EstadisticasExport($estudiantes), 'estudiantes_beca.xlsx');
    }

    public function exportEstudiantesPorEmpresaExcel($empresaId)
    {
        $direccionId = session('direccion')->id;
        $estudiantes = Estudiantes::where('empresa_id', $empresaId)
            ->where('direccion_id', $direccionId)
            ->with(['empresa', 'academico', 'asesorin', 'carrera'])
            ->get();
        return Excel::download(new EstadisticasExport($estudiantes), 'estudiantes_empresa.xlsx');
    }

    public function exportEstudiantesPorMentorExcel($mentorId)
    {
        $direccionId = session('direccion')->id;
        $estudiantes = Estudiantes::where('academico_id', $mentorId)
            ->where('direccion_id', $direccionId)
            ->with(['empresa', 'academico', 'asesorin', 'carrera'])
            ->get();
        return Excel::download(new EstadisticasExport($estudiantes), 'estudiantes_mentor.xlsx');
    }

    public function exportEstudiantesPorCarreraExcel($carreraId)
    {
        $direccionId = session('direccion')->id;
        $estudiantes = Estudiantes::where('carrera_id', $carreraId)
            ->where('direccion_id', $direccionId)
            ->with(['empresa', 'academico', 'asesorin', 'carrera'])
            ->get();
        return Excel::download(new EstadisticasExport($estudiantes), 'estudiantes_carrera.xlsx');
    }

    public function exportExcel()
    {
        $direccionId = session('direccion')->id;
        $estudiantes = Estudiantes::where('direccion_id', $direccionId)->get();
        return Excel::download(new EstadisticasExport($estudiantes), 'estadisticas.xlsx');
    }

    public function exportEstudiantesPorEmpresaPdf($empresaId)
    {
        $direccionId = session('direccion')->id;
        $empresa = Empresa::where('id', $empresaId)
            ->where('direccion_id', $direccionId)
            ->firstOrFail();
        $estudiantes = Estudiantes::where('empresa_id', $empresaId)
            ->where('direccion_id', $direccionId)
            ->get();

        $pdf = Pdf::loadView('estadistica.estudiantes_empresa_pdf', compact('empresa', 'estudiantes'));
        return $pdf->download('estudiantes_empresa.pdf');
    }

    public function exportEstudiantesPorMentorPdf($mentorId)
    {
        $direccionId = session('direccion')->id;
        $mentor = User::where('id', $mentorId)
            ->where('direccion_id', $direccionId)
            ->firstOrFail();
        $estudiantes = Estudiantes::where('academico_id', $mentorId)
            ->where('direccion_id', $direccionId)
            ->get();

        $pdf = Pdf::loadView('estadistica.estudiantes_mentor_pdf', compact('mentor', 'estudiantes'));
        return $pdf->download('estudiantes_mentor.pdf');
    }

    public function exportEstudiantesPorCarreraPdf($carreraId)
    {
        $direccionId = session('direccion')->id;
        $carrera = Carrera::where('id', $carreraId)
            ->where('direccion_id', $direccionId)
            ->firstOrFail();
        $estudiantes = Estudiantes::where('carrera_id', $carreraId)
            ->where('direccion_id', $direccionId)
            ->get();

        $pdf = Pdf::loadView('estadistica.estudiantes_carrera_pdf', compact('carrera', 'estudiantes'));
        return $pdf->download('estudiantes_carrera.pdf');
    }

    public function filtroEstudiantes(Request $request)
    {
        $direccionId = session('direccion')->id;
        $query = Estudiantes::query()
            ->where('direccion_id', $direccionId)
            ->with(['empresa', 'academico', 'asesorin', 'carrera']);

        if ($request->filled('empresa_id')) {
            $query->where('empresa_id', $request->empresa_id);
        }

        if ($request->filled('academico_id')) {
            $query->where('academico_id', $request->academico_id);
        }

        if ($request->filled('carrera_id')) {
            $query->where('carrera_id', $request->carrera_id);
        }

        if ($request->filled('tipoBeca')) {
            $query->where('beca', $request->tipoBeca);
        }

        if ($request->filled('estatus')) {
            if ($request->estatus === 'activo') {
                $query->where('activo', 1);
            } else {
                $query->onlyTrashed()->where('status', $request->estatus);
            }
        }

        if ($request->filled('fechaFiltro')) {
            if ($request->fechaFiltro === 'inicio' && $request->filled('fechaInicio') && $request->filled('fechaFin')) {
                $query->whereBetween('inicio', [$request->fechaInicio, $request->fechaFin]);
            } elseif ($request->fechaFiltro === 'fin' && $request->filled('fechaInicio') && $request->filled('fechaFin')) {
                $query->whereBetween('fin', [$request->fechaInicio, $request->fechaFin]);
            } elseif ($request->fechaFiltro === 'inicio_dual' && $request->filled('fechaInicio') && $request->filled('fechaFin')) {
                $query->whereBetween('inicio_dual', [$request->fechaInicio, $request->fechaFin]);
            } elseif ($request->fechaFiltro === 'fin_dual' && $request->filled('fechaInicio') && $request->filled('fechaFin')) {
                $query->whereBetween('fin_dual', [$request->fechaInicio, $request->fechaFin]);
            }
        }

        $estudiantes = $query->get();

        if ($request->wantsJson()) {
            return response()->json($estudiantes);
        }

        return Excel::download(new EstadisticasExport($estudiantes), 'filtro_estudiantes.xlsx');
    }

    public function getGraficasData()
    {
        try {
            $empresas = Empresa::withCount('estudiantes')->get();
            $carreras = Carrera::withCount('estudiantes')->get();
            $mentores = User::mentoresAcademicos()->withCount('estudiantes')->get();
            $becas = Estudiantes::select('beca', \DB::raw('count(*) as count'))
                ->groupBy('beca')
                ->get();

            $data = [
                'empresas' => [
                    'labels' => $empresas->pluck('nombre')->toArray(),
                    'counts' => $empresas->pluck('estudiantes_count')->toArray()
                ],
                'carreras' => [
                    'labels' => $carreras->pluck('nombre')->toArray(),
                    'counts' => $carreras->pluck('estudiantes_count')->toArray()
                ],
                'mentores' => [
                    'labels' => $mentores->pluck('name')->toArray(),
                    'counts' => $mentores->pluck('estudiantes_count')->toArray()
                ],
                'becas' => [
                    'labels' => $becas->pluck('beca')->map(function ($beca) {
                        return $beca ? 'Becados' : 'Sin Beca';
                    })->toArray(),
                    'counts' => $becas->pluck('count')->toArray()
                ]
            ];

            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    //Funcion para generar el reporte general en excel
    public function reporteGeneral()
    {
        $fecha = date('Y-m-d_H-i-s');
        $nombreArchivo = "reporte general dual {$fecha}.xlsx";

        return Excel::download(new reporteGeneral, $nombreArchivo);
    }
}
