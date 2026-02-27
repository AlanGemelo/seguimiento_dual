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
                                    <div class="mb-4">
                                        <h5 class="section-title fw-bold">Identificación de la Direccion de Carrera</h5>
                                        <div class="dropdown-divider mb-4"></div>
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label for="titulo" class="form-label">Nombre de la Direccion<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" id="search" data-tipo="text"
                                                    class="form-control form-control-lg" id="name" name="name"
                                                    value="{{ old('name') }}">
                                                @error('name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="email" class="form-label">Correo <span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control form-control-lg"
                                                        id="email" name="email" value="{{ old('email') }}">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"
                                                            style="color:black; height: 100%;">@utvtol.edu.mx</span>
                                                    </div>
                                                </div>
                                                @error('email')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="d-flex justify-content-end mt-3">
                                                <button
                                                    class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                                                    type="submit">Guardar
                                                </button>
                                                <x-buttons.cancel-button url="{{ route('direcciones.index') }}" />
                                            </div>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
</body>
