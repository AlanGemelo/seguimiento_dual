@extends('layouts.app')
@section('title', 'Crear Direccion de carrera')

@section('content')

    <body class="body">
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
                    <div class="col-lg-12">
                        <div class="card shadow">
                            <x-forms.section-header title="Registro Direcciones de Carrera "
                                description="Formulario para registrar la Direccion de Carrera responsables de la gestión y coordinación de una carrera universitaria o programa educativo." />
                            <div class="card-body">

                                <form class="pt-3" action="{{ route('direcciones.store') }}" method="post">
                                    @csrf
                                    <!-- Información Básica -->
                                    <div class="mb-4">
                                        <h5 class="section-title fw-bold">Identificación de la Direccion de Carrera</h5>
                                        <div class="dropdown-divider mb-4"></div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="name" class="form-label">Nombre de la Dirección <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="name"
                                                    placeholder="Nombre de la dirección de carrera" name="name"
                                                    value="{{ old('name') }}" required>
                                                @error('name')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="email_user" class="form-label">Correo Electrónico <span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group" style="max-width: 350px;">
                                                    <input type="text" class="form-control" id="email_user"
                                                        name="email_user" placeholder="usuario"
                                                        value="{{ old('email_user') }}" required>
                                                    <span class="input-group-text">@utvtol.edu.mx</span>
                                                </div>
                                                @error('email_user')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2 mb-3">
                                            <label for="ext_telefonica" class="form-label">
                                                Ext. <small class="text-muted">(Opcional)</small>
                                            </label>
                                            <input type="text" class="form-control" id="ext_telefonica"
                                                name="ext_telefonica" placeholder="Ext."
                                                value="{{ old('ext_telefonica') }}">
                                            @error('ext_telefonica')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="telefono" class="form-label">Teléfono de contacto <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="telefono" name="telefono"
                                                maxlength="13" placeholder="Ingrese el número de contacto"
                                                value="{{ old('telefono') }}" required>
                                            @error('telefono')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Botones de Acción -->
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                        <x-buttons.success-button text="Guardar" />
                                        <x-buttons.cancel-button url="{{ route('direcciones.index') }}" />
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
</body>
