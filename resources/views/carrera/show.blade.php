@extends('layouts.app')
@section('title', 'Ver Programa Educativo')

@section('content')
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Ver Programa Educativo</h4>
                            <span class="text-danger">* Son campos requeridos</span>
                            <div class="dropdown-divider"></div>
                            <form class="pt-3" action="{{ route('carreras.index') }}" method="GET">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Nombre <span class="text-danger">*</span></label>
                                    <input disabled type="text" class="form-control form-control-lg" id="name"
                                           placeholder="" name="nombre" value="{{ $carrera->nombre, old('nombre') }}">
                                           @error('nombre')
                                           <div class="text-danger">{{ $message }}</div>
                                           @enderror
                                </div>
                                   {{-- Seleccionar Docencia del estudiante--}}
                                   <div class="form-group">
                                    <label for="direccion_id" class="form-label">Direccion de Carrera <span
                                            class="text-danger">*</span></label>
                                    <select disabled class="form-select" aria-label="Seleccionar Empresa"
                                            name="direccion_id">
                                        <option selected>Seleccione una opcion</option>
                                        @foreach ($direcciones as $direccion)
                                        <option value="{{ $direccion->id }}"
                                            {{ $carrera->direccion_id == $direccion->id ? "selected" : "" }}>
                                            {{ $direccion->name }}
                                        </option>                                        @endforeach
                                    </select>
                                    @error('direccion_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                       
                                <div class="mt-3">
                                    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                                            type="submit">Regresar
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
