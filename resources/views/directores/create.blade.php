@extends('layouts.app')
@section('title', 'Crear Director de Carrera')

@section('content')
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Crear Director de Carrera</h4>
                            <span class="text-danger">* Son campos requeridos</span>
                            <div class="dropdown-divider"></div>
                            <form class="pt-3" action="{{ route('directores.store') }}" method="post">
                                @csrf
 
                                <div class="form-group">
                                    <label for="nombre">Nombre <span class="text-danger">*</span></label>
                                    <input type="text" data-tipo="text" class="form-control form-control-lg"
                                        id="nombre" placeholder="" name="nombre" value="{{ old('nombre') }}">
                                    @error('nombre')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Correo Electronico <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg" id="email" placeholder=""
                                        name="email" value="{{ old('email') }}">
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="direccion_id" class="form-label">Direccion de Carrera <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" aria-label="Seleccionar Empresa" name="direccion_id">
                                        <option selected>Seleccione una opcion</option>
                                        @foreach ($direcciones as $empresa)
                                            <option value="{{ $empresa->id }}">{{ $empresa->name }}</option>
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
