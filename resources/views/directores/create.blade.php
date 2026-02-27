@extends('layouts.app')
@section('title', 'Crear Director de Carrera')

@section('content')

    <body class="body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow">
                    <x-forms.section-header title="Registro Director de Carrera "
                        description="Formulario para registrar al Director responsables del buen funcionamiento de la carrera, tanto a nivel académico como en la gestión de recursos y la relación con estudiantes y profesores. " />

                    <div class="card-body">

                        <form class="pt-3" action="{{ route('directores.store') }}" method="post">
                            @csrf
                            <div class="mb-4">
                                <h5 class="section-title fw-bold">Identificación del Director de Carrera</h5>
                                <div class="dropdown-divider mb-4"></div>
                                <div class="form-group">
                                    <label for="nombre" class="form-label">Nombre(s) <span
                                            class="text-danger">*</span></label>
                                    <input type="text" data-tipo="text" class="form-control form-control-lg uppercase"
                                        id="nombre" placeholder="Ingrese su(s) nombre(s)" name="nombre"
                                        value="{{ old('nombre') }}">
                                    @error('nombre')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="apellidoP" class="form-label">Apellido Paterno <span
                                            class="text-danger">*</span></label>
                                    <input type="text" data-tipo="text" class="form-control form-control-lg uppercase"
                                        id="apellidoP" placeholder="Ingrese su apellido paterno" name="apellidoP"
                                        value="{{ old('apellidoP') }}">
                                    @error('apellidoP')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="apellidoM" class="form-label">Apellido Materno <span
                                            class="text-danger">*</span></label>
                                    <input type="text" data-tipo="text" class="form-control form-control-lg uppercase"
                                        id="apellidoM" placeholder="Ingrese su apellido materno" name="apellidoM"
                                        value="{{ old('apellidoM') }}">
                                    @error('apellidoM')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email" class="form-label">Correo Electronico <span
                                            class="text-danger">*</span></label>
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

                                <div class="d-flex justify-content-end mt-3">
                                    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                                        type="submit">Guardar
                                    </button>
                                    <x-buttons.cancel-button url="{{ route('directores.index') }}" />
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
