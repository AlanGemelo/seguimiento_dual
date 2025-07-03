@php use Illuminate\Support\Facades\Storage; @endphp
@extends('layouts.app')

@section('title', 'Mostrar Mentor Académico')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/listas.css') }}">

    <body class="body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow">
                        <!-- Encabezado -->
                       <x-forms.section-header title="Datos del Mentor Académcio"
                            description="Visualización de la información personal del Mentor Académico y de los
                            alumnos asignados." />

                        <div class="card-body">
                            <!-- Información General -->
                            <div class="mb-4">
                                <h5 class="section-title">Identificación del Mentor Académico</h5>
                                <div class="dropdown-divider mb-4"></div>
                                <div class="row">

                                    <div class="col-md-4 mb-3">
                                        <label for="email" class="form-label">Correo electrónico institucional</label>
                                        <input type="email" class="form-control" value="{{ $mentor->email ?? 'N/A' }}"
                                            disabled>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="name" class="form-label">Nombre(s)</label>
                                            <input type="text" class="form-control" value="{{ $mentor->name }}" disabled>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="apellidoP" class="form-label">Apellido Paterno</label>
                                            <input type="text" class="form-control" value="{{ $mentor->apellidoP }}"
                                                disabled>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="apellidoM" class="form-label">Apellido Materno</label>
                                            <input type="text" class="form-control" value="{{ $mentor->apellidoM }}"
                                                disabled>
                                        </div>
                                    </div>

                                    <h5 class="section-title mt-4">Información Académica</h5>
                                    <div class="dropdown-divider mb-4"></div>
                                    <div class="col-md-6 mb-3">
                                        <label for="cuatrimestre" class="form-label">Grado Académico</label>
                                        <input type="text" class="form-control" value="{{ $mentor->titulo }}" disabled>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="cuatrimestre" class="form-label">Dirección de carrera</label>
                                        <input type="text" class="form-control"
                                            value="{{ $mentor->direccion->name ?? 'N/A' }}" disabled>
                                    </div>
                                </div>
                            </div>

                            <!-- Documentos -->
                            <div class="mb-4">
                                <h5 class="section-title mt-4">Información laboral</h5>
                                <div class="dropdown-divider mb-4"></div>
                                <h4 class="card-title mb-4">Estudiantes Asignados</h4>
                                <div class="row">
                                    @foreach ($mentor->estudiantes as $estudiante)
                                        <div class="col-md-4 mb-4">
                                            <div class="card h-100">
                                                <div class="card-body d-flex flex-column">
                                                    <h5 class="card-title">{{ $estudiante->name }}
                                                        {{ $estudiante->apellidoP }}
                                                    </h5>
                                                    <p class="card-text">
                                                        <strong>Matrícula:</strong> {{ $estudiante->matricula }}<br>
                                                        <strong>Carrera:</strong>
                                                        {{ $estudiante->carrera->nombre ?? 'N/A' }}<br>
                                                        <strong>Empresa:</strong>
                                                        {{ $estudiante->empresa->nombre ?? 'N/A' }}
                                                    </p>
                                                    <div class="mt-auto">
                                                        <a href="{{ route('estudiantes.show', Vinkla\Hashids\Facades\Hashids::encode($estudiante->matricula)) }}"
                                                            class="btn btn-primary btn-block">Ver detalles</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            </div>

                            <!-- Botón de regreso -->
                            <div class="d-flex justify-content-end mt-4">
                                <x-buttons.back-button url="{{ route('academicos.index') }}" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection
</body>
