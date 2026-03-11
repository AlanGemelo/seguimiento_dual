@extends('layouts.app')
@section('title', 'Dashboard')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboardrector.css') }}">
@endsection


@section('content')

    <div class="container-fluid py-4">

        <div class="row">

            {{-- CONTENIDO PRINCIPAL --}}

            <div class="col-xl-9 col-lg-8">


                @if (session('status'))
                    <div class="alert alert-success shadow-sm">
                        <strong>Excelente:</strong> {{ session('status') }}
                    </div>
                @endif


                <div class="mb-4">
                    <h3 class="fw-bold">Panel de Control</h3>
                    <p class="text-muted">Sistema de Seguimiento de Educación Dual</p>
                </div>


                {{-- ESTADISTICAS --}}
                <div class="row mb-4">

                    @if (Auth::user()->rol_id === 1 || Auth::user()->rol_id === 4)
                        <div class="col-md-3">
                            <div class="card stat-card shadow-sm border-0">
                                <div class="card-body d-flex align-items-center">

                                    <div class="stat-icon bg-success">
                                        <i class="mdi mdi-account-tie"></i>
                                    </div>

                                    <div class="ms-3">
                                        <h6 class="text-muted mb-1">Mentores</h6>
                                        <h3 class="fw-bold mb-0">{{ $mentores }}</h3>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endif


                    <div class="col-md-3">
                        <div class="card stat-card shadow-sm border-0">
                            <div class="card-body d-flex align-items-center">

                                <div class="stat-icon bg-primary">
                                    <i class="mdi mdi-account-school"></i>
                                </div>

                                <div class="ms-3">
                                    <h6 class="text-muted mb-1">Estudiantes</h6>
                                    <h3 class="fw-bold mb-0">{{ $estudiantes }}</h3>
                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="card stat-card shadow-sm border-0">
                            <div class="card-body d-flex align-items-center">

                                <div class="stat-icon bg-warning">
                                    <i class="mdi mdi-file-document"></i>
                                </div>

                                <div class="ms-3">
                                    <h6 class="text-muted mb-1">Finalizan Dual</h6>
                                    <h3 class="fw-bold mb-0">{{ $registrosEstudiantes->count() }}</h3>
                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="card stat-card shadow-sm border-0">
                            <div class="card-body d-flex align-items-center">

                                <div class="stat-icon bg-danger">
                                    <i class="mdi mdi-file-alert"></i>
                                </div>

                                <div class="ms-3">
                                    <h6 class="text-muted mb-1">Convenios por vencer</h6>
                                    <h3 class="fw-bold mb-0">{{ $registrosConvenio->count() }}</h3>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>



                {{-- ACCIONES RAPIDAS --}}
                <div class="row mb-4">

                    @if (Auth::user()->rol_id === 1 || Auth::user()->rol_id === 4)
                        <div class="col-md-4">

                            <div class="card action-card shadow-sm border-0 h-100">
                                <div class="card-body">

                                    <h5 class="fw-bold mb-3">
                                        <i class="mdi mdi-account-plus text-success"></i>
                                        Crear Mentor Industrial
                                    </h5>

                                    <p class="text-muted small">
                                        Registrar nuevos mentores industriales que participarán en el modelo dual.
                                    </p>

                                    <a href="{{ route('mentores.create') }}" class="btn btn-success btn-sm">
                                        Registrar Mentor
                                    </a>

                                </div>
                            </div>

                        </div>
                    @endif


                    <div class="col-md-4">

                        <div class="card action-card shadow-sm border-0 h-100">
                            <div class="card-body">

                                <h5 class="fw-bold mb-3">
                                    <i class="mdi mdi-account-plus text-primary"></i>
                                    Registrar Estudiante
                                </h5>

                                <p class="text-muted small">
                                    Agregar nuevos estudiantes al sistema de educación dual.
                                </p>

                                <a href="{{ route('estudiantes.create') }}" class="btn btn-primary btn-sm">
                                    Registrar Estudiante
                                </a>

                            </div>
                        </div>

                    </div>


                    <div class="col-md-4">

                        <div class="card action-card shadow-sm border-0 h-100">
                            <div class="card-body">

                                <h5 class="fw-bold mb-3">
                                    <i class="mdi mdi-file-document text-warning"></i>
                                    Documentación por vencer
                                </h5>

                                <p class="text-muted small">
                                    Revisa estudiantes o convenios que están próximos a vencer.
                                </p>

                                <a href="{{ route('documentacion.index') }}" class="btn btn-warning btn-sm">
                                    Revisar documentación
                                </a>

                            </div>
                        </div>

                    </div>

                </div>



                @if (Auth::user()->rol_id === 1 || Auth::user()->rol_id === 4)
                    <div class="card shadow-sm border-0">

                        <div class="card-body">

                            <h5 class="fw-bold mb-3">
                                <i class="mdi mdi-file-excel text-success"></i>
                                Reporte General
                            </h5>

                            <p class="text-muted small">
                                Descarga el reporte general del modelo dual.
                            </p>

                            <a href="{{ route('reporte.general') }}" class="btn btn-success btn-sm">
                                Descargar Excel
                            </a>

                        </div>

                    </div>
                @endif

            </div>

            {{-- PANEL DERECHO --}}
            <div class="col-xl-3 col-lg-4">

                <div class="right-sidebar">

                    @if ($usaPasswordPorDefecto)
                        <div class="card sidebar-widget shadow-sm mb-3">
                            <div class="card-body">
                                <h6 class="fw-bold">
                                    <i class="mdi mdi-shield-lock-outline text-warning"></i>
                                    Seguridad
                                </h6>

                                <p class="small text-muted">
                                    Estás usando la contraseña por defecto, cámbiala por seguridad.
                                </p>

                                <a href="{{ route('profile.index') }}" class="btn btn-warning btn-sm w-100">
                                    Cambiar contraseña
                                </a>
                            </div>
                        </div>
                    @endif


                    {{-- <div class="card sidebar-widget shadow-sm mb-3">
                        <div class="card-body">

                            <h6 class="fw-bold">
                                <i class="mdi mdi-lightbulb-outline text-success"></i>
                                Motivación
                            </h6>

                            <blockquote class="small mb-0">
                                “La educación es el arma más poderosa para cambiar el mundo.”
                            </blockquote>

                        </div>
                    </div> --}}


                    {{-- <div class="card sidebar-widget shadow-sm mb-3">
                        <div class="card-body">

                            <h6 class="fw-bold">
                                <i class="mdi mdi-calendar-star text-primary"></i>
                                Efeméride
                            </h6>

                            <p class="small">
                                5 de Marzo — Día de la eficiencia energética.
                            </p>

                        </div>
                    </div> --}}


                    {{-- <div class="card sidebar-widget shadow-sm">

                        <div class="card-body">

                            <h6 class="fw-bold">
                                <i class="mdi mdi-bell-outline text-danger"></i>
                                Recordatorios
                            </h6>

                            <ul class="small ps-3 mb-0">

                                <li>{{ $registrosConvenio->count() }} convenios por vencer</li>

                                <li>{{ $registrosEstudiantes->count() }} estudiantes finalizan dual</li>

                                <li>Actualizar mentores industriales</li>

                            </ul>

                        </div>

                    </div> --}}


                </div>

            </div>


        </div>
    </div>

@endsection

@section('modals')
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
