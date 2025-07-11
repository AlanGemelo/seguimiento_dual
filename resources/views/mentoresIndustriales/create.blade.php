@extends('layouts.app')
@section('title', 'Crear Mentor Industrial')

@section('content')
<link rel="stylesheet" href="{{ asset('css/listas.css') }}">
    <body class="body">
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Crear Mentor de Unidad Economica</h4>
                            <span class="text-danger">* Son campos requeridos</span>
                            <div class="dropdown-divider"></div>
                            <form class="pt-3" action="{{ route('mentores.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="titulo">Grado académico <span class="text-danger">*</span></label>
                                    <input type="text" data-tipo="text" class="form-control form-control-lg"
                                        id="titulo" placeholder="Ej. Licenciado, Ingeniero, Doctor" name="titulo"
                                        value="{{ old('titulo') }}">
                                    @error('titulo')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name">Nombre(s) <span class="text-danger">*</span></label>
                                    <input type="text" data-tipo="text" class="form-control form-control-lg uppercase"
                                        id="name" placeholder="Ingrese su(s) nombre(s)" name="name"
                                        value="{{ old('name') }}">
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="apellidoP">Apellido Paterno <span class="text-danger">*</span></label>
                                    <input type="text" data-tipo="text" class="form-control form-control-lg uppercase"
                                        id="apellidoP" placeholder="Ingrese su apellido paterno" name="apellidoP"
                                        value="{{ old('apellidoP') }}">
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="apellidoM">Apellido Materno <span class="text-danger">*</span></label>
                                    <input type="text" data-tipo="text" class="form-control form-control-lg uppercase"
                                        id="apellidoM" placeholder="Ingrese su apellido Materno" name="apellidoM"
                                        value="{{ old('apellidoM') }}">
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="puesto">Puesto de trabajo <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg" id="puesto"
                                        placeholder="Ej. Jefe de Producción" name="puesto" value="{{ old('puesto') }}">
                                    @error('puesto')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="empresa_id" class="form-label">Empresa <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" aria-label="Seleccionar Empresa" name="empresa_id">
                                        <option selected>Seleccione una opcion</option>
                                        @foreach ($empresas as $empresa)
                                            <option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
                                        @endforeach
                                    </select>
                                    @error('empresa_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                                        type="submit">Guardar
                                    </button>
                                   <x-buttons.cancel-button url="{{ route ('mentores.index') }}"/>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
</body>