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
        // Consultas para la gráfica de becas
        $estudiantesS = Estudiantes::where('beca', 1)->count();
        $estudiantesC = Estudiantes::where('beca', 0)->count();

        // Consultas gráfica de estudiantes
        $activos = Estudiantes::where('activo', 1)->count();
        $inactivos = Estudiantes::where('activo', 0)->count();
        $egresados = Estudiantes::withTrashed()->where('status', 3)->count();
        $baja = Estudiantes::onlyTrashed()->where('status', '!=', 3)->count();

        // Consulta para la gráfica de carreras
        $labelsCarrera = Carrera::where('direccion_id', session('direccion')->id)->pluck('nombre');
        $carreras = Carrera::where('direccion_id', session('direccion')->id)
            ->withCount('estudiantes')
            ->pluck('estudiantes_count');

        // Creación de las gráficas
        $chart1 = (new LarapexChart)->pieChart()
            ->setTitle('Estatus de Estudiantes')
            ->setDataset([$activos, $inactivos, $egresados, $baja])
            ->setLabels(['Activos', 'Candidatos', 'Egresados', 'Bajas'])
            ->setColors(['#1E88E5', '#D32F2F', '#7CB342', '#FBC02D']);

        $becaGraphic = (new LarapexChart)->pieChart()
            ->setTitle('Becados')
            ->setDataset([$estudiantesC, $estudiantesS])
            ->setLabels(['Sin beca', 'Becados'])
            ->setColors(['#1E88E5', '#D32F2F']);

        $carreraGraphic = (new LarapexChart)->donutChart()
            ->setTitle('Estudiantes por Carrera')
            ->setDataset($carreras->toArray())
            ->setLabels($labelsCarrera->toArray())
            ->setColors(['#1E88E5', '#D32F2F', '#7CB342', '#FBC02D', '#8E24AA', '#F4511E', '#3949AB'])
            ->setDataLabels(true);

        $mentores = User::mentoresAcademicos()->get();
        $empresas = Empresa::all();
        $carreras = Carrera::where('direccion_id', session('direccion')->id)->get();

        return view('Estadistica.index', compact(['chart1', 'becaGraphic', 'carreraGraphic', 'mentores', 'empresas', 'carreras']));
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
        $estudiantes = Estudiantes::where('status', $status)->get();
        return Excel::download(new EstadisticasExport($estudiantes), 'estudiantes_status.xlsx');
    }

    public function exportEstudiantesPorBecaExcel($beca)
    {
        $becaValue = $beca === 'becados' ? 1 : 0;
        $estudiantes = Estudiantes::where('beca', $becaValue)->get();
        return Excel::download(new EstadisticasExport($estudiantes), 'estudiantes_beca.xlsx');
    }

    public function exportEstudiantesPorEmpresaExcel($empresaId)
    {
        $estudiantes = Estudiantes::where('empresa_id', $empresaId)->get();
        return Excel::download(new EstadisticasExport($estudiantes), 'estudiantes_empresa.xlsx');
    }

    public function exportEstudiantesPorMentorExcel($mentorId)
    {
        $estudiantes = Estudiantes::where('academico_id', $mentorId)->get();
        return Excel::download(new EstadisticasExport($estudiantes), 'estudiantes_mentor.xlsx');
    }

    public function exportEstudiantesPorCarreraExcel($carreraId)
    {
        $estudiantes = Estudiantes::where('carrera_id', $carreraId)->get();
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
}
