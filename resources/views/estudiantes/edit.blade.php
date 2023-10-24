@extends('layouts.app')
@section('title', 'Editar Estudiante')

@section('content')
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Editar Estudiante Dual</h4>
                            <span class="text-danger">* Son campos requeridos</span>
                            <div class="dropdown-divider"></div>
                            <form class="pt-3" action="{{ route('estudiantes.update', $estudiante->matricula) }}" method="post">
                                @csrf
                                @method('PATCH')
                                <div class="form-group">
                                    <label for="matricula">Matricula <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control form-control-lg" id="matricula"
                                           name="matricula" value="{{ old('matricula', $estudiante->matricula) }}">
                                    @error('matricula')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg" id="name"
                                           placeholder="Juan Perez Hermenegildo" name="name"
                                           value="{{ old('name', $estudiante->name) }}">
                                    @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="curp">CURP <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg" id="curp" name="curp"
                                           value="{{ old('curp', $estudiante->curp) }}">
                                    @error('curp')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="fecha_na">Fecha de Nacimiento <span class="text-danger">*</span></label>
                                    <div class="input-group date datepicker navbar-date-picker">
                                        <input type="date" class="form-control" name="fecha_na" id="fecha_na"
                                               value="{{ old('fecha_na', $estudiante->fecha_na) }}">
                                    </div>
                                    @error('fecha_na')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="cuatrimestre">Cuatrimestre <span class="text-danger">*</span></label>
                                    <select class="form-select"
                                            aria-label="Seleccionar Cuatrimestre" name="cuatrimestre">
                                        <option value="{{ old('cuatrimestre'), $estudiante->cuatrimestre }}">{{  $estudiante->cuatrimestre }}</option>
                                        @foreach ($cuatrimestres as $cuatrimestre)
                                            @if ($cuatrimestre != $estudiante->cuatrimestre)
                                                <option value="{{ $cuatrimestre }}">{{ $cuatrimestre }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('cuatrimestre')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="nombre_proyecto">Nombre del Proyecto <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg" id="nombre_proyecto"
                                           placeholder="Integrador" name="nombre_proyecto"
                                           value="{{ old('nombre_proyecto'), $estudiante->nombre_proyecto }}">
                                    @error('nombre_proyecto')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="empresa_id" class="form-label">Empresa <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" aria-label="Seleccionar Empresa" name="empresa_id">
                                        @foreach ($empresas as $empresa)
                                            <option value="{{ old('empresa_id') }}">{{ $empresa->nombre }}</option>
                                            @if ($empresa->id != $estudiante->empresa_id)
                                                <option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('empresa_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- Seleccionar Mentor academico--}}
                                <div class="form-group">
                                    <label for="academico_id" class="form-label">Mentor Academico <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" aria-label="Seleccionar Empresa" name="academico_id">
                                        @foreach ($academico as $user)
                                        <option value="{{ old('academico_id') }}">{{ $user->titulo }} {{ $user->name }}</option>
                                            @if ($user->id != $estudiante->academico_id)
                                                <option value="{{ $user->id }}">{{ $user->titulo }} {{ $user->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('academico_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- Seleccionar Acesor industrial--}}
                                <div class="form-group">
                                    <label for="asesorin_id" class="form-label">Acesor Indutrial <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" aria-label="Seleccionar Empresa" name="asesorin_id">
                                        @foreach ($industrial as $mentorIndustrial)
                                            <option value="{{ old('asesorin_id') }}">{{ $mentorIndustrial->titulo }} {{ $mentorIndustrial->name }}</option>
                                            @if ($user->id != $estudiante->academico_id)
                                                <option value="{{ $mentorIndustrial->id }}">{{ $mentorIndustrial->titulo }} {{ $mentorIndustrial->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('asesorin_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- Seleccionar Carrera del estudiante--}}
                                <div class="form-group">
                                    <label for="carrera_id" class="form-label">Carrera <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" aria-label="Seleccionar Empresa" name="carrera_id">
                                        @foreach ($carreras as $carrera)
                                            <option value="{{ old('carrera_id') }}">{{ $carrera->nombre }}</option>
                                            @if ($carrera->id != $estudiante->carrera_id)
                                                <option value="{{ $carrera->id }}">{{ $carrera->nombre }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('carrera_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                                            type="submit">Editar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
