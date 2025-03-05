@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Editar Anexo 2.1 - Evaluación de la UE</h3>
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
            <form action="{{ route('anexo2_1.update', $anexo2_1->id) }}" method="POST" id="anexo2_1_form">
                @csrf
                @method('PUT')
                <div class="stepper">
                    <div class="step">
                        <h4>Información General</h4>
                        <div class="mb-3">
                            <label for="unidad_economica" class="form-label">Unidad Económica</label>
                            <input type="text" class="form-control" id="unidad_economica" name="unidad_economica" value="{{ old('unidad_economica', $anexo2_1->unidad_economica) }}" required>
                            <div class="invalid-feedback">Este campo es obligatorio.</div>
                        </div>
                        <div class="mb-3">
                            <label for="periodo" class="form-label">Periodo</label>
                            <input type="text" class="form-control" id="periodo" name="periodo" value="{{ old('periodo', $anexo2_1->periodo) }}" required>
                            <div class="invalid-feedback">Este campo es obligatorio.</div>
                        </div>
                        <div class="mb-3">
                            <label for="fecha" class="form-label">Fecha de Evaluación</label>
                            <input type="date" class="form-control" id="fecha" name="fecha" value="{{ old('fecha', $anexo2_1->fecha) }}" required>
                            <div class="invalid-feedback">Este campo es obligatorio.</div>
                        </div>
                    </div>
                    <div class="step">
                        <h4>Situación Legal</h4>
                        <div class="mb-3">
                            <label>¿La UE está legalmente constituida?</label>
                            <div>
                                <input type="radio" id="legalmente_constituida_si" name="seccion_1[legalmente_constituida]" value="Sí" {{ old('seccion_1.legalmente_constituida', $anexo2_1->seccion_1['legalmente_constituida']) == 'Sí' ? 'checked' : '' }} required>
                                <label for="legalmente_constituida_si">Sí</label>
                                <input type="radio" id="legalmente_constituida_no" name="seccion_1[legalmente_constituida]" value="No" {{ old('seccion_1.legalmente_constituida', $anexo2_1->seccion_1['legalmente_constituida']) == 'No' ? 'checked' : '' }} required>
                                <label for="legalmente_constituida_no">No</label>
                            </div>
                            <div class="invalid-feedback">Este campo es obligatorio.</div>
                        </div>
                        <div class="mb-3">
                            <label>¿La UE está dispuesta a firmar el Convenio Específico de Cooperación?</label>
                            <div>
                                <input type="radio" id="convenio_cooperacion_si" name="seccion_1[convenio_cooperacion]" value="Sí" {{ old('seccion_1.convenio_cooperacion', $anexo2_1->seccion_1['convenio_cooperacion']) == 'Sí' ? 'checked' : '' }} required>
                                <label for="convenio_cooperacion_si">Sí</label>
                                <input type="radio" id="convenio_cooperacion_no" name="seccion_1[convenio_cooperacion]" value="No" {{ old('seccion_1.convenio_cooperacion', $anexo2_1->seccion_1['convenio_cooperacion']) == 'No' ? 'checked' : '' }} required>
                                <label for="convenio_cooperacion_no">No</label>
                            </div>
                            <div class="invalid-feedback">Este campo es obligatorio.</div>
                        </div>
                        <div class="mb-3">
                            <label>¿La UE está dispuesta a firmar el Convenio de Aprendizaje?</label>
                            <div>
                                <input type="radio" id="convenio_aprendizaje_si" name="seccion_1[convenio_aprendizaje]" value="Sí" {{ old('seccion_1.convenio_aprendizaje', $anexo2_1->seccion_1['convenio_aprendizaje']) == 'Sí' ? 'checked' : '' }} required>
                                <label for="convenio_aprendizaje_si">Sí</label>
                                <input type="radio" id="convenio_aprendizaje_no" name="seccion_1[convenio_aprendizaje]" value="No" {{ old('seccion_1.convenio_aprendizaje', $anexo2_1->seccion_1['convenio_aprendizaje']) == 'No' ? 'checked' : '' }} required>
                                <label for="convenio_aprendizaje_no">No</label>
                            </div>
                            <div class="invalid-feedback">Este campo es obligatorio.</div>
                        </div>
                        <div class="mb-3">
                            <label>¿La UE está dispuesta a firmar el Convenio Marco de Colaboración?</label>
                            <div>
                                <input type="radio" id="convenio_marco_si" name="seccion_1[convenio_marco]" value="Sí" {{ old('seccion_1.convenio_marco', $anexo2_1->seccion_1['convenio_marco']) == 'Sí' ? 'checked' : '' }} required>
                                <label for="convenio_marco_si">Sí</label>
                                <input type="radio" id="convenio_marco_no" name="seccion_1[convenio_marco]" value="No" {{ old('seccion_1.convenio_marco', $anexo2_1->seccion_1['convenio_marco']) == 'No' ? 'checked' : '' }} required>
                                <label for="convenio_marco_no">No</label>
                            </div>
                            <div class="invalid-feedback">Este campo es obligatorio.</div>
                        </div>
                    </div>
                    <div class="step">
                        <h4>Situación Educativa/Formativa</h4>
                        <div class="mb-3">
                            <label>¿La UE cuenta con personal capacitado?</label>
                            <div>
                                <input type="radio" id="personal_capacitado_si" name="seccion_2[personal_capacitado]" value="Sí" {{ old('seccion_2.personal_capacitado', $anexo2_1->seccion_2['personal_capacitado']) == 'Sí' ? 'checked' : '' }} required>
                                <label for="personal_capacitado_si">Sí</label>
                                <input type="radio" id="personal_capacitado_no" name="seccion_2[personal_capacitado]" value="No" {{ old('seccion_2.personal_capacitado', $anexo2_1->seccion_2['personal_capacitado']) == 'No' ? 'checked' : '' }} required>
                                <label for="personal_capacitado_no">No</label>
                            </div>
                            <div class="invalid-feedback">Este campo es obligatorio.</div>
                        </div>
                        <div class="mb-3">
                            <label>¿La UE cuenta con áreas especializadas?</label>
                            <div>
                                <input type="radio" id="areas_especializadas_si" name="seccion_2[areas_especializadas]" value="Sí" {{ old('seccion_2.areas_especializadas', $anexo2_1->seccion_2['areas_especializadas']) == 'Sí' ? 'checked' : '' }} required>
                                <label for="areas_especializadas_si">Sí</label>
                                <input type="radio" id="areas_especializadas_no" name="seccion_2[areas_especializadas]" value="No" {{ old('seccion_2.areas_especializadas', $anexo2_1->seccion_2['areas_especializadas']) == 'No' ? 'checked' : '' }} required>
                                <label for="areas_especializadas_no">No</label>
                            </div>
                            <div class="invalid-feedback">Este campo es obligatorio.</div>
                        </div>
                        <div class="mb-3">
                            <label>¿La UE puede designar un mentor con título de licenciatura?</label>
                            <div>
                                <input type="radio" id="mentor_licenciatura_si" name="seccion_2[mentor_licenciatura]" value="Sí" {{ old('seccion_2.mentor_licenciatura', $anexo2_1->seccion_2['mentor_licenciatura']) == 'Sí' ? 'checked' : '' }} required>
                                <label for="mentor_licenciatura_si">Sí</label>
                                <input type="radio" id="mentor_licenciatura_no" name="seccion_2[mentor_licenciatura]" value="No" {{ old('seccion_2.mentor_licenciatura', $anexo2_1->seccion_2['mentor_licenciatura']) == 'No' ? 'checked' : '' }} required>
                                <label for="mentor_licenciatura_no">No</label>
                            </div>
                            <div class="invalid-feedback">Este campo es obligatorio.</div>
                        </div>
                        <div class="mb-3">
                            <label>¿La UE puede cumplir con un plan de formación?</label>
                            <div>
                                <input type="radio" id="plan_formacion_si" name="seccion_2[plan_formacion]" value="Sí" {{ old('seccion_2.plan_formacion', $anexo2_1->seccion_2['plan_formacion']) == 'Sí' ? 'checked' : '' }} required>
                                <label for="plan_formacion_si">Sí</label>
                                <input type="radio" id="plan_formacion_no" name="seccion_2[plan_formacion]" value="No" {{ old('seccion_2.plan_formacion', $anexo2_1->seccion_2['plan_formacion']) == 'No' ? 'checked' : '' }} required>
                                <label for="plan_formacion_no">No</label>
                            </div>
                            <div class="invalid-feedback">Este campo es obligatorio.</div>
                        </div>
                        <div class="mb-3">
                            <label>¿La UE tiene capacidad para llevar a cabo el plan de formación por 1-3 años?</label>
                            <div>
                                <input type="radio" id="capacidad_plan_si" name="seccion_2[capacidad_plan]" value="Sí" {{ old('seccion_2.capacidad_plan', $anexo2_1->seccion_2['capacidad_plan']) == 'Sí' ? 'checked' : '' }} required>
                                <label for="capacidad_plan_si">Sí</label>
                                <input type="radio" id="capacidad_plan_no" name="seccion_2[capacidad_plan]" value="No" {{ old('seccion_2.capacidad_plan', $anexo2_1->seccion_2['capacidad_plan']) == 'No' ? 'checked' : '' }} required>
                                <label for="capacidad_plan_no">No</label>
                            </div>
                            <div class="invalid-feedback">Este campo es obligatorio.</div>
                        </div>
                        <div class="mb-3">
                            <label>¿La UE puede generar Puestos de Aprendizaje?</label>
                            <div>
                                <input type="radio" id="puestos_aprendizaje_si" name="seccion_2[puestos_aprendizaje]" value="Sí" {{ old('seccion_2.puestos_aprendizaje', $anexo2_1->seccion_2['puestos_aprendizaje']) == 'Sí' ? 'checked' : '' }} required>
                                <label for="puestos_aprendizaje_si">Sí</label>
                                <input type="radio" id="puestos_aprendizaje_no" name="seccion_2[puestos_aprendizaje]" value="No" {{ old('seccion_2.puestos_aprendizaje', $anexo2_1->seccion_2['puestos_aprendizaje']) == 'No' ? 'checked' : '' }} required>
                                <label for="puestos_aprendizaje_no">No</label>
                            </div>
                            <div class="invalid-feedback">Este campo es obligatorio.</div>
                        </div>
                    </div>
                    <div class="step">
                        <h4>Factores Socioeconómicos</h4>
                        <div class="mb-3">
                            <label>¿La UE puede brindar apoyos económicos, transporte o alimentación?</label>
                            <div>
                                <input type="radio" id="apoyos_economicos_si" name="seccion_3[apoyos_economicos]" value="Sí" {{ old('seccion_3.apoyos_economicos', $anexo2_1->seccion_3['apoyos_economicos']) == 'Sí' ? 'checked' : '' }} required>
                                <label for="apoyos_economicos_si">Sí</label>
                                <input type="radio" id="apoyos_economicos_no" name="seccion_3[apoyos_economicos]" value="No" {{ old('seccion_3.apoyos_economicos', $anexo2_1->seccion_3['apoyos_economicos']) == 'No' ? 'checked' : '' }} required>
                                <label for="apoyos_economicos_no">No</label>
                            </div>
                            <div class="invalid-feedback">Este campo es obligatorio.</div>
                        </div>
                        <div class="mb-3">
                            <label>¿La UE está a menos de 20 km de la IE?</label>
                            <div>
                                <input type="radio" id="menos_20km_si" name="seccion_3[menos_20km]" value="Sí" {{ old('seccion_3.menos_20km', $anexo2_1->seccion_3['menos_20km']) == 'Sí' ? 'checked' : '' }} required>
                                <label for="menos_20km_si">Sí</label>
                                <input type="radio" id="menos_20km_no" name="seccion_3[menos_20km]" value="No" {{ old('seccion_3.menos_20km', $anexo2_1->seccion_3['menos_20km']) == 'No' ? 'checked' : '' }} required>
                                <label for="menos_20km_no">No</label>
                            </div>
                            <div class="invalid-feedback">Este campo es obligatorio.</div>
                        </div>
                        <div class="mb-3">
                            <label>¿La UE cuida que las actividades no sean peligrosas para los estudiantes?</label>
                            <div>
                                <input type="radio" id="actividades_seguras_si" name="seccion_3[actividades_seguras]" value="Sí" {{ old('seccion_3.actividades_seguras', $anexo2_1->seccion_3['actividades_seguras']) == 'Sí' ? 'checked' : '' }} required>
                                <label for="actividades_seguras_si">Sí</label>
                                <input type="radio" id="actividades_seguras_no" name="seccion_3[actividades_seguras]" value="No" {{ old('seccion_3.actividades_seguras', $anexo2_1->seccion_3['actividades_seguras']) == 'No' ? 'checked' : '' }} required>
                                <label for="actividades_seguras_no">No</label>
                            </div>
                            <div class="invalid-feedback">Este campo es obligatorio.</div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Guardar</button>
            </form>
        </div>
    </div>
</div>

<style>
.stepper {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.step {
    border: 1px solid #ddd;
    padding: 20px;
    border-radius: 5px;
    background-color: #f9f9f9;
}

.is-invalid {
    border-color: red;
}
.is-invalid .form-check-label {
    color: red;
}
</style>
@endsection
