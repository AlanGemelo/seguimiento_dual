@extends('layouts.app')
@section('title', 'Estadísticas')
@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg">
                <div class="card-header bg-dark text-white">
                    <h4 class="text-center">Estadísticas Generales</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="text-center">Estatus de Estudiantes</h5>
                                </div>
                                <div class="card-body">
                                    <div class="chart-container" style="position: relative; height:40vh; width:100%;">
                                        {!! $chart1->container() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-danger text-white">
                                    <h5 class="text-center">Becados</h5>
                                </div>
                                <div class="card-body">
                                    <div class="chart-container" style="position: relative; height:40vh; width:100%;">
                                        {!! $becaGraphic->container() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-success text-white">
                                    <h5 class="text-center">Estudiantes Por Carrera</h5>
                                </div>
                                <div class="card-body">
                                    <div class="chart-container" style="position: relative; height:40vh; width:100%;">
                                        {!! $carreraGraphic->container() !!}
                                    </div>
                                </div>
                            </div>
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
@endsection
