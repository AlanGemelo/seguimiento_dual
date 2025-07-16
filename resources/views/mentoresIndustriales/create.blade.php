@extends('layouts.app')
@section('title', 'Crear Mentor Industrial')

@section('content')
<body class="body">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <!-- Encabezado -->
                <x-forms.section-header title="Registro Mentor de Unidad Economica "
                    description="Formulario para registrar al Mentor responsables del acompañamiento a estudiantes en el Modelo de Formación Dual." />

                <div class="card-body">
                    <!-- Información General -->
                    <form class="pt-3" action="{{ route('academicos.store') }}" method="post">
                        @csrf

                        {{-- Identificación del Mentor de la Unidad Economica  --}}
                        <div class="mb-4">
                            <h5 class="section-title fw-bold">Identificación del Mentor de la Unidad Economica</h5>
                            <div class="dropdown-divider mb-4"></div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="titulo" class="form-label">Grado académico</label>
                                    <div class="input-group">
                                        <input type="text" data-tipo="text" class="form-control" id="titulo"
                                            placeholder="Ej. Licenciado, Ingeniero, Doctor" name="titulo"
                                            value="{{ old('titulo') }}">
                                        @error('titulo')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="name" class="form-label">Nombre(s)</label>
                                    <input type="text" data-tipo="text" class="form-control uppercase" id="name"
                                        placeholder="Ingrese su(s) nombre(s)" name="name" value="{{ old('name') }}">
                                    @error('titulo')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="apellidoP" class="form-label">Apellido Paterno</label>
                                    <input type="text" class="form-control uppercase" id="apellidoP"
                                        placeholder="Ingrese su apellido paterno" name="apellidoP"
                                        value="{{ old('apellidoP') }}">
                                    @error('apellidoP')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="apellidoM" class="form-label">Apellido Materno</label>
                                    <input type="text" class="form-control uppercase" id="apellidoM"
                                        placeholder="Ingrese su apellido materno" name="apellidoM"
                                        value="{{ old('apellidoM') }}">
                                    @error('apellidoM')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Vinculación Laboral --}}
                        <div class="mb-4">
                            <h5 class="section-title mt-4 fw-bold">Vinculación Laboral</h5>
                            <div class="dropdown-divider mb-4"></div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="cuatrimestre" class="form-label">Puesto de Trabajo </label>
                                    <input type="text" class="form-control" id="puesto"
                                        placeholder="Ej. Jefe de Producción" name="puesto" value="{{ old('puesto') }}">
                                    @error('puesto')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="empresa_id" class="form-label">Empresa <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select form-control" aria-label="Seleccionar Empresa"
                                        name="empresa_id">
                                        <option selected>Seleccione una opcion</option>
                                        @foreach ($empresas as $empresa)
                                            <option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
                                        @endforeach
                                    </select>
                                    @error('empresa_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Botones de acciones --}}
                        <div class="mt-3">
                            <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                                type="submit">Guardar</button>
                            <x-buttons.cancel-button url="{{ route('mentores.index') }}" />

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
</body>