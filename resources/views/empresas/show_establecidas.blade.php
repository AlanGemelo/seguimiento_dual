@extends('layouts.app')
@section('title', 'Mostrar UE')

@section('content')
<link rel="stylesheet" href="{{ asset('css/listas.css') }}">

    <body class="body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow">
                   <x-forms.section-header title="Datos de la Unidad Económica"
                        description="Visualización de la información de la Unidad Económica (UE)." />

                    <div class="card-body">
                        <!-- Información Básica -->
                        <div class="mb-4">
                            <h5 class="section-title fw-bold">Información Básica</h5>
                            <small class="text-muted text-stone-950">(Datos principales)</small>
                            <div class="dropdown-divider mb-4"></div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nombre" class="form-label">Nombre de la empresa </label>
                                    <input type="text" class="form-control" id="nombre"
                                        placeholder="Razón social o nombre legal de la empresa" name="nombre"
                                        value="{{ $empresa->nombre }}" disabled>
                                    @error('nombre')
                                        <div class="text-danger invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="razon_social" class="form-label">Razón Social </label>
                                    <input type="text" class="form-control  " name="razon_social" id="razon_social"
                                        value="{{ $empresa->razon_social }}" disabled>
                                    @error('razon_social')
                                        <div class="text-danger invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="actividad_economica">Unidad Económica</label>
                                    <input type="text" class="form-control  " name="actividad_economica"
                                        id="actividad_economica" value="{{ $empresa->actividad_economica }}" disabled>
                                    @error('actividad_economica')
                                        <div class="text-danger invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="" class="form-label">Actividad Económica</label>
                                    <input type="text" class="form-control  " name="unidad_economica"
                                        id="unidad_economica"
                                        value="{{ old('unidad_economica', $empresa->unidad_economica) }}" disabled>
                                    @error('unidad_economica')
                                        <div class="text-danger invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="tamano_ue" class="form-label">Tamaño de la UE</label>
                                    <input type="text" name="tamano_ue" id="tamano_ue" class="form-control  "
                                        value="{{ old('tamano_ue', $empresa->tamano_ue) }}" disabled>
                                    @error('tamano_ue')
                                        <div class="text-danger invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="folio" class="form-label">Folio</label>
                                    <input type="text" name="folio" id="folio" class="form-control  "
                                        value="{{ old('folio', $empresa->folio) }}" disabled>
                                    @error('folio')
                                        <div class="text-danger invalid-feedback d-block">{{ $message }}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="direccion" class="form-label">Dirección de la sede principal </label>
                                    <input type="text" class="form-control  " id="direccion" name="direccion"
                                        value="{{ old('direccion', $empresa->direccion) }}" disabled>
                                    @error('direccion')
                                        <div class="text-danger invalid-feedback d-block">{{ $messege }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="fecha_registro" class="form-label">Fecha de registro </label>
                                    <input type="date" class="form-control  " id="fecha_registro" name="fecha_registro"
                                        value="{{ old('fecha_registro', $empresa->fecha_registro) }}" disabled>
                                    @error('fecha_registro')
                                        <div class="text-danger invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Motivo de baja (si aplica) --}}
                        @if ($empresa->STATUS === 2)
                            <div class="mb-5 p-4 rounded shadow-lg"
                                style="  border: 2px solid #004D40; background-color: #F5F5F5; box-shadow: 0 4px 8px rgba(0, 77, 64, 0.15); ">
                                <h3 class="section-title fw-bold text-center mb-4"
                                    style="color: #006837;font-size: 1.75rem;text-transform: uppercase;letter-spacing: 1.5px;">
                                    ¡Proceso de Baja!
                                </h3>

                                <hr style="border-color: #2E2E2E; border-width: 2px; margin-bottom: 2rem;">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="fecha_baja" class="form-label fw-semibold"
                                                style="color: #2E2E2E;">Fecha
                                                de Baja</label>
                                            <input type="text" name="fecha_baja" id="fecha_baja" class="form-control"
                                                value="{{ old('fecha_baja', $empresa->fecha_baja) }}" disabled>
                                        </div>

                                        <div class="mb-3">
                                            <label for="comentarios_baja" class="form-label fw-semibold"
                                                style="color: #2E2E2E;">Comentarios</label>
                                            <textarea name="comentarios_baja" id="comentarios_baja" class="form-control lh-sm  " rows="6" disabled
                                                style="min-height: 10rem;">{{ old('comentarios_baja', $empresa->comentarios_baja) }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="motivo_baja" class="form-label fw-semibold"
                                                style="color: #2E2E2E;">Motivo de Baja</label>
                                            <input type="text" name="motivo_baja" id="motivo_baja"
                                                class="form-control"
                                                value="{{ old('motivo_baja', $empresa->motivo_baja) }}" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- Datos de Contacto --}}
                        <div class="row mb-4">
                            <h5 class="section-title fw-bold">Datos de Contacto </h5>
                            <small class="text-muted text-stone-950">(Comunicación directa)</small>
                            <div class="dropdown-divider mb-4"></div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Correo Electrónico <span
                                        class="text-danger">*</span></label>
                                <input type="email" class="form-control  " id="email" name="email"
                                    value="{{ old('email', $empresa->email) }}" disabled>
                                @error('email')
                                    <div class="text-danger invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="telefono" class="form-label">Teléfono de contacto <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control  " id="telefono" name="telefono"
                                    value="{{ old('telefono', $empresa->telefono) }}" disabled maxlength="10">
                                @error('telefono')
                                    <div class="text-danger invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Representante Legal  -->
                        <div class="row mb-4">
                            <h5 class="section-title fw-bold">Representante Legal <span class="text-danger">*</span>
                            </h5>
                            <small class="text-muted text-stone-950">
                                (Responsable del convenio)
                            </small>
                            <div class="dropdown-divider mb-4"></div>

                            <div class="col-md-6 mb-3">
                                <label for="nombre_representante" class="form-label">Nombre del Representante <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="nombre_representante" id="nombre_representante"
                                    class="form-control"
                                    value="{{ old('nombre_representante', $empresa->nombre_representante) }}" disabled>
                                @error('nombre_representante')
                                    <div class="text-danger invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="cargo_representante" class="form-label">Cargo del Representante <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="cargo_representante" id="cargo_representante"
                                    class="form-control  "
                                    value="{{ old('cargo_representante', $empresa->cargo_representante) }}" disabled>
                            </div>
                        </div>

                        {{--  Vinculación Académica --}}
                        <div class="row">
                            <h5 class="section-title fw-bold">Vinculación Académica <span class="text-danger">*</span>
                            </h5>
                            <small class="text-muted text-stone-950">
                                (Relación con la universidad)
                            </small>
                            <div class="dropdown-divider mb-1"></div>
                            <div class=" p-3">
                                <div class="form-group">
                                    <label for="direcciones_ids" class="form-label">Direcciones de Carrera </label>
                                    @if ($empresa->direcciones->count() > 0)
                                        <ul class="list-group">
                                            @foreach ($empresa->direcciones as $direccion)
                                                <li class="list-group-item">{{ $direccion->name }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <div class="alert alert-warning">No se han seleccionado direcciones de carrera
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>

                        <!-- Vigencia del Convenio -->
                        <div class="mb-4 p-3">
                            <h5 class="section-title fw-bold">Vigencia del Convenio</h5>

                            <div class="dropdown-divider mb-4"></div>
                            <div class="row">
                                <!-- Fecha de Inicio -->
                                <div class="col-md-4 mb-3">
                                    <label for="inicio_conv" class="form-label">Fecha de Inicio </label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        <input type="date" class="form-control" name="inicio_conv" id="inicio_conv"
                                            value="{{ old('inicio_conv', $empresa->inicio_conv) }}" disabled>
                                    </div>
                                    @error('inicio_conv')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3 ">
                                    <label for="anos_conv" class="form-label">Años de convenio <span
                                            class="text-danger ">*</span></label>
                                    <div class="input-group">
                                        <input type="number" data-tipo="numbers" name="anos_conv" id="anos_conv"
                                            class=" form-control" readonly>
                                    </div>
                                </div>

                                <!-- Fecha de Finalización -->
                                <div class="col-md-4 mb-3">
                                    <label for="fin_conv" class="form-label">Fecha de Finalización </label>
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

                            <div class="row justify-content-start">
                                <!-- Convenio Académico -->
                                <div class="col-sm-6 col-md-5 col-lg-4 mb-3">
                                    <label for="convenioA" class="form-label">Convenio Académico <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        @if ($empresa->convenioA)
                                            <a href="{{ url(Storage::url($empresa->convenioA)) }}"
                                                class="btn btn-primary flex-grow-1" target="_blank">
                                                Ver Convenio Académico <span class="mdi mdi-file-pdf-box"></span>
                                            </a>
                                        @else
                                            <span class="text-muted">No hay documento cargado</span>
                                        @endif
                                    </div>
                                    @error('convenioA')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Convenio Marco -->
                                <div class="col-sm-6 col-md-5 col-lg-4 mb-3">
                                    <label for="convenioMA" class="form-label">Convenio Marco-Empresa <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <a href="{{ url(Storage::url($empresa->convenioMA)) }}"
                                            class="btn btn-primary flex-grow-1" target="_blank">
                                            Ver Convenio Marco-Empresa <span class="mdi mdi-file-pdf-box"></span>
                                        </a>
                                    </div>
                                    @error('convenioMA')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- DOCUMENTOS ADICIONALES AL FINAL -->
                            <div class="row mt-4">
                                <div class="col-sm-12 col-md-6 col-lg-5">
                                    <h6 class="section-title fst-normal">Documentación Adicional</h6>
                                    <div class="dropdown-divider mb-3"></div>

                                    <!-- INE -->
                                    <div class="mb-2">
                                        <label for="ine" class="form-label">INE</label>
                                        <div class="d-flex justify-content-between align-items-center gap-2 mt-1">
                                            <input type="file" accept="application/pdf" class="form-control d-none"
                                                id="ine" name="ine">
                                            @if ($empresa->ine)
                                                <a href="{{ url(Storage::url($empresa->ine)) }}"
                                                    class="btn btn-primary flex-grow-1" target="_blank">
                                                    Ver INE <span class="mdi mdi-file-pdf-box"></span>
                                                </a>
                                            @else
                                                <span class="text-muted">No hay documento cargado</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Botones de Acción -->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <x-buttons.back-button url="{{ route('empresas.index') }}" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const inicioInput = document.getElementById('inicio_conv');
                const finInput = document.getElementById('fin_conv');
                const anosInput = document.getElementById('anos_conv');

                function calcularAnios() {
                    const inicio = new Date(inicioInput.value);
                    const fin = new Date(finInput.value);

                    if (!isNaN(inicio.getTime()) && !isNaN(fin.getTime())) {
                        let anos = fin.getFullYear() - inicio.getFullYear();

                        // Verifica si el mes/día del fin es anterior al de inicio
                        if (
                            fin.getMonth() < inicio.getMonth() ||
                            (fin.getMonth() === inicio.getMonth() && fin.getDate() < inicio.getDate())
                        ) {
                            anos--;
                        }

                        anosInput.value = anos >= 0 ? anos : 0;
                    } else {
                        anosInput.value = '';
                    }
                }

                // Ejecutar cálculo cuando cambien las fechas
                inicioInput.addEventListener('change', calcularAnios);
                finInput.addEventListener('change', calcularAnios);

                // Si ya hay valores precargados (edición), calcular al cargar
                if (inicioInput.value && finInput.value) {
                    calcularAnios();
                }
            });
        </script>
    @endsection
        </body>