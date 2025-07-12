@extends('layouts.app')
@section('title', 'Editar Anexo 1.1')
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
            margin: 15% auto;
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
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <x-forms.section-header title="Anexo 1.1 - Planeación y Difusión de la ED" description="" />

                <div class="card-body">
                    <form action="{{ route('anexo1_1.store') }}" method="POST" id="anexo1_1_form">
                        @csrf

                        <!-- Información Institucional -->
                        <div class="mb-4">
                            <h5 class="section-title fw-bold">Información Institucional</h5>
                            <div class="dropdown-divider mb-4"></div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="grado_academico">Institución Educativa <span
                                            class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control @error('institucion_educativa') is-invalid @enderror"
                                        id="institucion_educativa" name="institucion_educativa"
                                        value="{{ $anexo1_1->institucion_educativa }}" required>
                                    @error('institucion_educativa')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="nombre">Programa Educativo <span class="text-danger">*</span></label>
                                    <select class="form-control @error('programa_educativo_id') is-invalid @enderror"
                                        id="programa_educativo_id" name="programa_educativo_id" required>
                                        @foreach ($carreras as $carrera)
                                            <option value="{{ $carrera->id }}"
                                                {{ $anexo1_1->programa_educativo_id == $carrera->id ? 'selected' : '' }}>
                                                {{ $carrera->nombre }}</option>
                                        @endforeach
                                    </select>
                                    @error('programa_educativo_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="direccion_id" class="form-label">Fecha de Elaboración <span
                                            class="text-danger">*</span></label>
                                    <input type="date"
                                        class="form-control @error('fecha_elaboracion') is-invalid @enderror"
                                        id="fecha_elaboracion" name="fecha_elaboracion" required
                                        value="{{ $anexo1_1->fecha_elaboracion->format('Y-m-d') }}" required>
                                    @error('fecha_elaboracion')
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
                                    <label for="grado_academico">Responsable del Programa Educativo <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control" id="responsable_programa_id" name="responsable_programa_id"
                                        required>
                                        @foreach ($directores as $director)
                                            <option value="{{ $director->id }}"
                                                {{ $anexo1_1->responsable_programa_id == $director->id ? 'selected' : '' }}>
                                                {{ $director->nombre . ' ' . $director->apellidoP . ' ' . $director->apellidoM }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="nombre">Responsable Académico de la IE <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="{{ $responsableAcademico->name }}"
                                        disabled>
                                    <input type="hidden" name="responsable_academico_id"
                                        value="{{ $responsableAcademico->id }}">
                                </div>
                            </div>
                        </div>

                        <!-- Planeación Académica  -->
                        <div class="mb-4">
                            <h5 class="section-title fw-bold">Planeación Académica </h5>
                            <small class="text-muted text-stone-950">Tabla dinámica o sección repetible</small>
                            <div class="dropdown-divider mb-4"></div>

                            <div class="row">
                                <div class="mb-3">
                                    <label for="competencias" class="form-label">Competencias</label>
                                    <table class="table table-bordered" id="competencias_table">
                                        <thead>
                                            <tr>
                                                <th>Competencias a Desarrollar</th>
                                                <th>Actividades de Aprendizaje</th>
                                                <th>Asignaturas</th>
                                                <th>Cuatrimestre/Semestre</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($anexo1_1->competencias as $index => $competencia)
                                                <tr>
                                                    <td><input type="text" data-tipo="text" class="form-control"
                                                            name="competencias[{{ $index }}][competencia]"
                                                            value="{{ $competencia['competencia'] }}" required></td>
                                                    <td><input type="text" data-tipo="text" class="form-control"
                                                            name="competencias[{{ $index }}][actividad]"
                                                            value="{{ $competencia['actividad'] }}" required></td>
                                                    <td><input type="text" data-tipo="text" class="form-control"
                                                            name="competencias[{{ $index }}][asignatura]"
                                                            value="{{ $competencia['asignatura'] }}" required></td>
                                                    <td><input type="number" class="form-control"
                                                            name="competencias[{{ $index }}][cuatrimestre]"
                                                            value="{{ $competencia['cuatrimestre'] }}" min="1"
                                                            max="11" required></td>
                                                    <td><button type="button"
                                                            class="btn btn-danger remove-row">Eliminar</button></td>
                                                </tr>
                                            @endforeach
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
                            <x-buttons.success-button text="Actualizar" />
                            <x-buttons.cancel-button url="{{ route('anexo1_1.index') }}" />
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
            <h2>Guía de Referencias para el Anexo 1.1</h2>
            <ol>
                <li><strong>Referencia 1:</strong> Registrar el nombre de la Institución Educativa donde se imparte el
                    programa de estudios.</li>
                <li><strong>Referencia 2:</strong> Registrar el nombre del Programa Educativo o carrera que se está
                    analizando.</li>
                <li><strong>Referencia 3:</strong> Describir las competencias específicas que se enuncian en el programa de
                    estudio de las asignaturas propuestas para ED.</li>
                <li><strong>Referencia 4:</strong> Describir de manera clara y precisa las actividades de aprendizaje que
                    deben realizarse para el logro de las competencias específicas.</li>
                <li><strong>Referencia 5:</strong> Colocar nombre y clave de las asignaturas.</li>
                <li><strong>Referencia 6:</strong> Indicar el periodo del plan de estudio en el que se desarrollan las
                    competencias referidas.</li>
            </ol>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let rowIdx = 1;

            document.getElementById('add_row').addEventListener('click', function() {
                let table = document.getElementById('competencias_table').getElementsByTagName('tbody')[0];
                let newRow = table.insertRow();
                newRow.innerHTML = `
            <td><input type="text" class="form-control @error('competencias.${rowIdx}.competencia') is-invalid @enderror" name="competencias[${rowIdx}][competencia]" required></td>
            <td><input type="text" class="form-control @error('competencias.${rowIdx}.actividad') is-invalid @enderror" name="competencias[${rowIdx}][actividad]" required></td>
            <td><input type="text" class="form-control @error('competencias.${rowIdx}.asignatura') is-invalid @enderror" name="competencias[${rowIdx}][asignatura]" required></td>
            <td><input type="number" class="form-control @error('competencias.${rowIdx}.cuatrimestre') is-invalid @enderror" name="competencias[${rowIdx}][cuatrimestre]" min="1" max="11" required></td>
            <td><button type="button" class="btn btn-danger remove-row">Eliminar</button></td>
        `;
                rowIdx++;
            });

            document.getElementById('competencias_table').addEventListener('click', function(e) {
                if (e.target && e.target.classList.contains('remove-row')) {
                    e.target.closest('tr').remove();
                }
            });

            document.getElementById('anexo1_1_form').addEventListener('submit', function(e) {
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
