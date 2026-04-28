@php
    use Illuminate\Support\Facades\Storage;
@endphp
@extends('layouts.app')
@section('title', 'Dirección de Carrera')

@section('content')

    <body class="body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow">
                    <x-forms.section-header title="Datos de la Dirección de Carrera"
                        description="Visualización de información institucional y programas educativos asociados a la dirección de carrera" />
                    <div class="card-body">
                        <!-- Información Básica -->
                        <div class="mb-4">
                            <h5 class="section-title fw-bold">Información de la Dirección Académica</h5>
                            <small class="text-muted text-stone-950">(Datos principales)</small>
                            <div class="dropdown-divider mb-4"></div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nombre" class="form-label">Nombre de la Dirección </label>
                                    <input type="text" class="form-control" id="nombre"
                                        placeholder="Razón social o nombre legal de la empresa" name="nombre"
                                        value="{{ $direccion->name }}" disabled>
                                    @error('nombre')
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
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email', $direccion->email) }}" disabled>
                            </div>

                            <!-- Extensión -->
                            <div class="col-12 col-md-2 mb-3 custom-width-ext">

                                <label for="ext_telefonica" class="form-label">Ext.</label>
                                <input type="text" class="form-control" id="ext_telefonica" name="ext_telefonica"
                                    placeholder="Ext." value="{{ $direccion->ext_telefonica ?? 'N/A' }}" disabled>
                            </div>

                            <!-- Teléfono -->
                            <div class="col-md-5 mb-3">
                                <label for="telefono" class="form-label">Teléfono de contacto <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="telefono" name="telefono"
                                    value="{{ preg_replace('/(\d{3})(\d{3})(\d{4})/', '$1-$2-$3', $direccion->telefono) }}"
                                    disabled>
                            </div>
                        </div>

                        <h4 class="section-title mt-4" style="font-size: 1rem ">Programas Educativos Asociados</h4>
                        <div class="dropdown-divider mt-4 mb-4"></div>
                        <div class="row">
                            @forelse ($direccion->programas as $programa)
                                <div class="col-md-4 mb-4">
                                    <div class="card h-100">
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="section-title">{{ $programa->nombre }}</h5>
                                            <p class="card-text">
                                                {{-- <strong>Clave:</strong> {{ $programa->clave ?? 'N/A' }}<br>
                                                    <strong>Nivel:</strong> {{ $programa->nivel ?? 'N/A' }}<br>
                                                    <strong>Modalidad:</strong> {{ $programa->modalidad ?? 'N/A' } --}}
                                            </p>
                                            <div class="mt-auto">
                                                <a href="{{ route('carreras.show', $programa->id) }}"
                                                    class="btn btn-primary btn-block">Ver detalles</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="alert alert-info">
                                        No hay programas educativos asociados a esta dirección.
                                    </div>
                                </div>
                            @endforelse
                        </div>

                        <div class="dropdown-divider mt-4 mb-4"></div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <x-buttons.back-button url="{{ route('direcciones.index') }}" />
                            @can('direcciones.edit')
                                <a href="{{ route('direcciones.edit', $direccion->id) }}" class="btn btn-warning">
                                    Editar Información
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</body>
