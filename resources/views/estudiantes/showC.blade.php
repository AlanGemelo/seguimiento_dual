@php use Illuminate\Support\Facades\Storage; @endphp
@extends('layouts.app')

@section('title', 'Mostrar Estudiante')

@section('content')
<link rel="stylesheet" href="{{ asset('css/listas.css') }}">
    <body class="body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow">
                    <!-- Encabezado -->
                    <x-section-header title="Datos del Candidato a la Modalidad Dual"
                        description="Visualización de información personal y documentos del alumno
                            postulante" />

                    <div class="card-body">
                        <!-- Información General -->
                        <div class="mb-4">
                            <h5 class="section-title">Identificación del Estudiante</h5>
                            <div class="dropdown-divider mb-4"></div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="matricula" class="form-label">Matrícula</label>
                                    <input type="text" class="form-control" value="{{ $estudiante->matricula }}"
                                        disabled>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="email" class="form-label">Correo electrónico institucional</label>
                                    <input type="email" class="form-control"
                                        value="{{ $estudiante->user->email ?? 'al' . $estudiante->matricula . '@utvtol.edu.mx' }}"
                                        disabled>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="name" class="form-label">Nombre(s)</label>
                                        <input type="text" class="form-control" value="{{ $estudiante->name }}" disabled>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="apellidoP" class="form-label">Apellido Paterno</label>
                                        <input type="text" class="form-control" value="{{ $estudiante->apellidoP }}"
                                            disabled>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="apellidoM" class="form-label">Apellido Materno</label>
                                        <input type="text" class="form-control" value="{{ $estudiante->apellidoM }}"
                                            disabled>
                                    </div>
                                </div>
                                <h5 class="section-title mt-4">Información Personal</h5>
                                <div class="dropdown-divider mb-4"></div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Fecha de Nacimiento</label>
                                    <input type="text" class="form-control"
                                        value="{{ \Carbon\Carbon::parse($estudiante->fecha_na)->locale('es')->isoFormat('D [de] MMMM [de] YYYY') }}"
                                        disabled>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="curp" class="form-label">CURP</label>
                                    <input type="text" class="form-control" value="{{ $estudiante->curp }}" disabled>
                                </div>

                                <h5 class="section-title mt-4">Información Académica</h5>
                                <div class="dropdown-divider mb-4"></div>
                                <div class="col-md-6 mb-3">
                                    <label for="cuatrimestre" class="form-label">Dirección de carrera</label>
                                    <input type="text" class="form-control"
                                        value="{{ $estudiante->direccion->name ?? 'N/A' }}" disabled>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="cuatrimestre" class="form-label">Cuatrimestre</label>
                                    <input type="text" class="form-control" value="{{ $estudiante->cuatrimestre }}"
                                        disabled>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="cuatrimestre" class="form-label">Fecha de ingreso</label>
                                    <input type="text" class="form-control"
                                        value="{{ \Carbon\Carbon::parse($estudiante->inicio)->locale('es')->isoFormat('D [de] MMMM [de] YYYY') }}"
                                        disabled>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="cuatrimestre" class="form-label">Fecha de egreso</label>
                                    <input type="text" class="form-control"
                                        value="{{ \Carbon\Carbon::parse($estudiante->fin)->locale('es')->isoFormat('D [de] MMMM [de] YYYY') }}"
                                        disabled>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="cuatrimestre" class="form-label">Situación en modalidad dual</label>
                                    <input type="text" class="form-control"
                                        value="{{ $estudiante->status == 1 ? 'Renovación' : 'Primera vez' }}" disabled>
                                </div>

                            </div>
                        </div>

                        <!-- Documentos -->
                        <div class="mb-4">
                            <h5 class="section-title mt-4">Documentos del Estudiante</h5>
                            <div class="dropdown-divider mb-4"></div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nombre Documento</th>
                                                <th>Ver</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>
                                                    <h5 class="card-title">INE</h5>
                                                </td>
                                                <td>
                                                    <a href="{{ url(Storage::url($estudiante->ine)) }}"
                                                        class="btn btn-primary" target="_blank">Ver
                                                        Documento
                                                        <span class="mdi mdi-file-pdf-box"></span>
                                                    </a>
                                                </td>
                                            </tr>


                                            <td>2</td>
                                            <td>
                                                <h5 class="card-title">Historial Academico</h5>
                                            </td>
                                            <td>
                                                <a href="{{ url(Storage::url($estudiante->historial_academico)) }}"
                                                    class="btn btn-primary" target="_blank">Ver
                                                    Documento
                                                    <span class="mdi mdi-file-pdf-box"></span>
                                                </a>
                                            </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Botón de regreso -->
                        <div class="d-flex justify-content-end mt-4">
                            <x-back-button url="{{ route('estudiantes.index') }}" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
</body>