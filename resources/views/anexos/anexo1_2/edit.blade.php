@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Editar Anexo 1.2 - Programa de Difusión de la ED</h3>
        </div>
        <div class="card-body">
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

            <form action="{{ route('anexo1_2.update', $anexo1_2->id) }}" method="POST" id="anexo1_2_form">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="fecha_elaboracion" class="form-label">Fecha de Elaboración</label>
                        <input type="date" class="form-control" id="fecha_elaboracion" name="fecha_elaboracion" value="{{ \Carbon\Carbon::parse($anexo1_2->fecha_elaboracion)->format('Y-m-d') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="quien_elaboro_id" class="form-label">Quién Elaboró</label>
                        <select class="form-control" id="quien_elaboro_id" name="quien_elaboro_id" required>
                            @foreach($directores as $director)
                                <option value="{{ $director->id }}" {{ $anexo1_2->quien_elaboro_id == $director->id ? 'selected' : '' }}>{{ $director->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="responsable_programa_id" class="form-label">Responsable del Programa Educativo</label>
                        <select class="form-control" id="responsable_programa_id" name="responsable_programa_id" required>
                            @foreach($directores as $director)
                                <option value="{{ $director->id }}" {{ $anexo1_2->responsable_programa_id == $director->id ? 'selected' : '' }}>{{ $director->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="nombre_firma_ie" class="form-label">Nombre del Responsable de la IE</label>
                        <input type="text" class="form-control" value="{{ $responsableIE->name }}" disabled>
                        <input type="hidden" name="nombre_firma_ie" value="{{ $responsableIE->id }}">
                    </div>
                    <div class="col-md-6">
                        <label for="responsable_academico_id" class="form-label">Responsable Académico de la IE</label>
                        <input type="text" class="form-control" value="{{ $responsableAcademico->name }}" disabled>
                        <input type="hidden" name="responsable_academico_id" value="{{ $responsableAcademico->id }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="nombre_firma_ie" class="form-label">Nombre y Firma de la IE</label>
                        <input type="text" class="form-control" id="nombre_firma_ie" name="nombre_firma_ie" value="{{ $anexo1_2->nombre_firma_ie }}" required>
                    </div>
                </div>
                <div class="mb-3">
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
                            @foreach($anexo1_2->actividades as $index => $actividad)
                                <tr>
                                    <td><input type="text" class="form-control" name="actividades[{{ $index }}][actividad]" value="{{ $actividad['actividad'] }}" required></td>
                                    <td><input type="text" class="form-control" name="actividades[{{ $index }}][responsable]" value="{{ $actividad['responsable'] }}" required></td>
                                    <td><input type="text" class="form-control" name="actividades[{{ $index }}][unidad_medida]" value="{{ $actividad['unidad_medida'] }}" required></td>
                                    <td><input type="text" class="form-control" name="actividades[{{ $index }}][meta]" value="{{ $actividad['meta'] }}" required></td>
                                    <td>
                                        <button type="button" class="btn btn-secondary" data-bs-toggle="collapse" data-bs-target="#periodo_{{ $index }}">Seleccionar Meses</button>
                                        <div id="periodo_{{ $index }}" class="collapse mt-2">
                                            @foreach(['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'] as $mes)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="actividades[{{ $index }}][periodo][]" value="{{ $mes }}" {{ in_array($mes, $actividad['periodo']) ? 'checked' : '' }}>
                                                    <label class="form-check-label">{{ $mes }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td><input type="number" class="form-control" name="actividades[{{ $index }}][presupuesto]" value="{{ $actividad['presupuesto'] }}" required></td>
                                    <td><button type="button" class="btn btn-danger remove-row">Eliminar</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-primary" id="add_row">Agregar Fila</button>
                </div>
                <button type="submit" class="btn btn-success">Guardar</button>
                <a href="{{ route('anexo1_2.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>

<!-- Botón de Ayuda -->
<button type="button" class="btn btn-help" onclick="openHelpModal()" style="position: fixed; bottom: 20px; right: 20px;">
    ¿Necesitas ayuda? 🔍
</button>

<!-- Modal de Ayuda -->
<div id="helpModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeHelpModal()">&times;</span>
        <h2>Guía de Referencias para el Anexo 1.2</h2>
        <ol>
            <li><strong>Referencia 1:</strong> Describir la actividad a realizar, relacionada con la difusión de la Educación Dual.</li>
            <li><strong>Referencia 2:</strong> Registrar al responsable de la actividad a realizar.</li>
            <li><strong>Referencia 3:</strong> Indicar la Unidad de Medida con la que se verificará el cumplimiento de lo programado.</li>
            <li><strong>Referencia 4:</strong> Establecer la meta a alcanzar de cada actividad, contrastando lo programado (P) contra lo Real (R).</li>
            <li><strong>Referencia 5:</strong> Registrar en la casilla donde cruza la columna del mes el valor programado a alcanzar.</li>
            <li><strong>Referencia 6:</strong> Registrar en la casilla donde cruza la columna del mes el valor alcanzado.</li>
        </ol>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    let rowIdx = {{ count($anexo1_2->actividades) }};

    document.getElementById('add_row').addEventListener('click', function () {
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
                    @foreach(['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'] as $mes)
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

    document.getElementById('actividades_table').addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('remove-row')) {
            e.target.closest('tr').remove();
        }
    });

    document.addEventListener('click', function (e) {
        const collapses = document.querySelectorAll('.collapse');
        collapses.forEach(collapse => {
            if (!collapse.contains(e.target) && !collapse.previousElementSibling.contains(e.target)) {
                collapse.classList.remove('show');
            }
        });
    });

    document.getElementById('anexo1_2_form').addEventListener('submit', function (e) {
        let valid = true;
        this.querySelectorAll('input[required], select[required]').forEach(function (input) {
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
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
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    }
    .btn-help:hover {
        background-color: #0056b3;
    }
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
</style>
@endsection
