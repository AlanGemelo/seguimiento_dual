@extends('layouts.app')
@section('title', 'Editar Dirección de Carrera')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <x-forms.section-header title="Editar Programa Educativo"
                    description="Formulario para actualizar datos del programa educativo." />

                <div class="card-body">
                    <form class="pt-3" action="{{ route('carreras.update', $carrera->id) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <!-- Información Básica -->
                        <div class="mb-4">
                            <h5 class="section-title">Información Básica</h5>
                            <div class="dropdown-divider mb-4"></div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="grado_academico">Nivel Académico <span class="text-danger">*</span></label>
                                    <select class="form-control form-control-lg" id="grado_academico" name="grado_academico"
                                        required>
                                        <option value="" disabled
                                            {{ old('grado_academico', $carrera->grado_academico ?? '') == '' ? 'selected' : '' }}>
                                            Seleccione el nivel educativo
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
                                        id="nombre" name="nombre" value="{{ old('nombre', $carrera->nombre) }}">
                                    @error('nombre')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-8 mb-3">
                                    <label for="direccion_id" class="form-label">Direccion de Carrera <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" aria-label="Seleccionar Empresa" name="direccion_id">
                                        <option selected>Seleccione una opcion</option>
                                        @foreach ($direcciones as $carrera)
                                            <option value="{{ $carrera->id }}"
                                                {{ $carrera->id == session('direccion')->id ? 'selected' : '' }}>
                                                {{ $carrera->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('direccion_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Botones de Acción -->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <x-buttons.success-button text="Actualizar" />
                            <x-buttons.cancel-button url="{{ route('carreras.index') }}" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
