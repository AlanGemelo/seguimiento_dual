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

class EstadisticaController extends Controller
{
    public function index()
    {
        // Gráfica de Estudiantes por Empresa
        $empresas = Empresa::withCount('estudiantes')->get();
        $chartEmpresa = (new LarapexChart)->pieChart()
            ->setTitle('Estudiantes por Empresa')
            ->setLabels($empresas->pluck('nombre')->toArray())
            ->setDataset($empresas->pluck('estudiantes_count')->toArray())
            ->setColors(['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40']);

        // Gráfica de Estudiantes por Carrera
        $carreras = Carrera::withCount('estudiantes')->get();
        $chartCarrera = (new LarapexChart)->pieChart()
            ->setTitle('Estudiantes por Carrera')
            ->setLabels($carreras->pluck('nombre')->toArray())
            ->setDataset($carreras->pluck('estudiantes_count')->toArray())
            ->setColors(['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40']);

        // Gráfica de Estudiantes por Mentor Académico
        $mentores = User::mentoresAcademicos()->withCount('estudiantes')->get();
        $chartMentor = (new LarapexChart)->pieChart()
            ->setTitle('Estudiantes por Mentor Académico')
            ->setLabels($mentores->pluck('name')->toArray())
            ->setDataset($mentores->pluck('estudiantes_count')->toArray())
            ->setColors(['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40']);

        // Gráfica de Estudiantes Becados
        $becas = Estudiantes::select('beca', \DB::raw('count(*) as count'))
            ->groupBy('beca')
            ->get();
        $chartBeca = (new LarapexChart)->pieChart()
            ->setTitle('Estudiantes Becados')
            ->setLabels($becas->pluck('beca')->map(fn($beca) => $beca ? 'Becados' : 'Sin Beca')->toArray())
            ->setDataset($becas->pluck('count')->toArray())
            ->setColors(['#FF6384', '#36A2EB']);

        // Enviar variables a la vista
        return view('Estadistica.index', compact('chartEmpresa', 'chartCarrera', 'chartMentor', 'chartBeca', 'mentores', 'empresas', 'carreras'));
    }

    public function getEstudiantesPorStatus($status)
    {
        $estudiantes = Estudiantes::where('status', $status)->get();
        return response()->json($estudiantes);
    }

    public function getEstudiantesPorBeca($beca)
    {
        $becaValue = $beca === 'becados' ? 1 : 0;
        $estudiantes = Estudiantes::where('beca', $becaValue)->get();
        return response()->json($estudiantes);
    }

    public function getEstudiantesPorMentor($mentorId)
    {
        $estudiantes = Estudiantes::where('academico_id', $mentorId)->get();
        return response()->json($estudiantes);
    }

    public function getEstudiantesPorEmpresa($empresaId)
    {
        $estudiantes = Estudiantes::where('empresa_id', $empresaId)->get();
        return response()->json($estudiantes);
    }

    public function getEstudiantesPorCarrera($carreraId)
    {
        $estudiantes = Estudiantes::where('carrera_id', $carreraId)->where('direccion_id', session('direccion')->id)->get();
        return response()->json($estudiantes);
    }

    public function exportEstudiantesPorStatusExcel($status)
    {
        $estudiantes = Estudiantes::where('status', $status)
            ->with(['empresa', 'academico', 'asesorin', 'carrera'])
            ->get();
        return Excel::download(new EstadisticasExport($estudiantes), 'estudiantes_status.xlsx');
    }

    public function exportEstudiantesPorBecaExcel($beca)
    {
        $becaValue = $beca === 'becados' ? 1 : 0;
        $estudiantes = Estudiantes::where('beca', $becaValue)
            ->with(['empresa', 'academico', 'asesorin', 'carrera'])
            ->get();
        return Excel::download(new EstadisticasExport($estudiantes), 'estudiantes_beca.xlsx');
    }

    public function exportEstudiantesPorEmpresaExcel($empresaId)
    {
        $estudiantes = Estudiantes::where('empresa_id', $empresaId)
            ->with(['empresa', 'academico', 'asesorin', 'carrera'])
            ->get();
        return Excel::download(new EstadisticasExport($estudiantes), 'estudiantes_empresa.xlsx');
    }

    public function exportEstudiantesPorMentorExcel($mentorId)
    {
        $estudiantes = Estudiantes::where('academico_id', $mentorId)
            ->with(['empresa', 'academico', 'asesorin', 'carrera'])
            ->get();
        return Excel::download(new EstadisticasExport($estudiantes), 'estudiantes_mentor.xlsx');
    }

    public function exportEstudiantesPorCarreraExcel($carreraId)
    {
        $estudiantes = Estudiantes::where('carrera_id', $carreraId)
            ->with(['empresa', 'academico', 'asesorin', 'carrera'])
            ->get();
        return Excel::download(new EstadisticasExport($estudiantes), 'estudiantes_carrera.xlsx');
    }

    public function exportExcel()
    {
        return Excel::download(new EstadisticasExport, 'estadisticas.xlsx');
    }

    public function exportEstudiantesPorEmpresaPdf($empresaId)
    {
        $empresa = Empresa::findOrFail($empresaId);
        $estudiantes = Estudiantes::where('empresa_id', $empresaId)->get();

        $pdf = Pdf::loadView('estadistica.estudiantes_empresa_pdf', compact('empresa', 'estudiantes'));
        return $pdf->download('estudiantes_empresa.pdf');
    }

    public function exportEstudiantesPorMentorPdf($mentorId)
    {
        $mentor = User::findOrFail($mentorId);
        $estudiantes = Estudiantes::where('academico_id', $mentorId)->get();

        $pdf = Pdf::loadView('estadistica.estudiantes_mentor_pdf', compact('mentor', 'estudiantes'));
        return $pdf->download('estudiantes_mentor.pdf');
    }

    public function exportEstudiantesPorCarreraPdf($carreraId)
    {
        $carrera = Carrera::findOrFail($carreraId);
        $estudiantes = Estudiantes::where('carrera_id', $carreraId)->get();

        $pdf = Pdf::loadView('estadistica.estudiantes_carrera_pdf', compact('carrera', 'estudiantes'));
        return $pdf->download('estudiantes_carrera.pdf');
    }

    public function filtroEstudiantes(Request $request)
    {
        $query = Estudiantes::query()->with(['empresa', 'academico', 'asesorin', 'carrera']);

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
}
