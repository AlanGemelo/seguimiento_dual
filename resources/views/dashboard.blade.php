@extends('layouts.app')
@section('title', 'Dashboard')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboardrector.css') }}">
@endsection
@section('content')
    <div class="row">
        <div class="col-12 grid-margin">
            @if (session('status'))
                <div class="alert alert-success alert-dismissible text-dark" role="alert">
                    <span class="text-sm"> <a href="javascript:" class="alert-link text-dark">Excelente</a>.
                        {{ session('status') }}.</span>
                    <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="row flex-grow justify-content-center">
                @if (Auth::user()->rol_id === 1 || Auth::user()->rol_id === 4)
                    <div class="col-lg-4 d-flex flex-column">
                        <div class="row flex-grow">
                            <div class="col-12 grid-margin stretch-card">
                                <div class="card card-rounded shadow-lg border-0">
                                    <div class="card-body text-center">
                                        <h4 class="text-secondary font-weight-bold mb-3">Mentores Industriales
                                            Registrados</h4>
                                        <h2 class="text-primary display-4">{{ $mentores }}</h2>
                                        <br>
                                        <a type="button" class="btn btn-success btn-lg btn-block"
                                            href="{{ route('mentores.create') }}">
                                            <i class="mdi mdi-account-plus mdi-24px align-middle"></i> Crear Mentor
                                            Industriales
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="col-lg-4 d-flex flex-column">
                    <div class="row flex-grow justify-content-center">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded shadow-lg border-0">
                                <div class="card-body text-center">
                                    <h4 class="text-secondary font-weight-bold mb-3">Estudiantes Registrados</h4>
                                    <h2 class="text-primary display-4">{{ $estudiantes }}</h2>
                                    <br>
                                    <a type="button" class="btn btn-success btn-lg btn-block"
                                        href="{{ route('estudiantes.create') }}">
                                        <i class="mdi mdi-account-plus mdi-24px align-middle"></i> Crear Estudiante
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 d-flex flex-column">
                    <div class="row flex-grow justify-content-center">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded shadow-lg border-0">
                                <div class="card-body text-center">

                                    <h4 class="text-secondary font-weight-bold mb-3">
                                        Documentación por vencer
                                    </h4>

                                    <i class="mdi mdi-file-document-box mdi-48px text-warning mb-2"></i>

                                    <p class="mb-2">
                                        <strong>{{ $registrosEstudiantes->count() }}</strong> estudiantes por finalizar
                                        dual.
                                    </p>

                                    <p class="mb-3">
                                        <strong>{{ $registrosConvenio->count() }}</strong> convenios próximos a vencer.
                                    </p>

                                    <a href="{{ route('documentacion.index') }}" class="btn btn-success btn-lg btn-block">
                                        <i class="mdi mdi-file-document-box-outline mdi-24px align-middle"></i> Ver
                                        Documentación por Vencer
                                    </a>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-4 d-flex flex-column">
                    <div class="row flex-grow justify-content-center">
                        @if (Auth::user()->rol_id === 1 || Auth::user()->rol_id === 4)
                            <div class="col-12 grid-margin stretch-card">
                                <div class="card card-rounded shadow-lg border-0">
                                    <div class="card-body text-center">
                                        <h4 class="text-secondary font-weight-bold mb-3">Reporte General</h4>
                                        <p class="text-muted">
                                            Este es el reporte general de los alumnos del modelo de formación dual, que
                                            incluye información relevante sobre su trayectoria académica, mentores,
                                            proyectos y unidades economicas asignadas.
                                        </p>
                                        <br>
                                        <a type="button" class="btn btn-success btn-lg btn-block"
                                            href="{{ route('reporte.general') }}">
                                            <i class="mdi mdi-file-excel mdi-24px align-middle"></i>
                                            Descargar Reporte General (Excel)
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Alerta -->
    <div class="modal fade" id="alertaVencimientosModal" tabindex="-1" aria-labelledby="alertaVencimientosLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="alertaVencimientosLabel">Alerta: Documentación por vencer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    @if ($registrosEstudiantes->count() > 0)
                        <p><strong>{{ $registrosEstudiantes->count() }}</strong> estudiantes están próximos a finalizar su
                            dual.</p>
                    @endif

                    @if ($registrosConvenio->count() > 0)
                        <p><strong>{{ $registrosConvenio->count() }}</strong> convenios están próximos a vencer.</p>
                    @endif

                    <p>Por favor, revisa la documentación para evitar inconvenientes.</p>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('documentacion.index') }}" class="btn btn-primary">Ver detalles</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    @if ($hayAlertas)
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var alertaModal = new bootstrap.Modal(document.getElementById('alertaVencimientosModal'));
                alertaModal.show();
            });
        </script>
    @endif

@endsection
