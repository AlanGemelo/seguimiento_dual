@extends('layouts.app')
@section('title', 'Editar Dirección de Carrera')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <x-forms.section-header title="Editar Direccion de Carrera "
                    description="Formulario para editar la Direccion de Carrera responsables de la gestión y coordinación de una carrera universitaria o programa educativo." />
                <div class="card-body">
                    <form class="pt-3" action="{{ route('direcciones.update', $hash) }}" method="post">
                        @csrf
                        @method('PATCH') @csrf
                        @method('PATCH')
                        <!-- Información Básica -->
                        <div class="mb-4">
                            <h5 class="section-title fw-bold">Identificación de la Direccion de Carrera</h5>
                            <small class="text-muted text-stone-950">(Datos principales)</small>
                            <div class="dropdown-divider mb-4"></div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Nombre de la Dirección </label>
                                    <input type="text" class="form-control" id="name"
                                        placeholder="Nombre de la Dirección de Carrera" name="name"
                                        value="{{ old('name', $direccion->name) }}">
                                    @error('name')
                                        <div class="text-danger invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Datos de Contacto --}}
                        <div class="row mb-4">
                            <h5 class="section-title fw-bold">Datos de Contacto </h5>
                            <small class="text-muted text-stone-950">(Comunicación directa)</small>
                            <div class="dropdown-divider mb-4"></div>

                            <!-- Correo -->
                            <div class="col-md-5 mb-3">
                                <label for="email" class="form-label">Correo Electrónico <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="email_user" name="email_user"
                                    value="{{ old('email_user', explode('@', $direccion->email)[0]) }}">
                            </div>

                            <!-- Extensión -->
                            <div class="col-md-2 mb-3" style="max-width: 10%">

                                <label for="ext_telefonica" class="form-label">Ext.</label>
                                <input type="text" class="form-control" id="ext_telefonica" name="ext_telefonica"
                                    placeholder="Ext." value="{{ old('ext_telefonica', $direccion->ext_telefonica) }}">
                            </div>

                            <!-- Teléfono -->
                            <div class="col-md-5 mb-3">
                                <label for="telefono" class="form-label">Teléfono de contacto <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="telefono" name="telefono"
                                    value="{{ old('telefono', $direccion->telefono) }}">
                            </div>
                        </div>


                        <div class="d-flex justify-content-end mt-3">
                            <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                                type="submit">Actualizar
                            </button>

                            <x-buttons.cancel-button url="{{ route('direcciones.index') }}" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
