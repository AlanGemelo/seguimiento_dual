@extends('layouts.app')
@section('title', 'Crear Mentor Industrial')

@section('content')
<body class="body">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <!-- Encabezado -->
                <x-forms.section-header title="Datos del Mentor de Unidad Economica "
                    description="Formulario para registrar al Mentor responsables del acompañamiento a estudiantes en el Modelo de Formación Dual." />

                <div class="card-body">
                    {{-- Identificación del Mentor de la Unidad Economica  --}}
                    <div class="mb-4">
                        <h5 class="section-title">Identificación del Mentor de la Unidad Economica</h5>
                        <div class="dropdown-divider mb-4"></div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="titulo" class="form-label">Grado académico</label>
                                <input type="text" data-tipo="text" class="form-control" id="titulo"
                                    placeholder="Ej. Ingeniero en TIC" name="titulo"
                                    value="{{ $mentorIndustrial->titulo }}" disabled>
                                @error('titulo')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="name" class="form-label">Nombre(s)</label>
                                <input type="text" data-tipo="text" class="form-control uppercase" id="name"
                                    placeholder="Ingrese su(s) nombre(s)" name="name"
                                    value="{{ $mentorIndustrial->name }}" disabled>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="apellidoP" class="form-label">Apellido Paterno</label>
                                <input type="text" data-tipo="text" class="form-control uppercase" id="apellidoP"
                                    placeholder="Ingrese su apellido paterno" name="apellidoP"
                                    value="{{ $mentorIndustrial->apellidoP }}" disabled>
                                @error('apellidoP')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="apellidoM" class="form-label">Apellido Materno</label>
                                <input type="text" data-tipo="text" class="form-control uppercase" id="apellidoM"
                                    placeholder="Ingrese su apellido materno" name="apellidoM"
                                    value="{{ $mentorIndustrial->apellidoM }}" disabled>
                                @error('apellidoM')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Vinculación Laboral --}}
                    <div class="mb-4">
                        <h5 class="section-title mt-4">Vinculación Laboral</h5>
                        <div class="dropdown-divider mb-4"></div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="cuatrimestre" class="form-label">Puesto de Trabajo </label>
                                <input type="text" class="form-control form-control-lg" id="puesto" name="puesto"
                                    value="{{ $mentorIndustrial->puesto }}" disabled>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="empresa_id" class="form-label">Empresa </label>
                                <input type="text" class="form-control form-control-lg" id="name" placeholder=""
                                    name="name" value="{{ $mentorIndustrial->empresa->nombre }}" disabled>
                            </div>
                        </div>
                    </div>

                    {{-- Estudiantes asignados --}}
                    <div class="mb-4">
                        <div class="dropdown-divider my-4"></div>
                        <h5 class="card-title" style="color:#006837; font-weight:700;">
                            <i class="mdi mdi-account-multiple-outline" style="color:#006837"></i>
                            Estudiantes asignados
                        </h5>
                        <div class="row">
                            @forelse($mentorIndustrial->estudiantes as $estudiante)
                                <div class="col-md-4 mb-4">
                                    <div class="card h-100 shadow-sm border-0"
                                        style="border-radius:14px;background:#f7faf9;">
                                        <div class="card-body d-flex flex-column justify-content-between">
                                            <h5 class="card-title" style="color:#46c35f;">{{ $estudiante->name }}</h5>
                                            <p class="mb-1"><strong>Matrícula:</strong> {{ $estudiante->matricula }}
                                            </p>
                                            <p class="mb-1"><strong>Proyecto:</strong>
                                                {{ $estudiante->nombre_proyecto ?? 'Sin proyecto' }}</p>
                                            <p class="mb-3"><strong>Cuatrimestre:</strong>
                                                {{ $estudiante->cuatrimestre }}</p>
                                            <a href="{{ route('estudiantes.show', Vinkla\Hashids\Facades\Hashids::encode($estudiante->matricula)) }}"
                                                class="btn btn-success mt-auto" style="background:#46c35f;border:none;">Ver
                                                detalles</a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="alert alert-info" style="background:#eafaf3;color:#58d8a3;">
                                        <i class="mdi mdi-information-outline"></i>
                                        No hay estudiantes asignados a este mentor.
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    {{-- Botones de acciones --}}
                    <div class="mt-3">
                        <x-buttons.cancel-button url="{{ route('mentores.index') }}" />
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
</body>