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

                    <h5 class="section-title">Información de la Dirección Académica</h5>
                    <div class="dropdown-divider mb-4"></div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nombre de la Dirección</label>
                                <input type="text" class="form-control form-control-lg" id="name" name="name"
                                    value="{{ $direccion->name }}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Correo Electrónico</label>
                                <p class="form-control form-control-lg" style="background-color: #e9ecef;">
                                    <a href="mailto:{{ $direccion->email }}">{{ $direccion->email }}</a>
                                </p>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="director">Director de Carrera</label>
                                <input type="text" class="form-control form-control-lg" id="director" name="director"
                                    value="{{ $direccion->director ? $direccion->director->nombre . ' ' . $direccion->director->apellidoP . ' ' . $direccion->director->apellidoM : 'No asignado' }}"
                                    disabled>
                            </div>
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

                    <div class="d-flex justify-content-between">
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