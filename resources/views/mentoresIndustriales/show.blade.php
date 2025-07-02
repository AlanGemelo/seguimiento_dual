@extends('layouts.app')
@section('title', 'Mostrar Mentor Industrial')

@section('content')
<link rel="stylesheet" href="{{ asset('css/listas.css') }}">
    <body class="body">
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Mentor de Unidad Economica</h4>
                            <div class="dropdown-divider"></div>
                            <div class="form-group">
                                <label for="titulo">Grado</label>
                                <input type="text" class="form-control form-control-lg" id="titulo" placeholder=""
                                    name="titulo" value="{{ $mentorIndustrial->titulo }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input type="text" class="form-control form-control-lg" id="name"
                                    placeholder="Nombre(s)" name="name" value="{{ $mentorIndustrial->name }}" disabled>
                            </div>

                            <div class="form-group">
                                <label for="apellidoP">Apellido Paterno</label>
                                <input type="text" class="form-control form-control-lg" id="apellidoP"
                                    placeholder="Apellido paterno" name="apellidoP"
                                    value="{{ $mentorIndustrial->apellidoP }}" disabled>
                            </div>

                            <div class="form-group">
                                <label for="apellidoM">Apellido Materno</label>
                                <input type="text" class="form-control form-control-lg" id="apellidoM"
                                    placeholder="Apellido materno" name="apellidoM"
                                    value="{{ $mentorIndustrial->apellidoM }}" disabled>
                            </div>

                            <div class="form-group">
                                <label for="name">Empresa</label>
                                <input type="text" class="form-control form-control-lg" id="name" placeholder=""
                                    name="name" value="{{ $mentorIndustrial->empresa->nombre }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="puesto">Puesto de trabajo</label>
                                <input type="text" class="form-control form-control-lg" id="puesto" name="puesto"
                                    value="{{ $mentorIndustrial->puesto }}" disabled>
                            </div>
                            {{-- Estudiantes asignados --}}
                            <div class="dropdown-divider my-4"></div>
                            <h5 class="card-title" style="color:#46c35f; font-weight:700;">
                                <i class="mdi mdi-account-multiple-outline" style="color:#58d8a3"></i>
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
                                                    class="btn btn-success mt-auto"
                                                    style="background:#46c35f;border:none;">Ver detalles</a>
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
                            {{-- Fin estudiantes --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
</body>