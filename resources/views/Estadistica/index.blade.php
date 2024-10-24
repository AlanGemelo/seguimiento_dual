@extends('layouts.app')
@section('title', 'Estadisticas')
@section('content')

<div class="row">
    <div class="col-12 grid-margin">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary rounded pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Estadisticas</h6>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            {{-- <div class="container">
                                <!-- Aquí se mostrará el gráfico -->
                                {!! $chart->container() !!}
                            </div> --}}
                            <h1 style="text-align: center">Estatus de Estudiantes </h1>
                            <hr>
                            <div class="chart-container">
                                
                                <!-- Aquí se mostrará el gráfico -->
                                {!! $chart1->container() !!}
                            </div>
                            <h1 style="text-align: center">Becados</h1>
                            <hr>
                            <div class="chart-container">
                                <!-- Aquí se mostrará el gráfico -->
                                {!! $becaGraphic->container() !!}
                            </div>
                            <h1 style="text-align: center">Estudiantes Por Carrera</h1>
                            <hr>
                            <div class="chart-container">
                                <!-- Aquí se mostrará el gráfico -->
                                {!! $carreraGraphic->container() !!}
                            </div>
                            {{-- <h1 style="text-align: center">Estudiantes Por Tutor Academico</h1>
                            <hr>
                            <div class="chart-container">
                                <!-- Aquí se mostrará el gráfico -->
                                {!! $carreraGraphic->container() !!}
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Importa los scripts necesarios para el gráfico -->
{!! $chart->script() !!}
{!! $chart1->script() !!}
{!! $becaGraphic->script() !!}
{!! $carreraGraphic->script() !!}
<script>
    // Crear un gráfico simple con D3.js
    var data = [10, 20, 30, 40, 50];
    var width = 500, height = 300;

    var svg = d3.select("#chart").append("svg")
        .attr("width", width)
        .attr("height", height);

    svg.selectAll("circle")
        .data(data)
        .enter().append("circle")
        .attr("cx", function(d, i) { return (i+1) * 80; })
        .attr("cy", height / 2)
        .attr("r", function(d) { return d; })
        .style("fill", "purple");
</script>

@endsection
