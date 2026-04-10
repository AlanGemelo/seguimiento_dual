@extends ('layouts.app')
@section('title', 'Crear Empresa')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <x-forms.section-header title="Registro de Unidad Económica"
                    description="Registro de nuevas Unidades Económicas interesadas en colaborar con la Universidad mediante el Modelo de Formación Dual, indicando las carreras con las que desean establecer vínculo académico." />

                <div class="card-body">
                    <form enctype="multipart/form-data" action="{{ route('empresas.store') }}" method="POST"
                        class="needs-validation" novalidate>
                        @csrf

                        <!-- Información Básica -->
                        <div class="mb-4">
                            <h5 class="section-title fw-bold">
                                Información Básica
                            </h5>
                            <div class="dropdown-divider mb-4"></div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nombre" class="form-label">Nombre de la empresa
                                        <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nombre"
                                        placeholder="Razón social o nombre legal de la empresa" name="nombre"
                                        value="{{ old('nombre') }}" required />
                                    @error('nombre')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Correo Electrónico
                                        <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="ejemplo@empresa.com" value="{{ old('email') }}" required />
                                    @error('email')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="direccion" class="form-label">Dirección de la sede principal
                                        <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="direccion"
                                        placeholder="Calle, número, ciudad, provincia, país" name="direccion"
                                        value="{{ old('direccion') }}" required />
                                    @error('direccion')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-3 mb-3" style="max-width: 10%">
                                    <label for="ext_telefonica" class="form-label">
                                        Ext.
                                        <small class="text-muted">(Opcional)</small>
                                    </label>
                                    <input type="text" class="form-control" id="ext_telefonica" name="ext_telefonica"
                                        placeholder="Ext." value="{{ old('ext_telefonica') }}" />
                                    @error('ext_telefonica')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="telefono" class="form-label">Teléfono de contacto
                                        <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="telefono" name="telefono" maxlength="13"
                                        placeholder="Ingrese el numero de contacto" value="{{ old('telefono') }}"
                                        required />
                                    @error('telefono')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Direcciones de Carrera -->
                        <div class="mb-4 p-3">
                            <h5 class="section-title fw-bold">
                                Direcciones de Carrera
                                <span class="text-danger">*</span>
                            </h5>
                            <small class="text-muted text-stone-950">
                                Seleccione las carreras con las que su empresa
                                desea colaborar en el sistema de formación dual.
                            </small>

                            <div class="dropdown-divider mb-4"></div>

                            <div class="form-group">
                                <select class="form-select" id="direcciones_ids" name="direcciones_ids[]" multiple
                                    aria-label="Seleccionar Direcciones de Carrera" size="8">
                                    @foreach ($direcciones as $direccion)
                                        @if ($direccion)
                                            <option value="{{ $direccion->id }}"
                                                @if (
                                                    (is_array(old('direcciones_ids')) && in_array($direccion->id, old('direcciones_ids'))) ||
                                                        (!old() && session()->has('direccion') && session('direccion')->id == $direccion->id)) selected @endif>
                                                {{ $direccion->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                <small class="form-text text-muted">
                                    Mantén presionada la tecla
                                    <span class="text-black"><strong>Ctrl (Windows)</strong></span>
                                    o
                                    <span class="text-black"><strong>Command (Mac)</strong></span>
                                    para seleccionar múltiples opciones
                                </small>
                                @error('direcciones_ids')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Documentos del Convenio -->
                        <div class="mb-4 p-3">
                            <h5 class="section-title fw-bold">
                                Documentos del Convenio
                            </h5>
                            <div class="dropdown-divider mb-4"></div>

                            <!-- CONVENIO ESPECÍFICO -->
                            <div class="card mb-4 shadow-sm border-0">
                                <div class="card-header text-white"
                                    style="
                                        background: linear-gradient(
                                            90deg,
                                            #004d2d,
                                            #006837
                                        );
                                    ">
                                    <i class="mdi mdi-file-document-outline me-2"></i>
                                    Convenio ESPECÍFICO
                                </div>

                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <label class="form-label fw-semibold d-block">Tipo de vigencia</label>
                                            <div class="form-check form-switch d-inline-flex align-items-center ps-2"
                                                style="margin-left: 5vh">
                                                <input class="form-check-input me-2" type="checkbox"
                                                    id="indefinido_especifico" name="indefinido_especifico" />
                                                <label class="form-check-label fw-semibold"
                                                    for="indefinido_especifico">Indefinido</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3" id="vigenciaDetalle">
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold">Fecha de inicio</label>
                                            <input type="date" class="form-control" name="inicio_especifico" />
                                        </div>

                                        <div class="col-md-2" id="anosWrapper">
                                            <label class="form-label fw-semibold">Años de vigencia</label>
                                            <input type="number" class="form-control" name="anos_especifico"
                                                maxlength="3" min="0" max="999" style="width: 80px" />
                                        </div>

                                        <div class="col-md-4" id="finWrapper">
                                            <label class="form-label fw-semibold">Fecha de fin</label>
                                            <input type="date" class="form-control" name="fin_especifico" />
                                        </div>
                                    </div>

                                    <!-- Sección aparte para archivo -->
                                    <div class="mt-4">
                                        <h6 class="fw-bold">Subir convenio</h6>
                                        <input type="file" class="form-control" name="archivo_especifico"
                                            accept="application/pdf" />
                                        <small class="text-muted">Formato PDF, máximo 5MB</small>
                                    </div>
                                </div>
                            </div>

                            <!-- CONVENIO MARCO -->
                            <div class="card mb-4 shadow-sm border-0">
                                <div class="card-header text-white"
                                    style="
                                        background: linear-gradient(
                                            90deg,
                                            #004d2d,
                                            #006837
                                        );
                                    ">
                                    <i class="mdi mdi-file-document-outline me-2"></i>
                                    Convenio Marco
                                </div>

                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <label class="form-label fw-semibold d-block">Tipo de vigencia</label>
                                            <div class="form-check form-switch d-inline-flex align-items-center ps-2"
                                                style="margin-left: 5vh">
                                                <input class="form-check-input me-2" type="checkbox"
                                                    id="indefinido_marco" name="indefinido_marco" />
                                                <label class="form-check-label fw-semibold"
                                                    for="indefinido_marco">Indefinido</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3" id="vigenciaDetalleMarco">
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold">Fecha de inicio</label>
                                            <input type="date" class="form-control" name="inicio_marco" />
                                        </div>

                                        <div class="col-md-2" id="anosWrapperMarco">
                                            <label class="form-label fw-semibold">Años de vigencia</label>
                                            <input type="number" class="form-control" name="anos_marco" maxlength="3"
                                                min="0" max="999" style="width: 80px" />
                                        </div>

                                        <div class="col-md-4" id="finWrapperMarco">
                                            <label class="form-label fw-semibold">Fecha de fin</label>
                                            <input type="date" class="form-control" name="fin_marco" />
                                        </div>
                                    </div>

                                    <!-- Sección aparte para archivo -->
                                    <div class="mt-4">
                                        <h6 class="fw-bold">Subir convenio</h6>
                                        <input type="file" class="form-control" name="archivo_marco"
                                            accept="application/pdf" />
                                        <small class="text-muted">Formato PDF, máximo 5MB</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Botones de Acción -->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <x-buttons.success-button text="Guardar" />
                            <x-buttons.cancel-button url="{{ route('empresas.index') }}" />
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>

@endsection
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const indefinidoSwitch = document.getElementById('indefinido_especifico');
            const anosWrapper = document.getElementById('anosWrapper');
            const finWrapper = document.getElementById('finWrapper');
            const inicioInput = document.querySelector('[name="inicio_especifico"]');
            const anosInput = document.querySelector('[name="anos_especifico"]');
            const finInput = document.querySelector('[name="fin_especifico"]');

            function actualizarVigencia() {
                if (!indefinidoSwitch) return;

                if (indefinidoSwitch.checked) {
                    anosWrapper.style.display = 'none';
                    finWrapper.style.display = 'none';
                    anosInput.value = '';
                    finInput.value = '';
                    anosInput.disabled = true;
                    finInput.disabled = true;
                } else {
                    anosWrapper.style.display = 'block';
                    finWrapper.style.display = 'block';
                    anosInput.disabled = false;
                    finInput.disabled = false;
                }
            }

            if (anosInput) {
                anosInput.addEventListener('input', function() {
                    const inicio = inicioInput.value;
                    const anos = parseInt(anosInput.value);
                    if (!inicio || isNaN(anos)) return;

                    const fecha = new Date(inicio);
                    fecha.setFullYear(fecha.getFullYear() + anos);
                    finInput.value = fecha.toISOString().slice(0, 10);
                });
            }

            if (indefinidoSwitch) {
                indefinidoSwitch.addEventListener('change', actualizarVigencia);
                actualizarVigencia();
            }

            const indefinidoMarco = document.getElementById('indefinido_marco');
            const anosWrapperMarco = document.getElementById('anosWrapperMarco');
            const finWrapperMarco = document.getElementById('finWrapperMarco');
            const inicioMarco = document.querySelector('[name="inicio_marco"]');
            const anosMarco = document.querySelector('[name="anos_marco"]');
            const finMarco = document.querySelector('[name="fin_marco"]');

            function actualizarVigenciaMarco() {
                if (!indefinidoMarco) return;

                if (indefinidoMarco.checked) {
                    anosWrapperMarco.style.display = 'none';
                    finWrapperMarco.style.display = 'none';
                    anosMarco.value = '';
                    finMarco.value = '';
                    anosMarco.disabled = true;
                    finMarco.disabled = true;
                } else {
                    anosWrapperMarco.style.display = 'block';
                    finWrapperMarco.style.display = 'block';
                    anosMarco.disabled = false;
                    finMarco.disabled = false;
                }
            }

            if (anosMarco) {
                anosMarco.addEventListener('input', function() {
                    const inicio = inicioMarco.value;
                    const anos = parseInt(anosMarco.value);
                    if (!inicio || isNaN(anos)) return;

                    const fecha = new Date(inicio);
                    fecha.setFullYear(fecha.getFullYear() + anos);
                    finMarco.value = fecha.toISOString().slice(0, 10);
                });
            }

            if (indefinidoMarco) {
                indefinidoMarco.addEventListener('change', actualizarVigenciaMarco);
                actualizarVigenciaMarco();
            }

            const telInput = document.getElementById('telefono');

            if (telInput) {
                telInput.addEventListener('input', function(e) {
                    let val = e.target.value.replace(/\D/g, '').slice(0, 10);
                    if (val.length > 6)
                        e.target.value = val.replace(/(\d{3})(\d{3})(\d{0,4})/, '$1-$2-$3');
                    else if (val.length > 3)
                        e.target.value = val.replace(/(\d{3})(\d{0,3})/, '$1-$2');
                    else e.target.value = val;
                });

                telInput.closest('form').addEventListener('submit', function() {
                    telInput.value = telInput.value.replace(/-/g, '');
                });
            }

        });
    </script>
    <script src="{{ asset('js/multipleSelector.js') }}"></script>
@endsection
