@extends('layouts.app')

@section('title', 'Baja UE')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow">
                    <!-- Encabezado -->
                    <x-section-header title="Baja de Unidad Económica"
                        description="Proceso formal para dar de baja a unidades económicas participantes en el 
                        Modelo de Formación Dual,registrando información de contacto, detalles del 
                        convenio y motivos de la baja." />
                    <div class="card-body">
                        <!-- Información General -->
                        <form class="pt-3" action="{{ route('empresas.suspend', $empresa->id) }}" method="post">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <h5 class="section-title fw-bold ">Información Básica</h5>
                                <div class="dropdown-divider mb-4"></div>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="nombre" class="form-label">Nombre de la empresa </label>
                                        <input type="text" class="form-control form-control-lg" id="nombre"
                                            placeholder="" name="nombre" value="{{ $empresa->nombre }}" disabled>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="email" class="form-label">Correo Electrónico </label>
                                        <input type="text" class="form-control form-control-lg" id="email"
                                            placeholder="" name="email" value="{{ $empresa->email }}" disabled>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="name" class="form-label">Teléfono <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-lg" id="telefono"
                                                placeholder="" name="telefono" value="{{ $empresa->telefono }}" disabled>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="apellidoP" class="form-label">Dirección de la sede principal <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-lg" id="direccion"
                                                name="direccion" value="{{ $empresa->direccion }}" disabled>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <h5 class="section-title fw-bold mt-3 ">Representante Legal </h5>
                                        <div class="dropdown-divider mb-4"></div>

                                        <div class="col-md-6 mb-3">
                                            <label for="direccion_id" class="form-label">Nombre del Representante </label>
                                            <input type="text" class="form-control form-control-lg" id="direccion_id"
                                                name="direccion_id" value="{{ $empresa->nombre_representante }}" disabled>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="carrera_id" class="form-label">Cargo del Representante </label>
                                            <input type="text" class="form-control form-control-lg" id="carrera_id"
                                                name="carrera_id" value="{{ $empresa->cargo_representante }}" disabled>
                                        </div>


                                    </div>

                                    <div class="row">
                                        <h5 class="section-title fw-bold  mt-4">Datos del Convenio </h5>
                                        <div class="dropdown-divider mb-4"></div>

                                        <div class="col-md-6 mb-3">
                                            <label for="empresa_id" class="form-label">Fecha de Inicio de Convenio </label>
                                            <div id="datepicker-popup"
                                                class="input-group date datepicker navbar-date-picker">
                                                <span class="input-group-addon input-group-prepend border-right">
                                                    <span class="icon-calendar input-group-text calendar-icon"></span>
                                                </span>
                                                <input type="text" class="form-control" name="inicio_conv"
                                                    id="inicio_conv" value="{{ $empresa->inicio_conv }}" disabled>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="asesorin_id" class="form-label">Fecha de Fin de Convenio </label>
                                            <div id="datepicker-popup"
                                                class="input-group date datepicker navbar-date-picker">
                                                <span class="input-group-addon input-group-prepend border-right">
                                                    <span class="icon-calendar input-group-text calendar-icon"></span>
                                                </span>
                                                <input type="date" class="form-control" name="fin_conv" id="fin_conv"
                                                    value="{{ $empresa->fin_conv }}" disabled>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="row">
                                        <h5 class="section-title fw-bold mt-4">Motivo y Proceso de Baja </h5>
                                        <div class="dropdown-divider mb-4"></div>

                                        <div class="col-md-6 mb-3">
                                            <label for="motivo_baja" class="form-label">Motivo de Baja <span
                                                    class="text-danger">*</span></label>
                                            <select name="motivo_baja" id="motivo_baja"
                                                class="form-control form-control-lg" required>
                                                @foreach ($suspensionReasons as $reason)
                                                    <option value="{{ $reason }}">{{ $reason }}</option>
                                                @endforeach
                                            </select>
                                            @error('motivo_baja')
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror


                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="fecha_baja" class="form-label">Fecha de Baja <span
                                                    class="text-danger">*</span></label>
                                            <input type="date" name="fecha_baja" id="fecha_baja"
                                                class="form-control form-control-lg" value="{{ date('Y-m-d') }}"
                                                required>
                                            @error('fecha_baja')
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror

                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="comentarios" class="form-label">
                                                Comentarios/Detalles <span class="text-danger">(Opcional)</span>
                                            </label>
                                            <textarea name="comentarios" id="comentarios" class="form-control" rows="4"
                                                placeholder="Escribe aquí los comentarios o detalles..." style="min-height: 10rem"></textarea>
                                            @error('comentarios')
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>


                                    </div>

                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                        <button type="submit" class="btn"
                                            style="background-color: #006837; color: white;">
                                            <i class="fas fa-save me-1"></i> Iniciar Baja
                                        </button>
                                        <x-cancel-button url="{{ route('empresas.index') }}" />
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
