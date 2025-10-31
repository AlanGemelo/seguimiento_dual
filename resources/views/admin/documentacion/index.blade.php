@extends('layouts.app')

@section('title', 'Documentación por Vencer')

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">

                {{-- Header al estilo de Lista de Estudiantes --}}
                <div class="card-header-adjusted">
                    <h6 class="card-title">Documentación por Vencer</h6>
                </div>

                <div class="card-body">
                    {{-- Mensajes de éxito --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                            <i class="mdi mdi-check-circle-outline me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    {{-- SECCIÓN: ESTUDIANTES --}}
                    <div class="card card-rounded mb-5 shadow-lg border-0">
                        <div class="card-body">
                            <h4 class="mb-3 text-secondary fw-bold">
                                <i class="mdi mdi-school me-2"></i> Estudiantes próximos a finalizar dual
                            </h4>
                            @if ($estudiantes->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle">
                                        <thead class="table-success">
                                            <tr>
                                                <th>#</th>
                                                <th>Nombre</th>
                                                <th>Fin Dual</th>
                                                <th>Asesor Industrial</th>
                                                <th>Asesor Académico</th>
                                                <th class="text-center">Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($estudiantes as $index => $estudiante)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $estudiante->name . ' ' . $estudiante->apellidoP . ' ' . $estudiante->apellidoM ?: '—' }}
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="badge @if (\Carbon\Carbon::parse($estudiante->fin_dual)->isPast()) bg-danger @else bg-warning text-dark @endif">
                                                            {{ \Carbon\Carbon::parse($estudiante->fin_dual)->format('d/m/Y') }}
                                                        </span>
                                                    </td>
                                                    <td>{{ ($estudiante->asesorin->name ?? '') . ' ' . ($estudiante->asesorin->apellidoP ?? '') . ' ' . ($estudiante->asesorin->apellidoM ?? '') ?: '—' }}
                                                    </td>
                                                    <td>{{ ($estudiante->academico->name ?? '') . ' ' . ($estudiante->academico->apellidoP ?? '') . ' ' . ($estudiante->academico->apellidoM ?? '') ?: '—' }}
                                                    </td>
                                                    <td class="text-center">
                                                        <form
                                                            action="{{ route('documentacion.renovar.estudiante', $estudiante->matricula) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" class="btn btn-outline-success btn-sm">
                                                                <i class="mdi mdi-autorenew me-1"></i> Renovar
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="text-muted">No hay estudiantes con documentación próxima a vencer.</p>
                            @endif
                        </div>
                    </div>

                    {{-- SECCIÓN: CONVENIOS --}}
                    <div class="card card-rounded shadow-lg border-0">
                        <div class="card-body">
                            <h4 class="mb-3 text-secondary fw-bold">
                                <i class="mdi mdi-domain me-2"></i> Convenios próximos a vencer
                            </h4>
                            @if ($convenios->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle">
                                        <thead class="table-success">
                                            <tr>
                                                <th>#</th>
                                                <th>Empresa</th>
                                                <th>Fin Convenio</th>
                                                <th>Asesor Industrial</th>
                                                <th class="text-center">Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($convenios as $index => $c)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $c->nombre ?? '—' }}</td>
                                                    <td>
                                                        <span
                                                            class="badge @if (\Carbon\Carbon::parse($c->fin_conv)->isPast()) bg-danger @else bg-warning text-dark @endif">
                                                            {{ \Carbon\Carbon::parse($c->fin_conv)->format('d/m/Y') }}
                                                        </span>
                                                    </td>
                                                    <td>{{ ($c->asesorin->name ?? '') . ' ' . ($c->asesorin->apellidoP ?? '') . ' ' . ($c->asesorin->apellidoM ?? '') ?: '—' }}
                                                    </td>
                                                    <td class="text-center">
                                                        <form
                                                            action="{{ route('documentacion.renovar.convenio', $c->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" class="btn btn-outline-success btn-sm">
                                                                <i class="mdi mdi-autorenew me-1"></i> Renovar
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="text-muted">No hay convenios próximos a vencer.</p>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
