@php use Illuminate\Support\Facades\Storage; @endphp

@extends('layouts.app')
@section('title', 'Mostrar UEI')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow">
                    <x-section-header title="Datos de la Unidad Económica Interesada (UEI)"
                        description="Visualización de la información de la Unidad Económica Interesada (UEI)." />

                    <div class="card-body">
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
                                        value="{{ $empresa->nombre }}" disabled>

                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Correo Electrónico <span
                                            class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="ejemplo@empresa.com" value="{{ $empresa->email }}" disabled>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-8 mb-3">
                                    <label for="direccion" class="form-label">Dirección de la sede principal <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="direccion"
                                        placeholder="Calle, número, ciudad, provincia, país" name="direccion"
                                        value="{{ $empresa->direccion }}" disabled>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="telefono" class="form-label">Teléfono de contacto <span
                                            class="text-danger">*</span></label>
                                    <input type="telefono" class="form-control" id="telefono" name="telefono"
                                        placeholder="Ingrese el numero de contacto" tipo-data="number"
                                        value="{{ $empresa->telefono }}" disabled>
                                </div>

                            </div>
                        </div>

                        <!-- Direcciones de Carrera -->
                        <!-- Direcciones de Carrera -->
                        <!-- Direcciones de Carrera -->
                        <!-- Direcciones de Carrera -->
                        <!-- Direcciones de Carrera -->
                        <div class="mb-4 p-3">
                            <h5 class="section-title">Direcciones de Carrera <span class="text-danger">*</span></h5>
                            <div class="dropdown-divider mb-4"></div>

                            <div class="form-group">
                                @if ($empresa->direcciones->count() > 0)
                                    <ul class="list-group">
                                        @foreach ($empresa->direcciones as $direccion)
                                            <li class="list-group-item">{{ $direccion->name }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <div class="alert alert-warning">No se han seleccionado direcciones de carrera</div>
                                @endif
                            </div>
                        </div>
                        <!-- Vigencia del Convenio -->
                        <div class="mb-4 p-3">
                            <h5 class="section-title">Vigencia del Convenio</h5>

                            <div class="dropdown-divider mb-4"></div>

                            <div class="row">
                                <!-- Fecha de Inicio -->
                                <div class="col-md-6 mb-3">
                                    <label for="inicio_conv" class="form-label">Fecha de Inicio <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        <input type="date" class="form-control" name="inicio_conv" id="inicio_conv"
                                            value="{{ $empresa->inicio_conv }}" disabled>
                                    </div>
                                </div>

                                <!-- Fecha de Finalización -->
                                <div class="col-md-6 mb-3">
                                    <label for="fin_conv" class="form-label">Fecha de Finalización <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        <input type="date" class="form-control" name="fin_conv" id="fin_conv"
                                            value="{{ $empresa->fin_conv }}" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Documentos del Convenio -->
                        <div class="mb-4 p-3">
                            <h5 class="section-title">Documentos del Convenio</h5>
                            <div class="dropdown-divider mb-4"></div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="convenioA" class="form-label">Convenio Academico <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <a href="{{ url(Storage::url($empresa->convenioA)) }}" class="btn btn-primary"
                                            target="_blank">Ver
                                            Documento
                                            <span class="mdi mdi-file-pdf-box"></span>
                                        </a>
                                    </div>
                                    @error('convenioA')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="convenioMA" class="form-label">Convenio Marco-Empresa <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <a href="{{ url(Storage::url($empresa->convenioMA)) }}" class="btn btn-primary"
                                            target="_blank">Ver
                                            Convenio Marco-Empresa
                                            <span class="mdi mdi-file-pdf-box"></span>
                                        </a>
                                    </div>
                                    @error('convenioMA')
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
                    </div>
                </div>
            </div>
        </div>

    @endsection
