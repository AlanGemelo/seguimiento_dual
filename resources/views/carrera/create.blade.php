@extends('layouts.app')
@section('title', 'Crear Programa Educativo')

@section('content')
    <div class="row">
        <div class="col-12 grid-margin">
            @if (session('status'))
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
                            <h4 class="card-title">Crear Programa Educativo</h4>
                            <span class="text-danger">* Son campos requeridos</span>
                            <div class="dropdown-divider"></div>
                            <form class="pt-3" action="{{ route('carreras.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="nombre">Nombre del Programa Educativo<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg" id="nombre" name="nombre"
                                        value="{{ old('nombre') }}">
                                    @error('nombre')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                   {{-- Seleccionar Docencia del estudiante--}}
                                   <div class="form-group">
                                    <label for="direccion_id" class="form-label">Direccion de Carrera <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" aria-label="Seleccionar Empresa"
                                            name="direccion_id">
                                        <option selected>Seleccione una opcion</option>
                                        @foreach ($direcciones as $carrera)
                                        <option value="{{ $carrera->id }}"
                                            {{ $carrera->id == session('direccion')->id ? "selected" : "" }}>
                                            {{ $carrera->name }}
                                        </option>  
                                            {{-- <option value="{{ $carrera->id }}">{{ $carrera->name }}</option> --}}
                                        @endforeach
                                    </select>
                                    @error('direccion_id')
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
