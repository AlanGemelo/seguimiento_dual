@extends('layouts.app')
@section('title', 'Crear Empresa')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow">
                    <div class="card-header d-flex flex-column align-items-center text-center"
                        style="background-color: border-bottom: 2px solid #004D40;">
                        <h4 class="mb-0">Crear Nueva Empresa</h4>
                        <small" class="form-text text-muted">Complete todos los campos obligatorios</small>
                    </div>

                    <div class="card-body">
                        <form enctype="multipart/form-data" action="{{ route('empresas.store') }}" method="post"
                            class="needs-validation" novalidate>
                            @csrf

                            <!-- Información Básica -->
                            <div class="mb-4">
                                <h5 class="section-title">Información Básica</h5>
                                <div class="dropdown-divider mb-4"></div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="nombre" class="form-label">Nombre de la empresa <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="nombre"
                                            placeholder="Razón social o nombre legal de la empresa" name="nombre"
                                            value="{{ old('nombre') }}" required>
                                        @error('nombre')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">Correo Electrónico <span
                                                class="text-danger">*</span></label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="ejemplo@empresa.com" value="{{ old('email') }}" required>
                                        @error('email')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-8 mb-3">
                                        <label for="direccion" class="form-label">Dirección de la sede principal <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="direccion"
                                            placeholder="Calle, número, ciudad, provincia, país" name="direccion"
                                            value="{{ old('direccion') }}" required>
                                        @error('direccion')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="telefono" class="form-label">Teléfono de contacto <span
                                                class="text-danger">*</span></label>
                                        <input type="telefono" class="form-control" id="telefono" name="telefono"
                                            placeholder="Ingrese el numero de contacto" tipo-data="number"
                                            value="{{ old('telefono') }}" required>
                                    </div>
                                    @error('telefono')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                    </div>

                    <!-- Direcciones de Carrera -->
                    <div class="mb-4 p-3">
                        <h5 class="section-title">Direcciones de Carrera</h5>
                        <small class="text-muted text-stone-950">
                            Seleccione las carreras con las que su empresa desea colaborar en el sistema de
                            formación dual.
                        </small>
                        <div class="dropdown-divider mb-4"></div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="card h-100 border-primary">
                                    <div class="card-header text-white" style="background-color: #66BB6A;">
                                        <h6 class="mb-0">Direcciones Seleccionadas</h6>
                                    </div>
                                    <div class="card-body">
                                        <div id="selected-direcciones-container" class="selected-items-container">
                                            @if (is_array(old('direcciones_ids')) || (!old() && session()->has('direccion')))
                                                @foreach ($direcciones as $direccion)
                                                    @if (
                                                        (is_array(old('direcciones_ids')) && in_array($direccion->id, old('direcciones_ids'))) ||
                                                            (!old() && session()->has('direccion') && session('direccion')->id == $direccion->id))
                                                        <div class="selected-item">
                                                            <span class="badge mb-2 p-2 d-flex align-items-center"
                                                                style="background-color: #66BB6A; width: min-content; ">
                                                                {{ $direccion->name }}
                                                                <input type="hidden" name="direcciones_ids[]"
                                                                    value="{{ $direccion->id }}">
                                                                <button type="button"
                                                                    class="btn-close btn-close-white ms-2 remove-item"
                                                                    aria-label="Remover"></button>
                                                            </span>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @else
                                                <div class="text-muted py-3 text-center">No hay direcciones seleccionadas
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="card-footer bg-light">
                                        <small class="text-muted">Total seleccionadas: <span id="count-selected"
                                                class="fw-bold">0</span></small>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="card h-100">
                                    <div class="card-header text-white" style="background-color: #004D40;">
                                        <h6 class="mb-0">Carreras Disponibles</h6>
                                    </div>
                                    <div class="card-body" style="max-height: 250px; overflow-y: auto;">
                                        <div class="list-group list-group-flush" id="available-direcciones-container">
                                            @foreach ($direcciones as $direccion)
                                                @if ($direccion)
                                                    <div
                                                        class="list-group-item d-flex justify-content-between align-items-center py-2">
                                                        <span>{{ $direccion->name }}</span>
                                                        <button type="button"
                                                            class="btn btn-sm btn-outline-warning add-item"
                                                            data-id="{{ $direccion->id }}"
                                                            data-name="{{ $direccion->name }}">
                                                            <i class="fas fa-plus me-1"></i>Agregar
                                                        </button>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="card-footer bg-light">
                                        <small class="text-muted">Total disponibles: <span
                                                class="fw-bold">{{ count($direcciones) }}</span></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @error('direcciones_ids')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Documentos del Convenio -->
                    <div class="mb-4 p-3">
                        <h5 class="section-title">Documentos del Convenio</h5>
                        <div class="dropdown-divider mb-4"></div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="convenioA" class="form-label">Convenio Específico <span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="file" class="form-control" id="convenioA" name="convenioA" required>
                                    <button class="btn btn-outline-secondary" type="button" data-bs-toggle="tooltip"
                                        title="Formato PDF, máximo 5MB">
                                        <i class="fas fa-info-circle"></i>
                                    </button>
                                </div>
                                @error('convenioA')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="convenioMA" class="form-label">Convenio Marco-Empresa <span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="file" class="form-control" id="convenioMA" name="convenioMA"
                                        required>
                                    <button class="btn btn-outline-secondary" type="button" data-bs-toggle="tooltip"
                                        title="Formato PDF, máximo 5MB">
                                        <i class="fas fa-info-circle"></i>
                                    </button>
                                </div>
                                @error('convenioMA')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Vigencia del Convenio -->
                    <div class="mb-4 p-3">
                        <h5 class="section-title">Vigencia del Convenio</h5>

                        <div class="dropdown-divider mb-4"></div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="inicio_conv" class="form-label">Fecha de Inicio <span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                    <input type="date" class="form-control" name="inicio_conv" id="inicio_conv"
                                        value="{{ old('inicio_conv') }}" required>
                                </div>
                                @error('inicio_conv')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="fin_conv" class="form-label">Fecha de Finalización <span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                    <input type="date" class="form-control" name="fin_conv" id="fin_conv"
                                        value="{{ old('fin_conv') }}" required>
                                </div>
                                @error('fin_conv')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Botones de Acción -->
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                        <x-cancel-button url="{{ route('empresas.index') }}" />
                        <button type="submit" class="btn" style="background-color: #006837; color: white;">
                            <i class="fas fa-save me-1"></i> Guardar Empresa
                        </button>

                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

<script src="{{ asset('js/multipleSelector.js') }}"></script>
