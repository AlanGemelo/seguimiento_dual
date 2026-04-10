@extends('layouts.app')

@section('title', 'Baja UE')

@section('content')

    <body class="body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow">
                    <!-- Encabezado -->
                    <x-forms.section-header title="Datos de la Unidad Económica dada de baja"
                        description="Visualización de la información de la Unidad Económica dada de baja." />

                    <div class="card-body">
                        <!-- Información General -->
                        <form class="pt-3"
                            action="{{ route('empresas.suspend', Vinkla\Hashids\Facades\Hashids::encode($empresa->id)) }}"
                            method="POST">
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

                                        <!-- Documentos del Convenio -->
                                        <div class="mb-4 p-3">
                                            <h5 class="section-title">
                                                Documentos del Convenio
                                            </h5>
                                            <div class="dropdown-divider mb-4"></div>

                                            @if ($empresa->convenios->count() > 0)

                                                @foreach ($empresa->convenios as $conv)
                                                    <div class="card mb-4 shadow-sm border-0">
                                                        <div class="card-header text-black">
                                                            {{ $conv->tipo == 'ESPECIFICO' ? 'Convenio Específico' : 'Convenio Marco' }}
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="row mb-3">

                                                                <!-- VIGENCIA -->
                                                                <div class="col-md-4">
                                                                    <label class="fw-semibold">Tipo de vigencia</label><br>

                                                                    @if ($conv->vigencia === 'INDEFINIDO')
                                                                        <span class="badge bg-success">Indefinido</span>
                                                                    @else
                                                                        <span class="badge bg-primary">Limitado</span>
                                                                    @endif
                                                                </div>

                                                                <!-- INICIO -->
                                                                <div class="col-md-4">
                                                                    <label class="fw-semibold">Fecha de inicio</label><br>
                                                                    <span>{{ $conv->inicio }}</span>
                                                                </div>

                                                                <!-- FIN -->
                                                                <div class="col-md-4">
                                                                    <label class="fw-semibold">Fecha de fin</label><br>
                                                                    <span>{{ $conv->fin ?? 'No aplica' }}</span>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="alert alert-warning">
                                                    No hay convenios registrados para esta empresa.
                                                </div>
                                            @endif
                                        </div>

                                    </div>


                                    <div class="row">
                                        <h5 class="section-title fw-bold mt-4">Motivo y Proceso de Baja </h5>
                                        <div class="dropdown-divider mb-4"></div>

                                        <div class="col-md-6 mb-3">
                                            <label for="motivo_baja" class="form-label">Motivo de Baja <span
                                                    class="text-danger">*</span></label>
                                            <select name="motivo_baja" id="motivo_baja" class="form-control form-control-lg"
                                                required>
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


                                        <x-buttons.cancel-button url="{{ route('empresas.index') }}" />

                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</body>
