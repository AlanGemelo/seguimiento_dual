@extends('layouts.app')
@section('title', 'Ver Programa Educativo')

@section('content')

    <body class="body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow">
                    <!-- Encabezado -->
                    <x-forms.section-header title="Datos del Programa Educativo"
                        description="Visualización de la información personal del Mentor Académico y de los
                            alumnos asignados." />

                    <div class="card-body">
                        <!-- Información General -->
                        <div class="mb-4">
                            <h5 class="section-title">Información Académica</h5>
                            <div class="dropdown-divider mb-4"></div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="email" class="form-label"> Grado Académico</label>
                                    <input type="email" class="form-control"
                                        value="{{ $carrera->grado_academico ?? 'N/A' }}" disabled>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="cuatrimestre" class="form-label">Nombre del programa
                                            academico</label>
                                        <input type="text" class="form-control" value="{{ $carrera->nombre }}" disabled>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="cuatrimestre" class="form-label">Dirección de carrera</label>
                                        <input type="text" class="form-control"
                                            value="{{ $carrera->direccion->name ?? 'N/A' }}" disabled>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="cuatrimestre" class="form-label">Nombre director de carrera</label>
                                        <input type="text" class="form-control"
                                            value="{{ $carrera->direccion->director->nombre }} {{ $carrera->direccion->director->apellidoP }} {{ $carrera->direccion->director->apellidoM }}"
                                            disabled>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Botón de regreso -->
                        <div class="d-flex justify-content-end mt-4">
                            <x-buttons.back-button url="{{ route('carreras.index') }}" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</body>
