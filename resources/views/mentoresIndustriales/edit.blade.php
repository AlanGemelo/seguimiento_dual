@extends('layouts.app')
@section('title', 'Editar Estudiante')

@section('content')
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mt-3 px-3">Editar Mentor Industrial</h4>
                            <span class="text-danger">* Son campos requeridos</span>
                            <div class="dropdown-divider"></div>

                            <form class="pt-3" action="{{ route('mentores.update', $mentorIndustrial->id) }}"
                                method="post">
                                @csrf
                                @method('PATCH')
                                <div class="form-group">
<<<<<<< HEAD
                                    <label for="titulo">Título: <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg" id="titulo"
                                           placeholder="" name="titulo" value="{{ $mentorIndustrial->titulo, old('titulo') }}">
=======
                                    <label for="titulo">Grado académico <span class="text-danger">*</span></label>
                                    <input type="text" data-tipo="text" class="form-control form-control-lg"
                                        id="titulo" placeholder="Ej. Ingeniero en TIC" name="titulo"
                                        value="{{ $mentorIndustrial->titulo, old('titulo') }}">
>>>>>>> f57f20083a2decb167ed3140251ba15d87cdac3d
                                    @error('titulo')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
<<<<<<< HEAD
                                    <label for="name">Nombre: <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg" id="name"
                                           placeholder="" name="name" value="{{ $mentorIndustrial->name, old('name') }}">
=======
                                    <label for="name">Nombre(s) <span class="text-danger">*</span></label>
                                    <input type="text" data-tipo="text" class="form-control form-control-lg uppercase"
                                        id="name" placeholder="Ingrese su(s) nombre(s)" name="name"
                                        value="{{ old('name', $mentorIndustrial->name ?? '') }}">
>>>>>>> f57f20083a2decb167ed3140251ba15d87cdac3d
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="apellidoP">Apellido Paterno <span class="text-danger">*</span></label>
                                    <input type="text" data-tipo="text" class="form-control form-control-lg uppercase"
                                        id="apellidoP" placeholder="Ingrese su apellido paterno" name="apellidoP"
                                        value="{{ old('apellidoP', $mentorIndustrial->apellidoP ?? '') }}">
                                    @error('apellidoP')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="apellidoM">Apellido Materno <span class="text-danger">*</span></label>
                                    <input type="text" data-tipo="text" class="form-control form-control-lg uppercase"
                                        id="apellidoM" placeholder="Ingrese su apellido materno" name="apellidoM"
                                        value="{{ old('apellidoM', $mentorIndustrial->apellidoM ?? '') }}">
                                    @error('apellidoM')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="empresa_id" class="form-label">Empresa <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" type="number" aria-label="Seleccionar Empresa"
                                        name="empresa_id">
                                        <option selected>Seleccione una opcion</option>
                                        @foreach ($empresas as $empresa)
                                            @if ($empresa->id == $mentorIndustrial->empresa_id)
                                                <option selected value="{{ $empresa->id }}">{{ $empresa->nombre }}
                                                </option>
                                            @else
                                                <option value={{ $empresa->id }}>{{ $empresa->nombre }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('empresa_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="puesto">Puesto de trabajo <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg" id="puesto"
                                        placeholder="Ej. Jefe de Producción" name="puesto"
                                        value="{{ old('puesto', $mentorIndustrial->puesto) }}">
                                    @error('puesto')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                                        type="submit">ACTUALIZAR
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
