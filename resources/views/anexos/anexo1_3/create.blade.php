@extends('layouts.app')
@section('title', 'Crear Anexo 1.3')
@section('styles')
    <style>
        .is-invalid {
            border-color: red;
        }

        .invalid-feedback {
            color: red;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
            animation: fadeIn 0.5s;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .btn-help {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 50px;
            font-size: 16px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .btn-help:hover {
            background-color: #0056b3;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }
    </style>
@endsection

@section('content')
<body class="body">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <x-forms.section-header title="Anexo 1.3 - Formato de Registro de Interesados de UE y Estudiantes ED"
                    description="" />

                <div class="card-body">
                    <form action="{{ route('anexo1_3.store') }}" method="POST" id="anexo1_3_form">
                        @csrf
                        <!-- Información General -->
                        <div class="mb-4">
                            <h5 class="section-title fw-bold">Información General</h5>
                            <div class="dropdown-divider mb-4"></div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="direccion_id" class="form-label">Fecha de Realización <span
                                            class="text-danger">*</span></label>
                                    <input type="date"
                                        class="form-control @error('fecha_realizacion') is-invalid @enderror"
                                        id="fecha_realizacion" name="fecha_realizacion" required
                                        value="{{ old('fecha_realizacion') }}">
                                    @error('fecha_realizacion')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="quien_elaboro_id" class="form-label">Lugar <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('lugar') is-invalid @enderror"
                                        id="lugar" name="lugar" required value="{{ old('lugar') }}">
                                    @error('lugar')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Datos de la Empresa Interesada -->
                        <div class="mb-4">
                            <h5 class="section-title fw-bold">Datos de la Empresa Interesada</h5>
                            <div class="dropdown-divider mb-4"></div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nombre_firma_ie" class="form-label">Razón Social <span
                                            class="text-danger">*</span></label>
                                    <input type="text" data-tipo="text"
                                        class="form-control @error('razon_social') is-invalid @enderror" id="razon_social"
                                        name="razon_social" required value="{{ old('razon_social') }}">
                                    @error('razon_social')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="responsable_programa_id" class="form-label">RFC <span
                                            class="text-danger">*</span></label>
                                    <input type="text" data-tipo="rfc"
                                        class="form-control uppercase @error('rfc') is-invalid @enderror" id="rfc"
                                        name="rfc" required pattern="[A-Z0-9]{13}" value="{{ old('rfc') }}">
                                    @error('rfc')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label for="" class="form-label" class="form-label">Dirección de la sede
                                            principal </label>
                                        <input type="text" class="form-control @error('domicilio') is-invalid @enderror"
                                            id="domicilio" name="domicilio" required value="{{ old('domicilio') }}">
                                        @error('domicilio')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="" class="form-label">Actividad Económica </label>
                                        <input type="text" data-tipo="text"
                                            class="form-control @error('actividad_economica') is-invalid @enderror"
                                            id="actividad_economica" name="actividad_economica" required
                                            value="{{ old('actividad_economica') }}">
                                        @error('actividad_economica')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label for="" class="form-label">Número de Empleados </label>
                                        <input type="number" data-tipo="numbers"
                                            class="form-control @error('numero_empleados') is-invalid @enderror"
                                            id="numero_empleados" name="numero_empleados" required
                                            value="{{ old('numero_empleados') }}">
                                        @error('numero_empleados')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-6 mb-3 w-25">
                                        <label for="participacion_anterior" class="form-label d-block">
                                            ¿Participación Anterior?</label>
                                        <div class="d-flex gap-3">
                                            <div style="width: 100%;padding: 0.875rem 1.375rem;">
                                                <input class="form-check-input" type="radio" name="participacion_anterior"
                                                    id="participacion_si" value="1"
                                                    {{ old('participacion_anterior') == '1' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="participacion_si">
                                                    Sí
                                                </label>
                                            </div>
                                            <div style="width: 100%;padding: 0.875rem 1.375rem;">
                                                <input class="form-check-input" type="radio"
                                                    name="participacion_anterior" id="participacion_no" value="0"
                                                    {{ old('participacion_anterior') == '0' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="participacion_no">
                                                    No
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-3"id="motivo_container" style="display: none">
                                        <label for="motivo_no_participacion" class="form-label d-block ">
                                            Motivo de No participación</label>
                                        <textarea class="form-control w-75 @error('motivo_no_participacion') is-invalid @enderror" style="height: 5rem"
                                            id="motivo_no_participacion" name="motivo_no_participacion">{{ old('motivo_no_participacion') }}</textarea>
                                        @error('motivo_no_participacion')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Contacto Empresarial  -->
                        <div class="mb-4">
                            <h5 class="section-title fw-bold">Contacto Empresarial </h5>
                            <div class="dropdown-divider mb-4"></div>

                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label for="" class="form-label">Nombre del Representante</label>
                                    <input type="text" data-tipo="text"
                                        class="form-control @error('nombre_representante') is-invalid @enderror"
                                        id="nombre_representante" name="nombre_representante" required
                                        value="{{ old('nombre_representante') }}">
                                    @error('nombre_representante')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="" class="form-label">Cargo del Representante</label>
                                    <input type="text" data-tipo="text"
                                        class="form-control @error('cargo_representante') is-invalid @enderror"
                                        id="cargo_representante" name="cargo_representante" required
                                        value="{{ old('cargo_representante') }}">
                                    @error('cargo_representante')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label for="" class="form-label">Teléfono </label>
                                    <input type="text" data-tipo="numbers"
                                        class="form-control @error('telefono') is-invalid @enderror" id="telefono"
                                        name="telefono" required pattern="\d{10}" value="{{ old('telefono') }}">
                                    @error('telefono')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="" class="form-label">Correo Electrónico </label>
                                    <input type="email"
                                        class="form-control @error('correo_electronico') is-invalid @enderror"
                                        id="correo_electronico" name="correo_electronico" required
                                        value="{{ old('correo_electronico') }}">
                                    @error('correo_electronico')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- Interés en Participar  -->
                        <div class="mb-4">
                            <h5 class="section-title fw-bold">Interés en Participar </h5>
                            <div class="dropdown-divider mb-4"></div>

                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label for="interes_participar" class="form-label">¿Deseas participar?</label>
                                    <div class="d-flex gap-3">
                                        <div style="width: 100%;padding: 0.875rem 1.375rem;">
                                            <input class="form-check-input" type="radio" name="interes_participar"
                                                id="interes_si" value="1"
                                                {{ old('interes_participar') == '1' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="interes_si">Sí</label>
                                        </div>
                                        <div style="width: 100%;padding: 0.875rem 1.375rem;">
                                            <input class="form-check-input" type="radio" name="interes_participar"
                                                id="interes_no" value="0"
                                                {{ old('interes_participar') == '0' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="interes_no">No</label>
                                        </div>
                                    </div>
                                    @error('interes_participar')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-6 mb-3" id="estudiantes_container" style="display: none">
                                    <label for="numero_estudiantes" class="form-label mb-3">Número de Estudiantes
                                        Potenciales
                                        <input type="number" data-tipo="numbers"
                                            class="form-control mt-2 @error('numero_estudiantes') is-invalid @enderror"
                                            id="numero_estudiantes" name="numero_estudiantes"
                                            value="{{ old('numero_estudiantes') }}" min="1">
                                        @error('numero_estudiantes')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 mb-3" id="no_interes_container" style="display: none">
                                    <label for="motivo_no_participacion" class="form-label">
                                        Motivo de No Interés </label>
                                    <textarea class="form-control w-75 @error('motivo_no_interes') is-invalid @enderror" id="motivo_no_interes"
                                        style="height: 5rem" name="motivo_no_interes">{{ old('motivo_no_interes') }}</textarea>
                                    @error('motivo_no_interes')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                        </div>
                        <!-- Interés en Participar  -->
                        <div class="mb-4">
                            <h5 class="section-title fw-bold">Validación y Comentarios </h5>
                            <div class="dropdown-divider mb-4"></div>
                            <div class="row">
                                <div class="col-6 mb-3 ">
                                    <label for="informacion_clara" class="form-label">Información Clara</label>
                                    <div class="d-flex gap-3 w-25">
                                        <div style="width: 100%;padding: 0.875rem 1.375rem;">
                                            <input class="form-check-input" type="radio" name="informacion_clara"
                                                id="informacion_si" value="1"
                                                {{ old('informacion_clara') == '1' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="informacion_si">
                                                Sí
                                            </label>
                                        </div>
                                        <div style="width: 100%;padding: 0.875rem 1.375rem;">
                                            <input class="form-check-input" type="radio" name="informacion_clara"
                                                id="informacion_no" value="0"
                                                {{ old('informacion_clara') == '0' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="informacion_no">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                    @error('informacion_clara')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-6 mb-3">
                                    <label for="comentarios_adicionales" class="form-label">Comentarios Adicionales
                                    </label>
                                    <textarea class="form-control @error('comentarios_adicionales') is-invalid @enderror" style="height: 5rem "
                                        id="comentarios_adicionales" name="comentarios_adicionales">{{ old('comentarios_adicionales') }}</textarea>
                                    @error('comentarios_adicionales')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Responsable del Registro --}}
                        <div class="mb-4">
                            <h5 class="section-title fw-bold">Responsable del Registro </h5>
                            <div class="dropdown-divider mb-4"></div>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label for="" class="form-label">Quién Elaboró </label>
                                    <input type="text" class="form-control"
                                        value="{{ $responsableIE->name . ' ' . $responsableIE->apellidoM . ' ' . $responsableIE->apellidoM }}"
                                        disabled>
                                    <input type="hidden" name="quien_elaboro_id" value="{{ $responsableIE->id }}">
                                </div>
                            </div>
                        </div>
                        <!-- Botones de Acción -->
                        <div class="d-grid gap-2 d-md-flex  mt-4">
                            <x-buttons.success-button text="Guardar" />
                            <x-buttons.cancel-button url="{{ route('anexo1_3.index') }}" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Botón de Ayuda -->
    <button type="button" class="btn btn-help" onclick="openHelpModal()"
        style=" bottom: 20px; right: 20px; margin-bottom:1rem;">
        ¿Necesitas ayuda? 🔍
    </button>

    <!-- Modal de Ayuda -->
    <div id="helpModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeHelpModal()">&times;</span>
            <h2>Guía de Referencias para el Anexo 1.2</h2>
            <ol>
                <li><strong>Referencia 1:</strong> Describir la actividad a realizar, relacionada con la difusión de la
                    Educación Dual.</li>
                <li><strong>Referencia 2:</strong> Registrar al responsable de la actividad a realizar.</li>
                <li><strong>Referencia 3:</strong> Indicar la Unidad de Medida con la que se verificará el cumplimiento de
                    lo programado.</li>
                <li><strong>Referencia 4:</strong> Establecer la meta a alcanzar de cada actividad, contrastando lo
                    programado (P) contra lo Real (R).</li>
                <li><strong>Referencia 5:</strong> Registrar en la casilla donde cruza la columna del mes el valor
                    programado a alcanzar.</li>
                <li><strong>Referencia 6:</strong> Registrar en la casilla donde cruza la columna del mes el valor
                    alcanzado.</li>
            </ol>
        </div>
    </div>
@endsection
</body>
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Participación Anterior
            const siRadio = document.getElementById('participacion_si');
            const noRadio = document.getElementById('participacion_no');
            const motivoContainer = document.getElementById('motivo_container');

            function toggleMotivoParticipacion() {
                if (noRadio && noRadio.checked) {
                    motivoContainer.style.display = 'block';
                } else {
                    motivoContainer.style.display = 'none';
                }
            }

            if (siRadio && noRadio) {
                siRadio.addEventListener('change', toggleMotivoParticipacion);
                noRadio.addEventListener('change', toggleMotivoParticipacion);
            }

            toggleMotivoParticipacion();


            // Interés en participar
            const interesSi = document.getElementById('interes_si');
            const interesNo = document.getElementById('interes_no');
            const noInteresContainer = document.getElementById('no_interes_container');
            const estudiantes_container = document.getElementById('estudiantes_container')

            function toggleMotivoInteres() {
                if (interesNo && interesNo.checked) {
                    noInteresContainer.style.display = 'block';
                    estudiantes_container.style.display = 'none';
                } else {
                    noInteresContainer.style.display = 'none';
                    estudiantes_container.style.display = 'block';
                }
            }

            if (interesSi && interesNo) {
                interesSi.addEventListener('change', toggleMotivoInteres);
                interesNo.addEventListener('change', toggleMotivoInteres);
            }

            toggleMotivoInteres(); // Al cargar

            document.getElementById('anexo1_3_form').addEventListener('submit', function(e) {
                let valid = true;
                this.querySelectorAll('input[required], select[required], textarea[required]').forEach(
                    function(input) {
                        if (!input.value) {
                            valid = false;
                            input.classList.add('is-invalid');
                        } else {
                            input.classList.remove('is-invalid');
                        }
                    });
                if (!valid) {
                    e.preventDefault();
                }
            });

        });

        function openHelpModal() {
            document.getElementById('helpModal').style.display = 'block';
        }

        function closeHelpModal() {
            document.getElementById('helpModal').style.display = 'none';
        }

        // Cerrar modal al hacer clic fuera de él
        window.onclick = function(event) {
            var modal = document.getElementById('helpModal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
    </script>
@endsection
