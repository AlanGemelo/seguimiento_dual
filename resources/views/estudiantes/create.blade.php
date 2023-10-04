@extends('layouts.app')
@section('title', 'Crear Estudiante')

@section('content')
    <div class="row">
        <div class="col-12 grid-margin">
            @if( session('status') )
                <div class="alert alert-danger alert-dismissible text-dark" role="alert">
                <span class="text-sm"> <a href="javascript:" class="alert-link text-dark">Excelente</a>.
                    {{ session('status') }}.</span>
                    <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Crear Estudiante Dual</h4>
                            <span class="text-danger">* Son campos requeridos</span>
                            <div class="dropdown-divider"></div>
                            <form class="pt-3" action="{{ route('estudiantes.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="matricula">Matricula <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control form-control-lg" id="matricula"
                                           name="matricula" value="{{ old('matricula') }}">
                                    @error('matricula')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg" id="name"
                                           placeholder="Juan Perez Hermenegildo" name="name" value="{{ old('name') }}">
                                    @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="curp">CURP <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg" id="curp" name="curp"
                                           value="{{ old('curp') }}">
                                    @error('curp')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="fecha_na">Fecha de Nacimiento <span class="text-danger">*</span></label>
                                    <div id="datepicker-popup" class="input-group date datepicker navbar-date-picker">
                                        <span class="input-group-addon input-group-prepend border-right">
                                            <span class="icon-calendar input-group-text calendar-icon"></span>
                                        </span>
                                        <input type="text" class="form-control" name="fecha_na" id="fecha_na" value="{{ old('fecha_na') }}">
                                    </div>
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
                                            type="submit">Guardar
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
