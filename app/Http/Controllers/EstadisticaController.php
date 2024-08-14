<?php

namespace App\Http\Controllers;


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
        $fecha = Carbon::now()->startOfDay();
        $fechaUnMesAntes = $fecha->copy()->subMonth(1)->startOfDay(); // Obtener la fecha actual más un mes
        $estudiantes = Estudiantes::whereBetween('fin_dual', [$fechaUnMesAntes,$fecha])->get();
// return response()->json([$fecha,$fechaUnMesAntes,$estudiantes ]);

        $chart = new Chart();
        $chart->labels(['Iniciando', 'En proceso', 'Finalizado', 'Desertado', 'Cancelado'])
              ->dataset('Sample', 'bar', [65, 59, 80, 81, 56, 55, 40]);
        

// Configurar opciones adicionales del gráfico

$activos = Estudiantes::where('activo',1)->get()->count();
$inactivos = Estudiantes::where('activo',0)->get()->count();
$baja = Estudiantes::onlyTrashed()->count();
$chart1 = new Chart();
$chart1->labels(['activos','inactivos','Eliminados'])
->dataset('Estudiantes', 'pie', [$activos,$inactivos,$baja])
->backgroundColor(['#FF5733', '#33FF57', '#3357FF', '#57FF33', '#FF3357', '#5733FF', '#33FFC9'])
->color('#000'); // Establece el color del texto en blanco
// Renderizar el gráfico
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

        // return $estudiantes;
        // return response()->json([
        //     'fecha' => $fecha,
        //     'fechaUnMesAntes' => $fechaUnMesAntes,
        // ]);
        $estudiantesS = Estudiantes::where('beca', 1)->get()->count();
        $estudiantesC = Estudiantes::where('beca', 0)->get()->count();
        $becaGraphic = new Chart();
$becaGraphic->labels(['Becados','Sin beca'])
->dataset('Estudiantes', 'pie', [$estudiantesC,$estudiantesS])
->backgroundColor(['#FF5733', '#33FF57', '#3357FF', '#57FF33', '#FF3357', '#5733FF', '#33FFC9'])
->color('#000'); // Establece el color del texto en blanco
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

        return view('Estadistica.index', compact(['chart','chart1','becaGraphic']));
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
