@extends('layouts.app')
@section('title', 'Crear Anexo 1.2')
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
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 60%;
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
            @if ($errors->any())
                <div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <script>
                    window.onload = function() {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Éxito!',
                            text: '{{ session('success') }}',
                            confirmButtonText: 'Aceptar'
                        });
                    };
                </script>
            @endif

            @if (session('error'))
                <script>
                    window.onload = function() {
                        Swal.fire({
                            icon: 'error',
                            title: '¡Error!',
                            text: '{{ session('error') }}',
                            confirmButtonText: 'Aceptar'
                        });
                    };
                </script>
            @endif

            <div class="card shadow">
                <x-forms.section-header title="Anexo 1.2 - Programa de Difusión de la ED" description="" />

                <div class="card-body">
                    <form action="{{ route('anexo1_2.store') }}" method="POST" id="anexo1_2_form">
                        @csrf

                        <!-- Información -->
                        <div class="mb-4">
                            <h5 class="section-title fw-bold">Información</h5>
                            <div class="dropdown-divider mb-4"></div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="direccion_id" class="form-label">Fecha de Elaboración <span
                                            class="text-danger">*</span></label>
                                    <input type="date"
                                        class="form-control @error('fecha_elaboracion') is-invalid @enderror"
                                        id="fecha_elaboracion" name="fecha_elaboracion" required
                                        value="{{ old('fecha_elaboracion') }}">
                                    @error('fecha_elaboracion')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="quien_elaboro_id">Quién Elaboró <span class="text-danger">*</span></label>
                                    <select class="form-control" id="quien_elaboro_id" name="quien_elaboro_id" required>
                                        @foreach ($directores as $director)
                                            <option value="{{ $director->id }}">
                                                {{ $director->nombre . ' ' . $director->apellidoP . ' ' . $director->apellidoM }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('quien_elaboro_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Responsables -->
                        <div class="mb-4">
                            <h5 class="section-title fw-bold">Responsables</h5>
                            <div class="dropdown-divider mb-4"></div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nombre_firma_ie">Nombre del Responsable de la IE <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="{{ $responsableIE->name }}" disabled>
                                    <input type="hidden" name="nombre_firma_ie" value="{{ $responsableIE->name }}">
                                    @error('nombre_firma_ie')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="responsable_programa_id">Responsable del Programa
                                        Educativo <span class="text-danger">*</span></label>
                                    <select class="form-control" id="responsable_programa_id" name="responsable_programa_id"
                                        required>
                                        @foreach ($directores as $director)
                                            <option value="{{ $director->id }}"
                                                {{ $director->id == 1 ? 'selected' : '' }}>
                                                {{ $director->nombre }}</option>
                                        @endforeach
                                    </select>
                                    @error('responsable_programa_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="responsable_academico_id" class="form-label">Responsable Académico de la
                                            IE</label>
                                        <input type="text" class="form-control"
                                            value="{{ $responsableAcademico->name }}" disabled>
                                        <input type="hidden" name="responsable_academico_id"
                                            value="{{ $responsableAcademico->id }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Planeación Académica  -->
                        <div class="mb-4">
                            <h5 class="section-title fw-bold">Planeación Académica </h5>
                            <small class="text-muted text-stone-950">Tabla dinámica o sección repetible</small>
                            <div class="dropdown-divider mb-4"></div>

                            <div class="row">
                                <div class=" mb-3">
                                    <label for="actividades" class="form-label">Actividades</label>
                                    <table class="table table-bordered" id="actividades_table">
                                        <thead>
                                            <tr>
                                                <th>Actividad</th>
                                                <th>Responsable</th>
                                                <th>Unidad de Medida</th>
                                                <th>Meta</th>
                                                <th>Periodo</th>
                                                <th>Presupuesto</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><input type="text" data-tipo="text" class="form-control"
                                                        name="actividades[0][actividad]" required></td>
                                                <td><input type="text" data-tipo="text" class="form-control"
                                                        name="actividades[0][responsable]" required></td>
                                                <td><input type="text" data-tipo="text" class="form-control"
                                                        name="actividades[0][unidad_medida]" required></td>
                                                <td><input type="text" data-tipo="text" class="form-control"
                                                        name="actividades[0][meta]" required>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-toggle="collapse" data-bs-target="#periodo_0">Seleccionar
                                                        Meses</button>
                                                    <div id="periodo_0" class="collapse mt-2">
                                                        @foreach (['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'] as $mes)
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="actividades[0][periodo][]"
                                                                    value="{{ $mes }}">
                                                                <label
                                                                    class="form-check-label">{{ $mes }}</label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </td>
                                                <td><input type="number" class="form-control"
                                                        name="actividades[0][presupuesto]" required></td>
                                                <td><button type="button"
                                                        class="btn btn-danger remove-row">Eliminar</button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <button type="button" class="btn" id="add_row"
                                    style="background-color:#f4b400; color:#2e2e2e">Agregar Fila</button>
                            </div>
                        </div>
                        <!-- Botones de Acción -->
                        <div class="d-grid gap-2 d-md-flex  mt-4">
                            <x-buttons.success-button text="Guardar" />
                            <x-buttons.cancel-button url="{{ route('anexo1_2.index') }}" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Botón de Ayuda -->
    <button type="button" class="btn btn-help" onclick="openHelpModal()"
        style="position: fixed; bottom: 20px; right: 20px;">
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
            let rowIdx = 1;

            document.getElementById('add_row').addEventListener('click', function() {
                let table = document.getElementById('actividades_table').getElementsByTagName('tbody')[0];
                let newRow = table.insertRow();
                newRow.innerHTML = `
            <td><input type="text" class="form-control" name="actividades[${rowIdx}][actividad]" required></td>
            <td><input type="text" class="form-control" name="actividades[${rowIdx}][responsable]" required></td>
            <td><input type="text" class="form-control" name="actividades[${rowIdx}][unidad_medida]" required></td>
            <td><input type="text" class="form-control" name="actividades[${rowIdx}][meta]" required></td>
            <td>
                <button type="button" class="btn btn-secondary" data-bs-toggle="collapse" data-bs-target="#periodo_${rowIdx}">Seleccionar Meses</button>
                <div id="periodo_${rowIdx}" class="collapse mt-2">
                    @foreach (['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'] as $mes)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="actividades[${rowIdx}][periodo][]" value="{{ $mes }}">
                            <label class="form-check-label">{{ $mes }}</label>
                        </div>
                    @endforeach
                </div>
            </td>
            <td><input type="number" class="form-control" name="actividades[${rowIdx}][presupuesto]" required></td>
            <td><button type="button" class="btn btn-danger remove-row">Eliminar</button></td>
        `;
                rowIdx++;
            });

            document.getElementById('actividades_table').addEventListener('click', function(e) {
                if (e.target && e.target.classList.contains('remove-row')) {
                    e.target.closest('tr').remove();
                }
            });

            document.addEventListener('click', function(e) {
                const collapses = document.querySelectorAll('.collapse');
                collapses.forEach(collapse => {
                    if (!collapse.contains(e.target) && !collapse.previousElementSibling.contains(e
                            .target)) {
                        collapse.classList.remove('show');
                    }
                });
            });

            document.getElementById('anexo1_2_form').addEventListener('submit', function(e) {
                let valid = true;
                this.querySelectorAll('input[required], select[required]').forEach(function(input) {
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
