@extends ('layouts.app')
@section('title', 'Mostrar UE')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <x-forms.section-header title="Datos de la Unidad Económica"
                    description="Visualización de la información de la Unidad Económica (UE)." />

                <div class="card-body">
                    {{-- Motivo de baja (si aplica) --}}
                    @if ($empresa->STATUS === 2)
                        <div class="card border-0 shadow-sm mb-4" style="background-color: #fff5f5">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h5 class="mb-0 fw-bold text-danger">
                                        <i class="mdi mdi-alert-circle-outline me-2"></i>
                                        Empresa dada de baja
                                    </h5>
                                    <span class="badge bg-danger-subtle text-danger border border-danger">
                                        BAJA
                                    </span>
                                </div>

                                <hr class="border-danger opacity-25" />

                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <label class="fw-semibold text-dark">Fecha de Baja</label>
                                        <input type="text" class="form-control bg-light"
                                            value="{{ $empresa->fecha_baja }}" disabled />
                                    </div>

                                    <div class="col-md-4">
                                        <label class="fw-semibold text-dark">Motivo</label>
                                        <input type="text" class="form-control bg-light"
                                            value="{{ $empresa->motivo_baja }}" disabled />
                                    </div>

                                    <div class="col-md-12 mt-3">
                                        <label class="fw-semibold text-dark">Comentarios</label>
                                        <textarea class="form-control bg-light" rows="4" disabled>{{ $empresa->comentarios_baja ?? 'Sin comentarios' }}
                                         </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <!-- Información Básica -->
                    <div class="mb-4">
                        <h5 class="section-title fw-bold">
                            Información Básica
                        </h5>
                        <small class="text-muted text-stone-950">(Datos principales)</small>
                        <div class="dropdown-divider mb-4"></div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nombre" class="form-label">Nombre de la empresa
                                </label>
                                <input type="text" class="form-control" id="nombre"
                                    placeholder="Razón social o nombre legal de la empresa" name="nombre"
                                    value="{{ $empresa->nombre }}" disabled />

                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="razon_social" class="form-label">Razón Social
                                </label>
                                <input type="text" class="form-control" name="razon_social" id="razon_social"
                                    value="{{ $empresa->razon_social }}" disabled />

                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="actividad_economica">Unidad Económica</label>
                                <input type="text" class="form-control" name="actividad_economica"
                                    id="actividad_economica" value="{{ $empresa->actividad_economica }}" disabled />

                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="" class="form-label">Actividad Económica</label>
                                <input type="text" class="form-control" name="unidad_economica" id="unidad_economica"
                                    value="{{ old('unidad_economica', $empresa->unidad_economica) }}" disabled />

                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="tamano_ue" class="form-label">Tamaño de la UE</label>
                                <input type="text" name="tamano_ue" id="tamano_ue" class="form-control"
                                    value="{{ old('tamano_ue', $empresa->tamano_ue) }}" disabled />

                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="folio" class="form-label">Folio</label>
                                <input type="text" name="folio" id="folio" class="form-control"
                                    value="{{ old('folio', $empresa->folio) }}" disabled />

                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="direccion" class="form-label">Dirección de la sede principal
                                </label>
                                <input type="text" class="form-control" id="direccion" name="direccion"
                                    value="{{ old('direccion', $empresa->direccion) }}" disabled />

                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="fecha_registro" class="form-label">Fecha de registro
                                </label>
                                <input type="date" class="form-control" id="fecha_registro" name="fecha_registro"
                                    value="{{ old('fecha_registro', $empresa->fecha_registro) }}" disabled />

                            </div>
                        </div>
                    </div>

                    {{-- Datos de Contacto --}}
                    <div class="row mb-4">
                        <h5 class="section-title fw-bold">
                            Datos de Contacto
                        </h5>
                        <small class="text-muted text-stone-950">(Comunicación directa)</small>
                        <div class="dropdown-divider mb-4"></div>

                        <!-- Correo -->
                        <div class="col-md-5 mb-3">
                            <label for="email" class="form-label">Correo Electrónico
                                <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ old('email', $empresa->email) }}" disabled />
                        </div>

                        <!-- Extensión -->
                        <div class="col-md-2 mb-3" style="max-width: 10%">
                            <label for="ext_telefonica" class="form-label">Ext.</label>
                            <input type="text" class="form-control" id="ext_telefonica" name="ext_telefonica"
                                placeholder="Ext." value="{{ $empresa->ext_telefonica ?? 'N/A' }}" disabled />
                        </div>

                        <!-- Teléfono -->
                        <div class="col-md-5 mb-3">
                            <label for="telefono" class="form-label">Teléfono de contacto
                                <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="telefono" name="telefono"
                                value="{{ preg_replace('/(\d{3})(\d{3})(\d{4})/', '$1-$2-$3', $empresa->telefono) }}"
                                disabled />
                        </div>
                    </div>
                    <!-- Representante Legal  -->
                    <div class="row mb-4">
                        <h5 class="section-title fw-bold">
                            Representante Legal
                            <span class="text-danger">*</span>
                        </h5>
                        <small class="text-muted text-stone-950">
                            (Responsable del convenio)
                        </small>
                        <div class="dropdown-divider mb-4"></div>

                        <div class="col-md-6 mb-3">
                            <label for="nombre_representante" class="form-label">Nombre del Representante
                                <span class="text-danger">*</span></label>
                            <input type="text" name="nombre_representante" id="nombre_representante"
                                class="form-control"
                                value="{{ old('nombre_representante', $empresa->nombre_representante) }}" disabled />

                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="cargo_representante" class="form-label">Cargo del Representante
                                <span class="text-danger">*</span></label>
                            <input type="text" name="cargo_representante" id="cargo_representante"
                                class="form-control"
                                value="{{ old('cargo_representante', $empresa->cargo_representante) }}" disabled />
                        </div>
                    </div>

                    {{--  Vinculación Académica --}}
                    <div class="row">
                        <h5 class="section-title fw-bold">
                            Vinculación Académica
                            <span class="text-danger">*</span>
                        </h5>
                        <small class="text-muted text-stone-950">
                            (Relación con la universidad)
                        </small>
                        <div class="dropdown-divider mb-1"></div>
                        <div class="p-3">
                            <div class="form-group">
                                <label for="direcciones_ids" class="form-label">Direcciones de Carrera
                                </label>
                                @if ($empresa->direcciones->count() > 0)
                                    <ul class="list-group">
                                        @foreach ($empresa->direcciones as $direccion)
                                            <li class="list-group-item">
                                                {{ $direccion->name }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <div class="alert alert-warning">
                                        No se han seleccionado direcciones
                                        de carrera
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

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

                                        <!-- ARCHIVO -->
                                        <div class="mt-3">
                                            <label class="fw-semibold">Archivo</label><br>

                                            @if ($conv->archivo)
                                                <a href="{{ asset('storage/' . $conv->archivo) }}" target="_blank"
                                                    class="btn btn-sm btn-outline-primary">
                                                    Ver documento
                                                </a>
                                            @else
                                                <span class="text-muted">No disponible</span>
                                            @endif
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

                    <!-- DOCUMENTOS ADICIONALES AL FINAL -->
                    <div class="row mt-4">
                        <div class="col-sm-12 col-md-6 col-lg-5">
                            <h6 class="section-title fst-normal">
                                Documentación Adicional
                            </h6>
                            <div class="dropdown-divider mb-3"></div>

                            <!-- INE -->
                            <div class="mb-2">
                                <label for="ine" class="form-label">INE</label>
                                <div class="d-flex justify-content-between align-items-center gap-2 mt-1">
                                    <input type="file" accept="application/pdf, image/jpeg, image/png"
                                        class="form-control d-none" id="ine" name="ine" />
                                    @if ($empresa->ine)
                                        <a href="{{ url(Storage::url($empresa->ine)) }}"
                                            class="btn btn-primary flex-grow-1" target="_blank">
                                            Ver INE
                                            <span class="mdi mdi-file-pdf-box"></span>
                                        </a>
                                    @else
                                        <span class="text-muted">No hay documento
                                            cargado</span>
                                    @endif
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
@endsection
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
                        (fin.getMonth() === inicio.getMonth() &&
                            fin.getDate() < inicio.getDate())
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
