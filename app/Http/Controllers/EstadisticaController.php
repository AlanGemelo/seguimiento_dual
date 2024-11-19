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
        


// CReacion de la grafica
$chart1 = new Chart();
$carreraGraphic = new Chart();
$tutorGraphic = new Chart();
$becaGraphic = new Chart();

// Labels Graficas
$chart1->labels(['activos','Candidatos','Egresados','Bajas'])
->dataset('Estudiantes', 'pie', [$activos,$inactivos,$egresados,$baja])
->backgroundColor(['#FF5733', '#33FF57', '#3357FF', '#FF3357'])
->color('#000'); // Establece el color del texto en blanco

$becaGraphic->labels(['Becados','Sin beca'])
->dataset('Estudiantes', 'pie', [$estudiantesC,$estudiantesS])
->backgroundColor(['#FF5733', '#33FF57', '#3357FF', '#57FF33', '#FF3357', '#5733FF', '#33FFC9'])
->color('#000'); // Establece el color del texto en blanco
$carreraGraphic->labels($labelsCarrera)->dataset('Estudiantes por Carrera', 'pie', $carreras)
->backgroundColor(['#FF5733', '#33FF57', '#3357FF', '#57FF33', '#FF3357', '#5733FF', '#33FFC9'])
->color('#000'); // Establece el color del texto en blanco
$tutorGraphic->labels($labelsCarrera)->dataset('Estudiantes por Carrera', 'pie', $carreras)
->backgroundColor(['#FF5733', '#33FF57', '#3357FF', '#57FF33', '#FF3357', '#5733FF', '#33FFC9'])
->color('#000'); // Establece el color del texto en blanco


// Options el gráfico


$chart1->options([
    'scales' => [
        'yAxes' => [
            [
                'ticks' => [
                    'beginAtZero' => true,
                ],
            ],
        ],
    ],
]);


// Renderizar el gráfico
$becaGraphic->options([
    'scales' => [
        'yAxes' => [
            [
                'ticks' => [
                    'beginAtZero' => true,
                ],
            ],
        ],
    ],
]);

        return view('Estadistica.index', compact(['chart','chart1','becaGraphic','carreraGraphic']));
    }

    /**
     * Show the form for creating a new resource.
     
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
