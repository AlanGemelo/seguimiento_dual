@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Editar Anexo 1.1 - Competencias del Programa Educativo</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('anexo1_1.update', $anexo1_1->id) }}" method="POST" id="anexo1_1_form">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="institucion_educativa" class="form-label">Institución Educativa</label>
                        <input type="text" class="form-control" id="institucion_educativa" name="institucion_educativa"
                            value="{{ $anexo1_1->institucion_educativa }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="programa_educativo_id" class="form-label">Programa Educativo</label>
                        <select class="form-control" id="programa_educativo_id" name="programa_educativo_id" required>
                            @foreach ($carreras as $carrera)
                                <option value="{{ $carrera->id }}"
                                    {{ $anexo1_1->programa_educativo_id == $carrera->id ? 'selected' : '' }}>
                                    {{ $carrera->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_elaboracion" class="form-label">Fecha de Elaboración</label>
                        <input type="date" class="form-control" id="fecha_elaboracion" name="fecha_elaboracion"
                            value="{{ $anexo1_1->fecha_elaboracion->format('Y-m-d') }}" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="responsable_programa_id" class="form-label">Responsable del Programa
                                Educativo</label>
                            <select class="form-control" id="responsable_programa_id" name="responsable_programa_id"
                                required>
                                @foreach ($directores as $director)
                                    <option value="{{ $director->id }}"
                                        {{ $anexo1_1->responsable_programa_id == $director->id ? 'selected' : '' }}>
                                        {{ $director->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="responsable_academico_id" class="form-label">Responsable Académico de la IE</label>
                            <input type="text" class="form-control" value="{{ $responsableAcademico->name }}" disabled>
                            <input type="hidden" name="responsable_academico_id" value="{{ $responsableAcademico->id }}">
                        </div>
                    </div>
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
                                                value="{{ $competencia['cuatrimestre'] }}" min="1" max="11"
                                                required></td>
                                        <td><button type="button" class="btn btn-danger remove-row">Eliminar</button></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-primary" id="add_row">Agregar Competencia</button>
                    </div>
                    <button type="submit" class="btn btn-success">Guardar</button>
                    <a href="{{ route('anexo1_1.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('add_row').addEventListener('click', function() {
                const table = document.getElementById('competencias_table').getElementsByTagName('tbody')[
                    0];
                const rowCount = table.rows.length;
                const row = table.insertRow(rowCount);
                row.innerHTML = `
            <td><input type="text" class="form-control" name="competencias[${rowCount}][competencia]" required></td>
            <td><input type="text" class="form-control" name="competencias[${rowCount}][actividad]" required></td>
            <td><input type="text" class="form-control" name="competencias[${rowCount}][asignatura]" required></td>
            <td><input type="number" class="form-control" name="competencias[${rowCount}][cuatrimestre]" min="1" max="11" required></td>
            <td><button type="button" class="btn btn-danger remove-row">Eliminar</button></td>
        `;
            });

            document.getElementById('competencias_table').addEventListener('click', function(e) {
                if (e.target && e.target.classList.contains('remove-row')) {
                    const row = e.target.closest('tr');
                    row.parentNode.removeChild(row);
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
