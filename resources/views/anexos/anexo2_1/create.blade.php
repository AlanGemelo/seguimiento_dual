@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Crear Anexo 2.1 - Evaluación de la UE</h3>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('anexo2_1.store') }}" method="POST" id="anexo2_1_form">
                @csrf
                <div class="stepper">
                    <div class="step">
                        <h4>Información General</h4>
                        <div class="mb-3">
                            <label for="unidad_economica" class="form-label">Unidad Económica</label>
                            <input type="text" class="form-control" id="unidad_economica" name="unidad_economica" value="{{ old('unidad_economica') }}" required>
                            <div class="invalid-feedback">Este campo es obligatorio.</div>
                        </div>
                        <div class="mb-3">
                            <label for="periodo" class="form-label">Periodo Escolar</label>
                            <input type="text" class="form-control" id="periodo" name="periodo" value="{{ old('periodo') }}" required>
                            <div class="invalid-feedback">Este campo es obligatorio.</div>
                        </div>
                        <div class="mb-3">
                            <label for="fecha" class="form-label">Fecha de Aplicación</label>
                            <input type="date" class="form-control" id="fecha" name="fecha" value="{{ old('fecha') }}" required>
                            <div class="invalid-feedback">Este campo es obligatorio.</div>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="nextStep()">Siguiente</button>
                    </div>
                    <div class="step">
                        <h4>Sección 1 - Situación Legal</h4>
                        <div class="mb-3">
                            <label>¿La UE está legalmente constituida?</label>
                            <div>
                                <input type="radio" id="legalmente_constituida_no" name="seccion_1[legalmente_constituida]" value="1" {{ old('seccion_1.legalmente_constituida') == '1' ? 'checked' : '' }} required>
                                <label for="legalmente_constituida_no">No</label>
                                <input type="radio" id="legalmente_constituida_si" name="seccion_1[legalmente_constituida]" value="2" {{ old('seccion_1.legalmente_constituida') == '2' ? 'checked' : '' }} required>
                                <label for="legalmente_constituida_si">Sí</label>
                            </div>
                            <div class="invalid-feedback">Este campo es obligatorio.</div>
                        </div>
                        <div class="mb-3">
                            <label>¿La UE está dispuesta a firmar el Convenio Específico de Cooperación?</label>
                            <div>
                                <input type="radio" id="convenio_cooperacion_no" name="seccion_1[convenio_cooperacion]" value="1" {{ old('seccion_1.convenio_cooperacion') == '1' ? 'checked' : '' }} required>
                                <label for="convenio_cooperacion_no">No</label>
                                <input type="radio" id="convenio_cooperacion_si" name="seccion_1[convenio_cooperacion]" value="2" {{ old('seccion_1.convenio_cooperacion') == '2' ? 'checked' : '' }} required>
                                <label for="convenio_cooperacion_si">Sí</label>
                            </div>
                            <div class="invalid-feedback">Este campo es obligatorio.</div>
                        </div>
                        <div class="mb-3">
                            <label>¿La UE está dispuesta a firmar el Convenio de Aprendizaje?</label>
                            <div>
                                <input type="radio" id="convenio_aprendizaje_no" name="seccion_1[convenio_aprendizaje]" value="1" {{ old('seccion_1.convenio_aprendizaje') == '1' ? 'checked' : '' }} required>
                                <label for="convenio_aprendizaje_no">No</label>
                                <input type="radio" id="convenio_aprendizaje_si" name="seccion_1[convenio_aprendizaje]" value="2" {{ old('seccion_1.convenio_aprendizaje') == '2' ? 'checked' : '' }} required>
                                <label for="convenio_aprendizaje_si">Sí</label>
                            </div>
                            <div class="invalid-feedback">Este campo es obligatorio.</div>
                        </div>
                        <div class="mb-3">
                            <label>¿La UE está dispuesta a firmar el Convenio Marco de Colaboración?</label>
                            <div>
                                <input type="radio" id="convenio_marco_no" name="seccion_1[convenio_marco]" value="1" {{ old('seccion_1.convenio_marco') == '1' ? 'checked' : '' }} required>
                                <label for="convenio_marco_no">No</label>
                                <input type="radio" id="convenio_marco_si" name="seccion_1[convenio_marco]" value="2" {{ old('seccion_1.convenio_marco') == '2' ? 'checked' : '' }} required>
                                <label for="convenio_marco_si">Sí</label>
                            </div>
                            <div class="invalid-feedback">Este campo es obligatorio.</div>
                        </div>
                        <button type="button" class="btn btn-secondary" onclick="prevStep()">Anterior</button>
                        <button type="button" class="btn btn-primary" onclick="nextStep()">Siguiente</button>
                    </div>
                    <div class="step">
                        <h4>Sección 2 - Situación Educativa/Formativa</h4>
                        <div class="mb-3">
                            <label>¿La UE cuenta con personal capacitado?</label>
                            <div>
                                <input type="radio" id="personal_capacitado_1" name="seccion_2[personal_capacitado]" value="1" {{ old('seccion_2.personal_capacitado') == '1' ? 'checked' : '' }} required>
                                <label for="personal_capacitado_1">No Cumple</label>
                                <input type="radio" id="personal_capacitado_2" name="seccion_2[personal_capacitado]" value="2" {{ old('seccion_2.personal_capacitado') == '2' ? 'checked' : '' }} required>
                                <label for="personal_capacitado_2">Socialmente</label>
                                <input type="radio" id="personal_capacitado_3" name="seccion_2[personal_capacitado]" value="3" {{ old('seccion_2.personal_capacitado') == '3' ? 'checked' : '' }} required>
                                <label for="personal_capacitado_3">Cumple</label>
                            </div>
                            <div class="invalid-feedback">Este campo es obligatorio.</div>
                        </div>
                        <div class="mb-3">
                            <label>¿La UE tiene áreas especializadas?</label>
                            <div>
                                <input type="radio" id="areas_especializadas_1" name="seccion_2[areas_especializadas]" value="1" {{ old('seccion_2.areas_especializadas') == '1' ? 'checked' : '' }} required>
                                <label for="areas_especializadas_1">No Cumple</label>
                                <input type="radio" id="areas_especializadas_2" name="seccion_2[areas_especializadas]" value="2" {{ old('seccion_2.areas_especializadas') == '2' ? 'checked' : '' }} required>
                                <label for="areas_especializadas_2">Socialmente</label>
                                <input type="radio" id="areas_especializadas_3" name="seccion_2[areas_especializadas]" value="3" {{ old('seccion_2.areas_especializadas') == '3' ? 'checked' : '' }} required>
                                <label for="areas_especializadas_3">Cumple</label>
                            </div>
                            <div class="invalid-feedback">Este campo es obligatorio.</div>
                        </div>
                        <div class="mb-3">
                            <label>¿La UE puede designar un mentor con título de licenciatura?</label>
                            <div>
                                <input type="radio" id="mentor_licenciatura_1" name="seccion_2[mentor_licenciatura]" value="1" {{ old('seccion_2.mentor_licenciatura') == '1' ? 'checked' : '' }} required>
                                <label for="mentor_licenciatura_1">No Cumple</label>
                                <input type="radio" id="mentor_licenciatura_2" name="seccion_2[mentor_licenciatura]" value="2" {{ old('seccion_2.mentor_licenciatura') == '2' ? 'checked' : '' }} required>
                                <label for="mentor_licenciatura_2">Socialmente</label>
                                <input type="radio" id="mentor_licenciatura_3" name="seccion_2[mentor_licenciatura]" value="3" {{ old('seccion_2.mentor_licenciatura') == '3' ? 'checked' : '' }} required>
                                <label for="mentor_licenciatura_3">Cumple</label>
                            </div>
                            <div class="invalid-feedback">Este campo es obligatorio.</div>
                        </div>
                        <div class="mb-3">
                            <label>¿La UE puede cumplir con un plan de formación?</label>
                            <div>
                                <input type="radio" id="plan_formacion_1" name="seccion_2[plan_formacion]" value="1" {{ old('seccion_2.plan_formacion') == '1' ? 'checked' : '' }} required>
                                <label for="plan_formacion_1">No Cumple</label>
                                <input type="radio" id="plan_formacion_2" name="seccion_2[plan_formacion]" value="2" {{ old('seccion_2.plan_formacion') == '2' ? 'checked' : '' }} required>
                                <label for="plan_formacion_2">Socialmente</label>
                                <input type="radio" id="plan_formacion_3" name="seccion_2[plan_formacion]" value="3" {{ old('seccion_2.plan_formacion') == '3' ? 'checked' : '' }} required>
                                <label for="plan_formacion_3">Cumple</label>
                            </div>
                            <div class="invalid-feedback">Este campo es obligatorio.</div>
                        </div>
                        <div class="mb-3">
                            <label>¿La UE tiene capacidad para llevar a cabo el plan de formación por 1-3 años?</label>
                            <div>
                                <input type="radio" id="capacidad_plan_1" name="seccion_2[capacidad_plan]" value="1" {{ old('seccion_2.capacidad_plan') == '1' ? 'checked' : '' }} required>
                                <label for="capacidad_plan_1">No Cumple</label>
                                <input type="radio" id="capacidad_plan_2" name="seccion_2[capacidad_plan]" value="2" {{ old('seccion_2.capacidad_plan') == '2' ? 'checked' : '' }} required>
                                <label for="capacidad_plan_2">Socialmente</label>
                                <input type="radio" id="capacidad_plan_3" name="seccion_2[capacidad_plan]" value="3" {{ old('seccion_2.capacidad_plan') == '3' ? 'checked' : '' }} required>
                                <label for="capacidad_plan_3">Cumple</label>
                            </div>
                            <div class="invalid-feedback">Este campo es obligatorio.</div>
                        </div>
                        <div class="mb-3">
                            <label>¿La UE puede generar Puestos de Aprendizaje?</label>
                            <div>
                                <input type="radio" id="puestos_aprendizaje_1" name="seccion_2[puestos_aprendizaje]" value="1" {{ old('seccion_2.puestos_aprendizaje') == '1' ? 'checked' : '' }} required>
                                <label for="puestos_aprendizaje_1">No Cumple</label>
                                <input type="radio" id="puestos_aprendizaje_2" name="seccion_2[puestos_aprendizaje]" value="2" {{ old('seccion_2.puestos_aprendizaje') == '2' ? 'checked' : '' }} required>
                                <label for="puestos_aprendizaje_2">Socialmente</label>
                                <input type="radio" id="puestos_aprendizaje_3" name="seccion_2[puestos_aprendizaje]" value="3" {{ old('seccion_2.puestos_aprendizaje') == '3' ? 'checked' : '' }} required>
                                <label for="puestos_aprendizaje_3">Cumple</label>
                            </div>
                            <div class="invalid-feedback">Este campo es obligatorio.</div>
                        </div>
                        <button type="button" class="btn btn-secondary" onclick="prevStep()">Anterior</button>
                        <button type="button" class="btn btn-primary" onclick="nextStep()">Siguiente</button>
                    </div>
                    <div class="step">
                        <h4>Sección 3 - Factores Socioeconómicos</h4>
                        <div class="mb-3">
                            <label>¿La UE puede brindar apoyos económicos, transporte o alimentación?</label>
                            <div>
                                <input type="radio" id="apoyos_economicos_1" name="seccion_3[apoyos_economicos]" value="1" {{ old('seccion_3.apoyos_economicos') == '1' ? 'checked' : '' }} required>
                                <label for="apoyos_economicos_1">No Cumple</label>
                                <input type="radio" id="apoyos_economicos_2" name="seccion_3[apoyos_economicos]" value="2" {{ old('seccion_3.apoyos_economicos') == '2' ? 'checked' : '' }} required>
                                <label for="apoyos_economicos_2">Parcialmente</label>
                                <input type="radio" id="apoyos_economicos_3" name="seccion_3[apoyos_economicos]" value="3" {{ old('seccion_3.apoyos_economicos') == '3' ? 'checked' : '' }} required>
                                <label for="apoyos_economicos_3">Cumple</label>
                            </div>
                            <div class="invalid-feedback">Este campo es obligatorio.</div>
                        </div>
                        <div class="mb-3">
                            <label>¿La UE está ubicada a menos de 20 km de la institución educativa?</label>
                            <div>
                                <input type="radio" id="menos_20km_1" name="seccion_3[menos_20km]" value="1" {{ old('seccion_3.menos_20km') == '1' ? 'checked' : '' }} required>
                                <label for="menos_20km_1">No Cumple</label>
                                <input type="radio" id="menos_20km_2" name="seccion_3[menos_20km]" value="2" {{ old('seccion_3.menos_20km') == '2' ? 'checked' : '' }} required>
                                <label for="menos_20km_2">Parcialmente</label>
                                <input type="radio" id="menos_20km_3" name="seccion_3[menos_20km]" value="3" {{ old('seccion_3.menos_20km') == '3' ? 'checked' : '' }} required>
                                <label for="menos_20km_3">Cumple</label>
                            </div>
                            <div class="invalid-feedback">Este campo es obligatorio.</div>
                        </div>
                        <div class="mb-3">
                            <label>¿La UE realiza actividades seguras para los estudiantes?</label>
                            <div>
                                <input type="radio" id="actividades_seguras_1" name="seccion_3[actividades_seguras]" value="1" {{ old('seccion_3.actividades_seguras') == '1' ? 'checked' : '' }} required>
                                <label for="actividades_seguras_1">No Cumple</label>
                                <input type="radio" id="actividades_seguras_2" name="seccion_3[actividades_seguras]" value="2" {{ old('seccion_3.actividades_seguras') == '2' ? 'checked' : '' }} required>
                                <label for="actividades_seguras_2">Parcialmente</label>
                                <input type="radio" id="actividades_seguras_3" name="seccion_3[actividades_seguras]" value="3" {{ old('seccion_3.actividades_seguras') == '3' ? 'checked' : '' }} required>
                                <label for="actividades_seguras_3">Cumple</label>
                            </div>
                            <div class="invalid-feedback">Este campo es obligatorio.</div>
                        </div>
                        <button type="button" class="btn btn-secondary" onclick="prevStep()">Anterior</button>
                        <button type="button" class="btn btn-primary" onclick="nextStep()">Siguiente</button>
                    </div>
                </div>
                <button type="button" class="btn btn-primary" onclick="calculateResults()">Calcular Resultados</button>
                <button type="submit" class="btn btn-success">Guardar</button>
                <button type="button" class="btn btn-secondary" onclick="exportToPDF()">Exportar a PDF</button>
                <button type="button" class="btn btn-secondary" onclick="exportToWord()">Exportar a Word</button>
            </form>
        </div>
    </div>
</div>

<!-- Modal de Confirmación -->
<div id="confirmationModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeConfirmationModal()">&times;</span>
        <h2>Resumen de la Evaluación</h2>
        <div id="evaluationSummary"></div>
        <button type="button" class="btn btn-success" onclick="submitForm()">Confirmar</button>
        <button type="button" class="btn btn-secondary" onclick="closeConfirmationModal()">Cancelar</button>
    </div>
</div>

<script>
function calculateResults() {
    const seccion1 = document.querySelectorAll('input[name^="seccion_1"]:checked');
    const seccion2 = document.querySelectorAll('input[name^="seccion_2"]:checked');
    const seccion3 = document.querySelectorAll('input[name^="seccion_3"]:checked');

    const seccion1Total = Array.from(seccion1).reduce((acc, input) => acc + parseInt(input.value === 'Sí' ? 2 : 1), 0);
    const seccion2Total = Array.from(seccion2).reduce((acc, input) => acc + parseInt(input.value === 'Sí' ? 3 : input.value === 'Parcialmente' ? 2 : 1), 0);
    const seccion3Total = Array.from(seccion3).reduce((acc, input) => acc + parseInt(input.value === 'Sí' ? 3 : input.value === 'Parcialmente' ? 2 : 1), 0);

    const seccion1Percentage = (seccion1Total / 8) * 100;
    const seccion2Percentage = (seccion2Total / 18) * 100;
    const seccion3Percentage = (seccion3Total / 9) * 100;

    const finalPercentage = (seccion1Percentage + seccion2Percentage + seccion3Percentage) / 3;

    let interpretation = '';
    if (finalPercentage <= 45) {
        interpretation = 'Alta Vulnerabilidad; Unidad Económica no viable para incorporarse a ED.';
    } else if (finalPercentage <= 66) {
        interpretation = 'Mediana Vulnerabilidad; Unidad Económica con opción a incorporarse a ED.';
    } else {
        interpretation = 'Baja Vulnerabilidad; Unidad Económica apta para incorporar a ED.';
    }

    document.getElementById('evaluationSummary').innerHTML = `
        <p><strong>Unidad Económica:</strong> ${document.getElementById('unidad_economica').value}</p>
        <p><strong>Periodo:</strong> ${document.getElementById('periodo').value}</p>
        <p><strong>Fecha de Evaluación:</strong> ${document.getElementById('fecha').value}</p>
        <p><strong>Sección 1 - Situación Legal:</strong> ${seccion1Total} puntos (${seccion1Percentage.toFixed(2)}%)</p>
        <p><strong>Sección 2 - Situación Educativa/Formativa:</strong> ${seccion2Total} puntos (${seccion2Percentage.toFixed(2)}%)</p>
        <p><strong>Sección 3 - Factores Socioeconómicos:</strong> ${seccion3Total} puntos (${seccion3Percentage.toFixed(2)}%)</p>
        <p><strong>Resultado Final:</strong> ${finalPercentage.toFixed(2)}%</p>
        <p><strong>Interpretación:</strong> ${interpretation}</p>
    `;

    document.getElementById('confirmationModal').style.display = 'block';
}

function closeConfirmationModal() {
    document.getElementById('confirmationModal').style.display = 'none';
}

function submitForm() {
    document.getElementById('anexo2_1_form').submit();
}

function exportToPDF() {
    window.location.href = "{{ route('anexo2_1.export.pdf') }}";
}

function exportToWord() {
    window.location.href = "{{ route('anexo2_1.export.word') }}";
}

document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('anexo2_1_form').addEventListener('submit', function (e) {
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
</script>

<style>
.is-invalid {
    border-color: red;
}
.is-invalid .form-check-label {
    color: red;
}
.modal-content {
    background-color: #fefefe;
    margin: 10% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 60%;
    animation: fadeIn 0.5s;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
}
.close {
    font-weight: bold;
    font-size: 28px;
    float: right;
    color: #aaa;
}
</style>
@endsection
