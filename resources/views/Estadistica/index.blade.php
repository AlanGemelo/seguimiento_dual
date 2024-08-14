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
                            <h1 style="text-align: center">Estatus de Estudiantes</h1>
                            <hr>
                            <div class="container">
                                <!-- Aquí se mostrará el gráfico -->
                                {!! $chart1->container() !!}
                            </div>
                            <h1 style="text-align: center">Becados</h1>
                            <hr>
                            <div class="container">
                                <!-- Aquí se mostrará el gráfico -->
                                {!! $becaGraphic->container() !!}
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

@endsection
