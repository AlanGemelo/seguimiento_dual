@extends('layouts.app')
@section('title', 'Crear Programa Educativo')

@section('content')

    <body class="body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow">
                    <x-forms.section-header title="Registro de Programas Educativos"
                        description="Formulario para registrar nuevos programas educativos." />

                    <div class="card-body">
                        <form action="{{ route('carreras.store') }}" method="post" class="needs-validation" novalidate>
                            @csrf

                            <!-- Información Básica -->
                            <div class="mb-4">
                                <h5 class="section-title">Información Básica</h5>
                                <div class="dropdown-divider mb-4"></div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="grado_academico">Nivel Académico <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control form-control-lg" id="grado_academico"
                                            name="grado_academico" required>
                                            <option value="" disabled selected>Seleccione el nivel educativo
                                            </option>
                                            @foreach ($grado_academico as $grado)
                                                <option value="{{ $grado['grado_academico'] }}"
                                                    {{ old('grado_academico', $carrera->grado_academico ?? '') == $grado['grado_academico'] ? 'selected' : '' }}>
                                                    {{ $grado['grado_academico'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('grado_academico')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="nombre">Nombre del Programa Educativo<span
                                                class="text-danger">*</span></label>
                                        <input type="text" data-tipo="text" class="form-control form-control-lg"
                                            id="nombre" name="nombre" value="{{ old('nombre') }}">
                                        @error('nombre')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-8 mb-3">
                                        <label for="direccion_id" class="form-label">
                                            Dirección de Carrera <span class="text-danger">*</span>
                                        </label>

                                        <select class="form-select" id="direccion_id" name="direccion_id" required>

                                            <option value="" disabled selected>
                                                Seleccione una opción
                                            </option>

                                            @foreach ($direcciones as $direccion)
                                                <option value="{{ $direccion->id }}">
                                                    {{ $direccion->name }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('direccion_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="duracion_cuatrimestres" class="form-label">
                                            Duración en cuatrimestres
                                        </label>

                                        <input type="number" class="form-control form-control-lg"
                                            id="duracion_cuatrimestres" name="duracion_cuatrimestres" min="1"
                                            value="{{ old('duracion_cuatrimestres') }}" placeholder="Ej. 9">

                                        @error('duracion_cuatrimestres')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            <!-- Botones de Acción -->
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                <x-buttons.success-button text="Registrar " />
                                <x-buttons.cancel-button url="{{ route('carreras.index') }}" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    @endsection
</body>
