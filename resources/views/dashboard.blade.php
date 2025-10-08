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
                                    @php
                                        $hoy = Carbon\Carbon::now();
                                        $fechaLimite = $hoy->copy()->addDays(15);

                                        // Obtener estudiantes con convenio por vencer
                                        $estudiantesPorVencer = App\Models\Estudiantes::with('academico')
                                            ->where('activo', true)
                                            ->whereDate('fin_dual', '<=', $fechaLimite)
                                            ->get();

                                        // Obtener empresas con convenio por vencer
                                        $empresasPorVencer = App\Models\Empresa::with('asesorin')
                                            ->whereDate('fin_conv', '<=', $fechaLimite)
                                            ->get();

                                        $totalPorVencer = $estudiantesPorVencer->count() + $empresasPorVencer->count();
                                    @endphp

                                    <h4 class="text-secondary font-weight-bold mb-3">Documentación por vencer</h4>

                                    @if ($totalPorVencer > 0)
                                        <div class="position-relative mb-3">
                                            <h2 class="text-warning display-4">
                                                <i class="mdi mdi-alert-circle-outline"></i>
                                            </h2>
                                            <span
                                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                                {{ $totalPorVencer }}
                                            </span>
                                        </div>
                                        <p class="text-muted mb-2">
                                            <strong>{{ $totalPorVencer }}</strong> documento(s) por vencer
                                        </p>

                                        <!-- Botón para ver alerta -->
                                        <button type="button" class="btn btn-warning btn-lg btn-block mb-2"
                                            data-bs-toggle="modal" data-bs-target="#alertaVencimientos">
                                            <i class="mdi mdi-alert mdi-24px align-middle"></i> Ver Alertas
                                        </button>
                                    @else
                                        <h2 class="text-success display-4">
                                            <i class="mdi mdi-check-circle-outline"></i>
                                        </h2>
                                        <p class="text-muted mb-2">No hay documentos por vencer</p>
                                    @endif

                                    <a type="button" class="btn btn-success btn-lg btn-block"
                                        href="{{ route('estudiantes.index', ['tab' => 'vencimientos']) }}">
                                        <i class="mdi mdi-file-document-box mdi-24px align-middle"></i>
                                        Gestionar Documentación
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
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Alerta -->
    @if ($totalPorVencer > 0)
        <div class="modal fade" id="alertaVencimientos" tabindex="-1" aria-labelledby="alertaVencimientosLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-warning">
                        <h5 class="modal-title text-white" id="alertaVencimientosLabel">
                            <i class="mdi mdi-alert-circle-outline me-2"></i>
                            Documentación por Vencer
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-info">
                            <i class="mdi mdi-information-outline me-2"></i>
                            Tienes <strong>{{ $totalPorVencer }}</strong> documentos que vencen en los próximos 15 días.
                        </div>

                        @if ($estudiantesPorVencer->count() > 0)
                            <div class="mb-4">
                                <h6 class="text-primary mb-3">
                                    <i class="mdi mdi-account-school me-2"></i>
                                    Estudiantes ({{ $estudiantesPorVencer->count() }})
                                </h6>
                                <div class="table-responsive">
                                    <table class="table table-sm table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Estudiante</th>
                                                <th>Fin Dual</th>
                                                <th>Días Restantes</th>
                                                <th>Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($estudiantesPorVencer as $estudiante)
                                                @php
                                                    $diasRestantes = $hoy->diffInDays(
                                                        Carbon\Carbon::parse($estudiante->fin_dual),
                                                        false,
                                                    );
                                                @endphp
                                                <tr>
                                                    <td>{{ $estudiante->nombre ?? 'N/A' }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($estudiante->fin_dual)->format('d/m/Y') }}
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="badge {{ $diasRestantes < 5 ? 'bg-danger' : 'bg-warning' }}">
                                                            {{ $diasRestantes }} días
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-sm btn-outline-primary">
                                                            <i class="mdi mdi-file-edit"></i> Revisar
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif

                        @if ($empresasPorVencer->count() > 0)
                            <div class="mb-4">
                                <h6 class="text-success mb-3">
                                    <i class="mdi mdi-office-building me-2"></i>
                                    Empresas ({{ $empresasPorVencer->count() }})
                                </h6>
                                <div class="table-responsive">
                                    <table class="table table-sm table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Empresa</th>
                                                <th>Fin Convenio</th>
                                                <th>Días Restantes</th>
                                                <th>Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($empresasPorVencer as $empresa)
                                                @php
                                                    $diasRestantes = $hoy->diffInDays(
                                                        Carbon\Carbon::parse($empresa->fin_conv),
                                                        false,
                                                    );
                                                @endphp
                                                <tr>
                                                    <td>{{ $empresa->nombre ?? 'N/A' }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($empresa->fin_conv)->format('d/m/Y') }}
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="badge {{ $diasRestantes < 5 ? 'bg-danger' : 'bg-warning' }}">
                                                            {{ $diasRestantes }} días
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('empresas.edit', $empresa->id) }}"
                                                            class="btn btn-sm btn-outline-success">
                                                            <i class="mdi mdi-file-edit"></i> Revisar
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="mdi mdi-clock-outline me-2"></i> Revisar más tarde
                        </button>
                        <a href="{{ route('estudiantes.index', ['tab' => 'vencimientos']) }}" class="btn btn-primary">
                            <i class="mdi mdi-file-document-box me-2"></i> Gestionar Todo
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('scripts')
    @if ($totalPorVencer > 0)
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Mostrar modal automáticamente al cargar la página si hay vencimientos
                var alertaModal = new bootstrap.Modal(document.getElementById('alertaVencimientos'));
                alertaModal.show();
            });
        </script>
    @endif
@endsection
