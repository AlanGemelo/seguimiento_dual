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
                                        <span class="input-group-addon input-group-prepend border-right">
                                            <span class="icon-calendar input-group-text calendar-icon"></span>
                                        </span>
                                        <input type="text" class="form-control" name="fecha_na" id="fecha_na"
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
                                        <option selected>Seleccione una opcion</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                    </select>
                                    @error('cuatrimestre')
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
