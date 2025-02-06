<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use App\Models\Estudiantes;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EstadisticaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // Consultas para la grafica de becas
        $estudiantesS = Estudiantes::where('beca', 1)->get()->count();
        $estudiantesC = Estudiantes::where('beca', 0)->get()->count();
        // Consultas Grafica de Estudiantes

$activos = Estudiantes::where('activo',1)->get()->count();
$inactivos = Estudiantes::where('activo',0)->get()->count();
$egresados = Estudiantes::withTrashed()->where('status',3)->get()->count();
$baja = Estudiantes::onlyTrashed()->where('status', '!=', 3)->count();

// Consulta para la grafica de carreras
        $labelsCarrera = Carrera::where('direccion_id', session('direccion')->id)->get('nombre')->pluck('nombre');
        $carreras = Carrera::where('direccion_id', session('direccion')->id)
            ->withCount('estudiantes')
            ->pluck('estudiantes_count');

        $labelsTutor = Carrera::where('direccion_id', session('direccion')->id)->get('nombre')->pluck('nombre');


                $fecha = Carbon::now()->startOfDay();
        $fechaUnMesAntes = $fecha->copy()->subMonth(1)->startOfDay(); // Obtener la fecha actual más un mes
        $estudiantes = Estudiantes::whereBetween('fin_dual', [$fechaUnMesAntes,$fecha])->get();
// return response()->json([$fecha,$fechaUnMesAntes,$estudiantes ]);

        $chart = new Chart();
        $chart->labels(['Iniciando', 'En proceso', 'Finalizado', 'Desertado', 'Cancelado'])
              ->dataset('Sample', 'bar', [65, 59, 80, 81, 56, 55, 40]);



// Creación de las gráficas
$chart1 = new Chart();
$carreraGraphic = new Chart();
$becaGraphic = new Chart();

// Labels Gráficas
$chart1->labels(['Activos', 'Candidatos', 'Egresados', 'Bajas'])
    ->dataset('Estudiantes', 'pie', [$activos, $inactivos, $egresados, $baja])
    ->backgroundColor(['#1E88E5', '#D32F2F', '#7CB342', '#FBC02D'])
    ->color('#FFFFFF'); // Establece el color del texto en blanco

$becaGraphic->labels(['Becados', 'Sin beca'])
    ->dataset('Estudiantes', 'pie', [$estudiantesC, $estudiantesS])
    ->backgroundColor(['#1E88E5', '#D32F2F'])
    ->color('#FFFFFF'); // Establece el color del texto en blanco

$carreraGraphic->labels($labelsCarrera)
    ->dataset('Estudiantes por Carrera', 'pie', $carreras)
    ->backgroundColor(['#1E88E5', '#D32F2F', '#7CB342', '#FBC02D', '#8E24AA', '#F4511E', '#3949AB'])
    ->color('#FFFFFF'); // Establece el color del texto en blanco

// Opciones del gráfico
$chart1->options([
    'responsive' => true,
    'legend' => [
        'position' => 'top',
        'labels' => [
            'fontColor' => '#FFFFFF',
            'fontSize' => 14,
        ],
    ],
    'scales' => [
        'yAxes' => [
            [
                'ticks' => [
                    'beginAtZero' => true,
                    'fontColor' => '#FFFFFF',
                ],
            ],
        ],
        'xAxes' => [
            [
                'ticks' => [
                    'fontColor' => '#FFFFFF',
                ],
            ],
        ],
    ],
]);

$becaGraphic->options([
    'responsive' => true,
    'legend' => [
        'position' => 'top',
        'labels' => [
            'fontColor' => '#FFFFFF',
            'fontSize' => 14,
        ],
    ],
]);

        return view('Estadistica.index', compact(['chart','chart1','becaGraphic','carreraGraphic']));
    }


}
