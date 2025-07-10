@extends('layouts.app')
@section('title', 'Dar de Alta UE')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow">
                    <x-forms.section-header title="Registro de Alta de la Unidad Económica"
                        description="Alta de la nueva Unidad Económica interesada en colaborar con la Universidad mediante el Modelo de Formación Dual, indicando las carreras con las que desean establecer vínculo académico." />

                    <div class="card-body">
                        <form class="pt-3" action="{{ route('empresas.registrar', $empresa->id) }}" method="post"
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
                                                <option value="{{ $tamano['tamano_eu'] }}"
                                                    {{ old('tamano_ue', $empresa->tamano_ue ?? '') == $tamano['tamano_eu'] ? 'selected' : '' }}>
                                                    {{ $tamano['tamano_eu'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('tamano_ue')
                                            <div class="text-danger invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="folio" class="form-label">Folio</label>
                                        <input type="text" name="folio" id="folio" class="form-control  "
                                            value="{{ old('folio', $empresa->id) }}">
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
                                        <input type="date" class="form-control  " id="fecha_registro"
                                            name="fecha_registro"
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
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Correo Electrónico <span
                                            class="text-danger">*</span></label>
                                    <input type="email" class="form-control  " id="email" name="email"
                                        value="{{ old('email', $empresa->email) }}" required>
                                    @error('email')
                                        <div class="text-danger invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
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
                                            name="direcciones_ids[]" multiple
                                            aria-label="Seleccionar Direcciones de Carrera" size="5">
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

                            <!-- Vigencia del Convenio -->
                            <div class="mb-4 p-3">
                                <h5 class="section-title fw-bold">Vigencia del Convenio</h5>

                                <div class="dropdown-divider mb-4"></div>
                                <div class="row">
                                    <!-- Fecha de Inicio -->
                                    <div class="col-md-4 mb-3">
                                        <label for="inicio_conv" class="form-label">Fecha de Inicio <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                            <input type="date" class="form-control" name="inicio_conv"
                                                id="inicio_conv" value="{{ old('inicio_conv', $empresa->inicio_conv) }}"
                                                required>
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
                                        <label for="fin_conv" class="form-label">Fecha de Finalización <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                            <input type="date" class="form-control" name="fin_conv" id="fin_conv"
                                                value="{{ old('fin_conv', $empresa->fin_conv) }}">
                                        </div>
                                        @error('fin_conv')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Documentos del Convenio -->
                            <div class="mb-4 p-3">
                                <h5 class="section-title fw-bold">Documentos del Convenio</h5>
                                <div class="dropdown-divider mb-4"></div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="convenioA">Convenio A</label>
                                        <div class="d-flex justify-content-between align-items-center gap-2 mt-1">
                                            <input type="file" accept="application/pdf" class="form-control d-none"
                                                id="inputConvenioA" name="convenioA">
                                            @if ($empresa->convenioA)
                                                <a href="{{ url(Storage::url($empresa->convenioA)) }}"
                                                    class="btn btn-primary flex-grow-1" target="_blank"
                                                    id="linkConvenioA">
                                                    Ver Convenio A <span class="mdi mdi-file-pdf-box"></span>
                                                </a>
                                            @else
                                                <span class="text-muted" id="textNoConvenioA">No hay documento
                                                    cargado</span>
                                            @endif
                                            <button type="button" class="btn btn-secondary" id="btnCambiarConvenioA"
                                                onclick="mostrarInput('inputConvenioA', 'btnCambiarConvenioA', 'linkConvenioA', 'textNoConvenioA')">
                                                Cambiar Documento
                                            </button>
                                            <button type="button" class="btn btn-danger d-none"
                                                id="btnCancelarConvenioA"
                                                onclick="cancelarCambio('inputConvenioA', 'btnCambiarConvenioA', 'linkConvenioA', 'btnCancelarConvenioA', 'textNoConvenioA')">
                                                Cancelar
                                            </button>
                                        </div>
                                        @error('convenioA')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="convenioMA">Convenio MA</label>
                                        <div class="d-flex justify-content-between align-items-center gap-2 mt-1">
                                            <input type="file" accept="application/pdf" class="form-control d-none"
                                                id="inputConvenioMA" name="convenioMA">
                                            @if ($empresa->convenioMA)
                                                <a href="{{ url(Storage::url($empresa->convenioMA)) }}"
                                                    class="btn btn-primary flex-grow-1" target="_blank"
                                                    id="linkConvenioMA">
                                                    Ver Convenio MA <span class="mdi mdi-file-pdf-box"></span>
                                                </a>
                                            @else
                                                <span class="text-muted" id="textNoConvenioMA">No hay documento
                                                    cargado</span>
                                            @endif
                                            <button type="button" class="btn btn-secondary" id="btnCambiarConvenioMA"
                                                onclick="mostrarInput('inputConvenioMA', 'btnCambiarConvenioMA', 'linkConvenioMA', 'textNoConvenioMA')">
                                                Cambiar Documento
                                            </button>
                                            <button type="button" class="btn btn-danger d-none"
                                                id="btnCancelarConvenioMA"
                                                onclick="cancelarCambio('inputConvenioMA', 'btnCambiarConvenioMA', 'linkConvenioMA', 'btnCancelarConvenioMA', 'textNoConvenioMA')">
                                                Cancelar
                                            </button>
                                        </div>
                                        @error('convenioMA')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
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
                                    <i class="fas fa-save me-1"></i> Alta de Empresa
                                </button>
                            </div>
                        </form>
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


        function ocultar(id, id2, text) {
            const elemento = document.getElementById(`${id}`);
            elemento.hidden = !elemento.hidden;
            document.getElementById(`${text}`).textContent = elemento.hidden ? 'Ver Documento' :
                'Cambiar Documento'; // Habilita el botón para cambiar el archivo
            if (!elemento.hidden) {
                document.getElementById(id2).value = '';


            }
            const elemento1 = document.getElementById(`${id2}`);
            elemento1.hidden = !elemento1.hidden; // Habilita el botón para cambiar el archivo
        }

        function mostrarInput(inputId, btnId, linkId, textId) {
            const fileInput = document.getElementById(inputId);
            const cambiarBtn = document.getElementById(btnId);
            const verLink = linkId ? document.getElementById(linkId) : null;
            const textNoDoc = textId ? document.getElementById(textId) : null;
            const cancelarBtn = document.getElementById('btnCancelar' + inputId.replace('input', ''));

            // Mostrar input de archivo y botón de cancelar
            fileInput.classList.remove('d-none');
            cancelarBtn.classList.remove('d-none');

            // Ocultar botón de cambiar y elementos de visualización
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

            // Ocultar input de archivo y botón de cancelar
            fileInput.classList.add('d-none');
            cancelarBtn.classList.add('d-none');

            // Mostrar botón de cambiar y elementos de visualización según corresponda
            cambiarBtn.classList.remove('d-none');
            if (verLink) verLink.classList.remove('d-none');
            if (textNoDoc && !verLink) textNoDoc.classList.remove('d-none');

            // Limpiar el valor del input de archivo
            fileInput.value = '';
        }
    </script>

@endsection
