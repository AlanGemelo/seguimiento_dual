@extends('layouts.app')
@section('title', 'Crear Director de Carrera')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/listas.css') }}">

    <body class="body">
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
                                        <label for="nombre">Nombre(s) <span class="text-danger">*</span></label>
                                        <input type="text" data-tipo="text"
                                            class="form-control form-control-lg uppercase" id="nombre"
                                            placeholder="Ingrese su(s) nombre(s)" name="nombre"
                                            value="{{ old('nombre') }}">
                                        @error('nombre')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="apellidoP">Apellido Paterno <span class="text-danger">*</span></label>
                                        <input type="text" data-tipo="text"
                                            class="form-control form-control-lg uppercase" id="apellidoP"
                                            placeholder="Ingrese su apellido paterno" name="apellidoP"
                                            value="{{ old('apellidoP') }}">
                                        @error('apellidoP')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="apellidoM">Apellido Materno <span class="text-danger">*</span></label>
                                        <input type="text" data-tipo="text"
                                            class="form-control form-control-lg uppercase" id="apellidoM"
                                            placeholder="Ingrese su apellido materno" name="apellidoM"
                                            value="{{ old('apellidoM') }}">
                                        @error('apellidoM')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Correo Electronico <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="text" class="form-control form-control-lg" id="email"
                                                placeholder="nombre_de_usuario" name="email" value="{{ old('email') }}">
                                            <div class="input-group-append">
                                                <span class="input-group-text"
                                                    style="color:black; height: 100%;">@utvtol.edu.mx</span>
                                            </div>

                                        </div>

                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="direccion_id" class="form-label">Direccion de Carrera <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select" aria-label="Seleccionar Empresa" name="direccion_id"
                                            required>
                                            <option value="">Seleccione una opción</option>
                                            @foreach ($direcciones as $empresa)
                                                <option value="{{ $empresa->id }}"
                                                    @if ($empresa->director) disabled @endif>
                                                    {{ $empresa->name }}
                                                    @if ($empresa->director)
                                                        (Ya tiene director)
                                                    @endif
                                                </option>
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
                                        <x-buttons.back-button url="{{ route('directores.index') }}" />
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
