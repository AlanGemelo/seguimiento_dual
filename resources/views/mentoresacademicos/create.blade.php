@extends('layouts.app')
@section('title', 'Crear Mentor Academico')
@section('content')
<link rel="stylesheet" href="{{ asset('css/listas.css') }}">
    <body class="body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow">
                    <!-- Encabezado -->
                    <x-section-header title="Registro de Mentor Académico "
                        description="Formulario para registrar docentes responsables del acompañamiento a estudiantes en el Modelo de Formación Dual." />


                    <div class="card-body">
                        <!-- Información General -->
                        <form class="pt-3" action="{{ route('academicos.store') }}" method="post">
                            @csrf
                            <div class="mb-4">
                                <h5 class="section-title">Identificación del Mentor Académico</h5>
                                <div class="dropdown-divider mb-4"></div>
                                <div class="row">

                                    <div class="col-md-4 mb-3">
                                        <label for="email" class="form-label">Correo electrónico institucional</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="email"
                                                placeholder="nombre_de_usuario" name="email" value="{{ old('email') }}">
                                            <div class="input-group-append">
                                                <span class="input-group-text" style="color:black;">@utvtol.edu.mx</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="name" class="form-label">Nombre(s)</label>
                                            <input type="text" data-tipo="text" class="form-control uppercase" id="name"
                                                placeholder="Ingrese su(s) nombre(s)" name="name"
                                                value="{{ old('name') }}">
                                            @error('titulo')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="apellidoP" class="form-label">Apellido Paterno</label>
                                            <input type="text" class="form-control uppercase" id="apellidoP"
                                                placeholder="Ingrese su apellido paterno" name="apellidoP"
                                                value="{{ old('apellidoP') }}">
                                            @error('apellidoP')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="apellidoM" class="form-label">Apellido Materno</label>
                                            <input type="text" class="form-control uppercase" id="apellidoM"
                                                placeholder="Ingrese su apellido materno" name="apellidoM"
                                                value="{{ old('apellidoM') }}">
                                            @error('apellidoM')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <h5 class="section-title mt-4">Información Académica</h5>
                                    <div class="dropdown-divider mb-4"></div>
                                    <div class="col-md-6 mb-3">
                                        <label for="cuatrimestre" class="form-label">Grado Académico</label>
                                        <input type="text" class="form-control uppercase" id="titulo"
                                            placeholder="Ej. Licenciado, Ingeniero, Doctor" name="titulo"
                                            value="{{ old('titulo') }}">
                                        @error('titulo')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="cuatrimestre" class="form-label">Dirección de carrera</label>
                                        <select class="form-select" aria-label="Seleccionar Empresa" name="direccion_id">
                                            <option selected>Seleccione una opcion</option>
                                            @foreach ($direcciones as $carrera)
                                                <option value="{{ $carrera->id }}"
                                                    data-direccion="{{ $carrera->direccion_id }}">
                                                    {{ $carrera->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('direccion_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3">
                                <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                                    type="submit">Guardar</button>

                                <x-cancel-button url="{{ route('academicos.index') }}" />

                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
</body>