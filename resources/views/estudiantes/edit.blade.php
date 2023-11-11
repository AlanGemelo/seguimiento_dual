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
                            <form class="pt-3" action="{{ route('estudiantes.update', Vinkla\Hashids\Facades\Hashids::encode($estudiante->matricula)) }}"
                                  method="post" enctype="multipart/form-data">
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
                                    <input type="date" class="form-control form-control-lg" name="fecha_na"
                                           id="fecha_na"
                                           value="{{ old('fecha_na', $estudiante->fecha_na) }}">
                                    @error('fecha_na')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="cuatrimestre">Cuatrimestre <span class="text-danger">*</span></label>
                                    <select class="form-select"
                                            aria-label="Seleccionar Cuatrimestre" name="cuatrimestre">
                                        @if ($estudiante->cuatrimestre)
                                            <option value="{{ $estudiante->cuatrimestre }}" selected>{{ $estudiante->cuatrimestre }}</option>
                                        @endif
                                        @foreach ($cuatrimestres as $cuatrimestre)
                                            <option value="{{ $cuatrimestre }}">{{ $cuatrimestre }}</option>
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
                                           value="{{ $estudiante->nombre_proyecto, old('nombre_proyecto') }}">
                                    @error('nombre_proyecto')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="empresa_id" class="form-label">Empresa <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" aria-label="Seleccionar Empresa" name="empresa_id">
                                        @if ($estudiante->empresa_id)
                                            <option value="{{ $estudiante->empresa_id }}"
                                                    selected>{{ $estudiante->empresa->nombre }}</option>
                                        @endif
                                        @foreach ($empresas as $empresa)
                                            <option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
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
                                    <select class="form-select" aria-label="Seleccionar Mentor Academico" name="academico_id">
                                        @if ($estudiante->academico_id)
                                            <option value="{{ $estudiante->academico_id }}" selected>{{ $estudiante->academico->name }}</option>
                                        @endif
                                        @foreach ($academicos as $academico)
                                            <option value="{{ $academico->id }}">{{ $academico->name }}</option>
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
                                    <select class="form-select" aria-label="Seleccionar Asesor Industrial" name="asesorin_id">
                                        @if ($estudiante->asesorin_id)
                                            <option value="{{ $estudiante->asesorin_id }}" selected>{{ $estudiante->asesorin->name }}</option>
                                        @endif
                                        @foreach ($industrials as $industrial)
                                            <option value="{{ $industrial->id }}">{{ $industrial->name }}</option>
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
                                    <select class="form-select" aria-label="Seleccionar Carrera" name="carrera_id">
                                        @if ($estudiante->carrera_id)
                                            <option value="{{ $estudiante->carrera_id }}" selected>{{ $estudiante->carrera->nombre }}</option>
                                        @endif
                                        @foreach ($carreras as $carrera)
                                            <option value="{{ $carrera->id }}">{{ $carrera->nombre }}</option>
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
