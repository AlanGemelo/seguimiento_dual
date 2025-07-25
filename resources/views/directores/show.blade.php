@extends('layouts.app')
@section('title', 'Director de Carrera')

@section('content')
<body class="body">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <!-- Encabezado -->
                <x-forms.section-header title="Datos del Director de Carrera"
                    description="Visualización de la información personal del Director de Carrera." />

                <div class="card-body">
                    <!-- Información General -->
                    <div class="mb-4">
                        <h5 class="section-title">Identificación del Director</h5>
                        <div class="dropdown-divider mb-4"></div>
                        <div class="row">

                            <div class="col-md-4 mb-3">
                                <label for="email" class="form-label">Correo electrónico institucional</label>
                                <input type="email" class="form-control" value="{{ $director->email ?? 'N/A' }}" disabled>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="nombre" class="form-label">Nombre(s)</label>
                                    <input type="text" class="form-control" value="{{ $director->nombre }}" disabled>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="apellidoP" class="form-label">Apellido Paterno</label>
                                    <input type="text" class="form-control" value="{{ $director->apellidoP }}" disabled>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="apellidoM" class="form-label">Apellido Materno</label>
                                    <input type="text" class="form-control" value="{{ $director->apellidoM }}" disabled>
                                </div>
                            </div>

                            <h5 class="section-title mt-4">Información Académica</h5>
                            <div class="dropdown-divider mb-4"></div>

                            <div class="col-md-6 mb-3">
                                <label for="cuatrimestre" class="form-label">Dirección de carrera</label>
                                <input type="text" class="form-control" value="{{ $director->direccion->name ?? 'N/A' }}"
                                    disabled>
                            </div>
                        </div>
                    </div>

                    <!-- Botón de regreso -->
                    <div class="d-flex justify-content-end mt-4">
                        <x-buttons.back-button url="{{ route('directores.index') }}" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
</body>