@extends('layouts.app')
@section('title', 'Editar Empresa')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <x-forms.section-header title="Actualización de la Unidad Económica"
                    description="Formulario para modificar la Unidad Económica que colabora con la Universidad mediante el Modelo de Formación Dual, indicando las carreras con las que desean establecer vínculo académico." />

                <div class="card-body">
                    <form class="pt-3" action="{{ route('empresas.update', $empresa->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <!-- Información Básica -->
                        <div class="mb-4">
                            <h5 class="section-title fw-bold">Información Básica</h5>
                            <small class="text-muted text-stone-950">(Datos principales)</small>
                            <div class="dropdown-divider mb-4"></div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nombre" class="form-label">Nombre de la empresa <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nombre"
                                        placeholder="Razón social o nombre legal de la empresa" name="nombre"
                                        value="{{ old('nombre', $empresa->nombre) }}" required>
                                    @error('nombre')
                                        <div class="text-danger invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="razon_social" class="form-label">Razón Social <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control  " name="razon_social" id="razon_social"
                                        value="{{ old('razon_social', $empresa->razon_social) }}">
                                    @error('razon_social')
                                        <div class="text-danger invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="actividad_economica">Unidad Económica</label>
                                    <input type="text" class="form-control  " name="actividad_economica"
                                        id="actividad_economica"
                                        value="{{ old('actividad_Economica', $empresa->actividad_economica) }}">
                                    @error('actividad_economica')
                                        <div class="text-danger invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="" class="form-label">Actividad Económica</label>
                                    <input type="text" class="form-control  " name="unidad_economica"
                                        id="unidad_economica"
                                        value="{{ old('unidad_economica', $empresa->unidad_economica) }}">
                                    @error('unidad_economica')
                                        <div class="text-danger invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="tamano_ue" class="form-label">Tamaño de la UE</label>
                                    <select name="tamano_ue" id="tamano_ue" class="form-control" required>
                                        <option value="" disabled>
                                            Seleccione el tamaño de la unidad económica
                                        </option>
                                        @foreach ($tamano_eu['tamanos'] as $tamano)
                                            <option value="{{ $tamano['id'] }}"
                                                {{ old('tamano_ue', $empresa->tamano_ue ?? '') == $tamano['id'] ? 'selected' : '' }}>
                                                {{ $tamano['tamano_eu'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="folio" class="form-label">Folio</label>
                                    <input type="text" name="folio" id="folio" class="form-control  "
                                        value="{{ old('folio', $empresa->folio) }}">
                                    @error('folio')
                                        <div class="text-danger invalid-feedback d-block">{{ $message }}}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="direccion" class="form-label">Dirección de la sede principal </label>
                                    <input type="text" class="form-control  " id="direccion" name="direccion"
                                        value="{{ old('direccion', $empresa->direccion) }}">
                                    @error('direccion')
                                        <div class="text-danger invalid-feedback d-block">{{ $messege }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="fecha_registro" class="form-label">Fecha de registro </label>
                                    <input type="date" class="form-control  " id="fecha_registro" name="fecha_registro"
                                        value="{{ old('fecha_registro', $empresa->fecha_registro) }}">
                                    @error('fecha_registro')
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

                            <div class="col-md-5 mb-3">
                                <label for="email" class="form-label">Correo Electrónico <span
                                        class="text-danger">*</span></label>
                                <input type="email" class="form-control  " id="email" name="email"
                                    value="{{ old('email', $empresa->email) }}" required>
                                @error('email')
                                    <div class="text-danger invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Extensión -->
                            <div class="col-md-2 mb-3" style="max-width: 10%">

                                <label for="ext_telefonica" class="form-label">Ext.<small
                                        class="text-muted">(Opcional)</small>
                                </label>
                                <input type="text" class="form-control" id="ext_telefonica" name="ext_telefonica"
                                    placeholder="Ext." value="{{ old('telefono', $empresa->ext_telefonica) }}">
                                @error('ext_telefonica')
                                    <div class="text-danger invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-5 mb-3">
                                <label for="telefono" class="form-label">Teléfono de contacto <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control  " id="telefono" name="telefono"
                                    value="{{ old('telefono', $empresa->telefono) }}" required maxlength="10">
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
                                    value="{{ old('nombre_representante', $empresa->nombre_representante) }}">
                                @error('nombre_representante')
                                    <div class="text-danger invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="cargo_representante" class="form-label">Cargo del Representante <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="cargo_representante" id="cargo_representante"
                                    class="form-control  "
                                    value="{{ old('cargo_representante', $empresa->cargo_representante) }}">
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
                                    <label for="direcciones_ids" class="form-label">Direcciones de Carrera <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" size="8" id="direcciones_ids"
                                        name="direcciones_ids[]" multiple aria-label="Seleccionar Direcciones de Carrera"
                                        size="5">
                                        @foreach ($direcciones as $direccion)
                                            <option value="{{ $direccion->id }}"
                                                @if (
                                                    (is_array(old('direcciones_ids')) && in_array($direccion->id, old('direcciones_ids'))) ||
                                                        (!old() && session('direccion')->id == $direccion->id)) selected @endif>
                                                {{ $direccion->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <small class="form-text text-muted">
                                        Mantén presionada la tecla Ctrl (Windows) o Command (Mac) para seleccionar
                                        múltiples
                                        opciones
                                    </small>
                                    @error('direcciones_ids')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Documentos del Convenio -->
                        <div class="mb-4 p-3">
                            <h5 class="section-title fw-bold">Documentos del Convenio</h5>
                            <div class="dropdown-divider mb-4"></div>

                            <div class="row">
                                <!-- CONVENIO ESPECÍFICO -->
                                <div class="card mb-4 shadow-sm border-0">
                                    <div class="card-header text-black">
                                        <i class="mdi mdi-file-document-outline me-2"></i>
                                        Convenio Específico
                                    </div>

                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <label class="form-label fw-semibold d-block">Tipo de vigencia</label>
                                                <div class="form-check form-switch d-inline-flex align-items-center ps-2"
                                                    style="margin-left: 5vh">
                                                    <input class="form-check-input me-2" type="checkbox"
                                                        id="indefinido_especifico" name="indefinido_especifico"
                                                        {{ optional($convenioEspecifico)->vigencia === 'INDEFINIDO' ? 'checked' : '' }} />
                                                    <label class="form-check-label fw-semibold"
                                                        for="indefinido_especifico">Indefinido</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3" id="vigenciaDetalle">
                                            <div class="col-md-4">
                                                <label class="form-label fw-semibold">Fecha de inicio</label>
                                                <input type="date" class="form-control" name="inicio_especifico"
                                                    value="{{ old('inicio_especifico', optional($convenioEspecifico)->inicio) }}" />
                                            </div>

                                            <div class="col-md-2" id="anosWrapper">
                                                <label class="form-label fw-semibold">Años de vigencia</label>
                                                <input type="number" class="form-control" name="anos_especifico"
                                                    value="{{ old(
                                                        'anos_especifico',
                                                        optional($convenioEspecifico)->inicio && optional($convenioEspecifico)->fin
                                                            ? \Carbon\Carbon::parse($convenioEspecifico->inicio)->diffInYears($convenioEspecifico->fin)
                                                            : '',
                                                    ) }}" />
                                            </div>

                                            <div class="col-md-4" id="finWrapper">
                                                <label class="form-label fw-semibold">Fecha de fin</label>
                                                <input type="date" class="form-control" name="fin_especifico"
                                                    value="{{ old('fin_especifico', optional($convenioEspecifico)->fin) }}" />
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-1">
                                            <label for="archivo_especifico">Subir convenio <span>*</span></label>
                                            <div class="d-flex justify-content-between align-items-center gap-2 mt-1">
                                                <input type="file" accept="application/pdf"
                                                    class="form-control d-none" id="inputEspecifico"
                                                    name="archivo_especifico" />

                                                @if ($convenioEspecifico?->archivo)
                                                    <a href="{{ asset('storage/' . $convenioEspecifico->archivo) }}"
                                                        target="_blank" class="btn btn-primary flex-grow-1"
                                                        id="linkEspecifico">
                                                        Ver documento
                                                        <span class="mdi mdi-file-pdf-box"></span>
                                                    </a>
                                                @else
                                                    <span class="text-muted flex-grow-1" id="textNoEspecifico">Sin archivo
                                                        cargado</span>
                                                @endif

                                                <button type="button" class="btn btn-secondary"
                                                    id="btnCambiarEspecifico"
                                                    onclick="mostrarInput('inputEspecifico','btnCambiarEspecifico','linkEspecifico','textNoEspecifico')">
                                                    Cambiar Documento
                                                </button>

                                                <button type="button" class="btn btn-danger d-none"
                                                    id="btnCancelarEspecifico"
                                                    onclick="cancelarCambio('inputEspecifico','btnCambiarEspecifico','linkEspecifico','btnCancelarEspecifico','textNoEspecifico')">
                                                    Cancelar
                                                </button>
                                            </div>
                                            @error('archivo_especifico')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- CONVENIO MARCO -->
                                <div class="card mb-4 shadow-sm border-0">
                                    <div class="card-header text-black">
                                        <i class="mdi mdi-file-document-outline me-2"></i>
                                        Convenio Marco
                                    </div>

                                    <div class="card-body">
                                        <!-- Vigencia -->
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <label class="form-label fw-semibold d-block">Tipo de vigencia</label>
                                                <div class="form-check form-switch d-inline-flex align-items-center ps-2"
                                                    style="margin-left: 5vh">
                                                    <input class="form-check-input me-2" type="checkbox"
                                                        id="indefinido_marco" name="indefinido_marco"
                                                        @checked($convenioMarco?->vigencia === 'INDEFINIDO') />
                                                    <label class="form-check-label fw-semibold"
                                                        for="indefinido_marco">Indefinido</label>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Fechas -->
                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <label class="form-label fw-semibold">Fecha de inicio</label>
                                                <input type="date" class="form-control" name="inicio_marco"
                                                    value="{{ old('inicio_marco', $convenioMarco?->inicio) }}" />
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label fw-semibold">Años de vigencia</label>
                                                <input type="number" class="form-control" name="anos_marco"
                                                    value="{{ old(
                                                        'anos_marco',
                                                        $convenioMarco?->inicio && $convenioMarco?->fin
                                                            ? \Carbon\Carbon::parse($convenioMarco->inicio)->diffInYears($convenioMarco->fin)
                                                            : '',
                                                    ) }}"
                                                    min="0" max="999" />
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label fw-semibold">Fecha de fin</label>
                                                <input type="date" class="form-control" name="fin_marco"
                                                    value="{{ old('fin_marco', $convenioMarco?->fin) }}" />
                                            </div>
                                        </div>

                                        <!-- Archivo -->
                                        <div class="col-md-6 mb-1">
                                            <label for="archivo_marco">Subir convenio <span>*</span></label>
                                            <div class="d-flex justify-content-between align-items-center gap-2 mt-1">
                                                <input type="file" accept="application/pdf"
                                                    class="form-control d-none" id="inputMarco" name="archivo_marco" />

                                                @if ($convenioMarco?->archivo)
                                                    <a href="{{ asset('storage/' . $convenioMarco->archivo) }}"
                                                        target="_blank" class="btn btn-primary flex-grow-1"
                                                        id="linkMarco">
                                                        Ver documento
                                                        <span class="mdi mdi-file-pdf-box"></span>
                                                    </a>
                                                @else
                                                    <span class="text-muted flex-grow-1" id="textNoMarco">Sin archivo
                                                        cargado</span>
                                                @endif

                                                <button type="button" class="btn btn-secondary" id="btnCambiarMarco"
                                                    onclick="mostrarInput('inputMarco','btnCambiarMarco','linkMarco','textNoMarco')">
                                                    Cambiar Documento
                                                </button>

                                                <button type="button" class="btn btn-danger d-none"
                                                    id="btnCancelarMarco"
                                                    onclick="cancelarCambio('inputMarco','btnCambiarMarco','linkMarco','btnCancelarMarco','textNoMarco')">
                                                    Cancelar
                                                </button>
                                            </div>
                                            @error('archivo_marco')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <h6 class="section-title fst-normal">Documentación Adicional</h6>
                                <div class="dropdown-divider mb-4"></div>
                                <div class="col-md-6 mb-1">
                                    <label for="ine" class="form-label">INE <span
                                            class="text-danger">*</span></label>
                                    <div class="d-flex justify-content-between align-items-center gap-2 mt-1">
                                        <input type="file" accept="application/pdf, image/jpeg, image/png"
                                            class="form-control d-none" id="inputIne" name="ine">

                                        @if ($empresa->ine)
                                            <a href="{{ url(Storage::url($empresa->ine)) }}"
                                                class="btn btn-primary flex-grow-1" target="_blank" id="linkIne">
                                                Ver INE <span class="mdi mdi-file-pdf-box"></span>
                                            </a>
                                        @else
                                            <span class="text-muted" id="textNoIne">No hay documento cargado</span>
                                        @endif

                                        <button type="button" class="btn btn-secondary" id="btnCambiarIne"
                                            onclick="mostrarInput('inputIne', 'btnCambiarIne', 'linkIne', 'textNoIne')">
                                            Cambiar Documento
                                        </button>
                                        <button type="button" class="btn btn-danger d-none" id="btnCancelarIne"
                                            onclick="cancelarCambio('inputIne', 'btnCambiarIne', 'linkIne', 'btnCancelarIne', 'textNoIne')">
                                            Cancelar
                                        </button>
                                    </div>
                                    @error('ine')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- Botones de Acción -->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <x-buttons.cancel-button url="{{ route('empresas.index') }}" />
                            <button type="submit" class="btn" style="background-color: #006837; color: white;">
                                <i class="fas fa-save me-1"></i> Actualizar Empresa
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const input = document.getElementById('fecha_registro');

            if (!input.value) {
                const hoy = new Date().toISOString().split('T')[0];
                input.value = hoy;
            }
            // --- Convenio Específico ---
            const inicioEspecifico = document.querySelector('[name="inicio_especifico"]');
            const finEspecifico = document.querySelector('[name="fin_especifico"]');
            const anosEspecifico = document.querySelector('[name="anos_especifico"]');

            // --- Convenio Marco ---
            const inicioMarco = document.querySelector('[name="inicio_marco"]');
            const finMarco = document.querySelector('[name="fin_marco"]');
            const anosMarco = document.querySelector('[name="anos_marco"]');

            // Inicializar fecha de inicio con hoy si está vacío
            function inicializarHoy(input) {
                if (input && !input.value) {
                    const hoy = new Date().toISOString().split('T')[0];
                    input.value = hoy;
                }
            }
            inicializarHoy(inicioEspecifico);
            inicializarHoy(inicioMarco);

            // Calcular años a partir de inicio y fin
            function calcularAnios(inicioInput, finInput, anosInput) {
                const inicio = new Date(inicioInput.value);
                const fin = new Date(finInput.value);

                if (!isNaN(inicio.getTime()) && !isNaN(fin.getTime())) {
                    let anos = fin.getFullYear() - inicio.getFullYear();

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

            // Calcular fecha fin a partir de inicio y años
            function calcularFinDesdeAnios(inicioInput, finInput, anosInput) {
                const inicio = new Date(inicioInput.value);
                const anos = parseInt(anosInput.value);

                if (!isNaN(inicio.getTime()) && !isNaN(anos)) {
                    const fin = new Date(inicio);
                    fin.setFullYear(fin.getFullYear() + anos);
                    finInput.value = fin.toISOString().split('T')[0];
                }
            }

            // Eventos para específico
            inicioEspecifico.addEventListener('change', () => calcularAnios(inicioEspecifico, finEspecifico,
                anosEspecifico));
            finEspecifico.addEventListener('change', () => calcularAnios(inicioEspecifico, finEspecifico,
                anosEspecifico));
            anosEspecifico.addEventListener('input', () => calcularFinDesdeAnios(inicioEspecifico, finEspecifico,
                anosEspecifico));

            if (inicioEspecifico.value && finEspecifico.value) {
                calcularAnios(inicioEspecifico, finEspecifico, anosEspecifico);
            }

            // Eventos para marco
            inicioMarco.addEventListener('change', () => calcularAnios(inicioMarco, finMarco, anosMarco));
            finMarco.addEventListener('change', () => calcularAnios(inicioMarco, finMarco, anosMarco));
            anosMarco.addEventListener('input', () => calcularFinDesdeAnios(inicioMarco, finMarco, anosMarco));

            if (inicioMarco.value && finMarco.value) {
                calcularAnios(inicioMarco, finMarco, anosMarco);
            }
        });

        // --- Funciones para botones de documentos ---
        function ocultar(id, id2, text) {
            const elemento = document.getElementById(id);
            elemento.hidden = !elemento.hidden;
            document.getElementById(text).textContent = elemento.hidden ? 'Ver Documento' : 'Cambiar Documento';
            if (!elemento.hidden) {
                document.getElementById(id2).value = '';
            }
            const elemento1 = document.getElementById(id2);
            elemento1.hidden = !elemento1.hidden;
        }

        function mostrarInput(inputId, btnId, linkId, textId) {
            const fileInput = document.getElementById(inputId);
            const cambiarBtn = document.getElementById(btnId);
            const verLink = linkId ? document.getElementById(linkId) : null;
            const textNoDoc = textId ? document.getElementById(textId) : null;
            const cancelarBtn = document.getElementById('btnCancelar' + inputId.replace('input', ''));

            fileInput.classList.remove('d-none');
            cancelarBtn.classList.remove('d-none');

            cambiarBtn.classList.add('d-none');
            if (verLink) verLink.classList.add('d-none');
            if (textNoDoc) textNoDoc.classList.add('d-none');
        }

        function cancelarCambio(inputId, btnId, linkId, cancelBtnId, textId) {
            const fileInput = document.getElementById(inputId);
            const cambiarBtn = document.getElementById(btnId);
            const verLink = linkId ? document.getElementById(linkId) : null;
            const cancelarBtn = document.getElementById(cancelBtnId);
            const textNoDoc = textId ? document.getElementById(textId) : null;

            fileInput.classList.add('d-none');
            cancelarBtn.classList.add('d-none');

            cambiarBtn.classList.remove('d-none');
            if (verLink) verLink.classList.remove('d-none');
            if (textNoDoc && !verLink) textNoDoc.classList.remove('d-none');

            fileInput.value = '';
        }
    </script>


@endsection
