@extends('layouts.app')
@section('title', 'Crear Anexo 1.3')
@section('styles')

@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <x-forms.section-header title="Editar Anexo 2.1 - Evaluación de la UE" description="" />

                <div class="card-body">
                    <form action="{{ route('anexo2_1.update', $anexo2_1->id) }}" method="POST" id="anexo2_1_form">
                        @csrf
                        @method('PUT')
                        <!-- Información General -->
                        <div class="mb-4">
                            <h5 class="section-title fw-bold">Información General</h5>
                            <div class="dropdown-divider mb-4"></div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="direccion_id" class="form-label">Unidad Económica <span
                                            class="text-danger">*</span></label>
                                    <input type="text" data-tipo="text" class="form-control" id="unidad_economica"
                                        name="unidad_economica"
                                        value="{{ old('unidad_economica', $anexo2_1->unidad_economica) }}" required>
                                    @error('fecha_realizacion')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="quien_elaboro_id" class="form-label">Periodo <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="periodo" name="periodo"
                                        value="{{ old('periodo', $anexo2_1->periodo) }}" required>
                                    @error('lugar')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="" class="form-label">Fecha de Evaluación </label>
                                    <input type="date" class="form-control" id="fecha" name="fecha"
                                        value="{{ old('fecha', $anexo2_1->fecha) }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="" class="form-label">Aplicador </label>
                                    <input type="text" class="form-control" id="aplicador" name="aplicador"
                                        value="{{ old('aplicador', $anexo2_1->aplicador) }}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="" class="form-label">Autorizó </label>
                                    <select class="form-control @error('autorizo') is-invalid @enderror" id="autorizo"
                                        name="autorizo" required>
                                        @foreach ($directores as $director)
                                            <option value="{{ $director->id }}"
                                                {{ old('autorizo') == $director->id ? 'selected' : '' }}>
                                                {{ $director->name . ' ' . $director->apellidoP . ' ' . $director->apellidoM }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Criterios de Evaluación -->
                        <div class="mb-4">
                            <h5 class="section-title fw-bold">Criterios de Evaluación</h5>
                            <div class="dropdown-divider mb-4"></div>

                            <div class="row">
                                <!-- Sección 1 - Situación Legal -->
                                <h4>Sección 1 - Situación Legal</h4>
                                <table class="table ms-3 mt-3">
                                    <thead>
                                        <tr>
                                            <th>Pregunta</th>
                                            <th>Sí</th>
                                            <th>No</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>¿La UE está legalmente constituida?</td>
                                            <td>
                                                <input type="radio" name="seccion_1[legalmente_constituida]"
                                                    value="1"
                                                    {{ old('seccion_1.legalmente_constituida', $anexo2_1->seccion_1['legalmente_constituida']) == '1' ? 'checked' : '' }}
                                                    required>
                                            </td>
                                            <td>
                                                <input type="radio" name="seccion_1[legalmente_constituida]"
                                                    value="0"
                                                    {{ old('seccion_1.legalmente_constituida', $anexo2_1->seccion_1['legalmente_constituida']) == '0' ? 'checked' : '' }}
                                                    required>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>¿La UE está dispuesta a firmar el Convenio Específico de Cooperación?</td>
                                            <td><input type="radio" name="seccion_1[convenio_cooperacion]" value="1"
                                                    {{ old('seccion_1.convenio_cooperacion', $anexo2_1->seccion_1['convenio_cooperacion']) == '1' ? 'checked' : '' }}
                                                    required></td>
                                            <td><input type="radio" name="seccion_1[convenio_cooperacion]" value="0"
                                                    {{ old('seccion_1.convenio_cooperacion', $anexo2_1->seccion_1['convenio_cooperacion']) == '0' ? 'checked' : '' }}
                                                    required></td>
                                        </tr>
                                        <tr>
                                            <td>¿La UE está dispuesta a firmar el Convenio de Aprendizaje?</td>
                                            <td><input type="radio" name="seccion_1[convenio_aprendizaje]" value="1"
                                                    {{ old('seccion_1.convenio_aprendizaje', $anexo2_1->seccion_1['convenio_aprendizaje']) == '1' ? 'checked' : '' }}
                                                    required></td>
                                            <td><input type="radio" name="seccion_1[convenio_aprendizaje]" value="0"
                                                    {{ old('seccion_1.convenio_aprendizaje', $anexo2_1->seccion_1['convenio_aprendizaje']) == '0' ? 'checked' : '' }}
                                                    required></td>
                                        </tr>
                                        <tr>
                                            <td>¿La UE está dispuesta a firmar el Convenio Marco de Colaboración?</td>
                                            <td><input type="radio" name="seccion_1[convenio_marco]" value="1"
                                                    {{ old('seccion_1.convenio_marco', $anexo2_1->seccion_1['convenio_marco']) == '1' ? 'checked' : '' }}
                                                    required></td>
                                            <td><input type="radio" name="seccion_1[convenio_marco]" value="0"
                                                    {{ old('seccion_1.convenio_marco', $anexo2_1->seccion_1['convenio_marco']) == '0' ? 'checked' : '' }}
                                                    required></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row mt-4">
                                <!-- Sección 2 - Situación Educativa/Formativa -->
                                <h4>Sección 2 - Situación Educativa/Formativa</h4>
                                <table class="table ms-3 mt-3">
                                    <thead>
                                        <tr>
                                            <th>Pregunta</th>
                                            <th>No Cumple</th>
                                            <th>Parcialmente</th>
                                            <th>Cumple</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>¿La UE cuenta con personal capacitado?</td>
                                            <td><input type="radio" name="seccion_2[personal_capacitado]" value="1"
                                                    {{ old('seccion_2.personal_capacitado', $anexo2_1->seccion_2['personal_capacitado']) == '1' ? 'checked' : '' }}
                                                    required></td>
                                            <td><input type="radio" name="seccion_2[personal_capacitado]" value="2"
                                                    {{ old('seccion_2.personal_capacitado', $anexo2_1->seccion_2['personal_capacitado']) == '2' ? 'checked' : '' }}
                                                    required></td>
                                            <td><input type="radio" name="seccion_2[personal_capacitado]" value="3"
                                                    {{ old('seccion_2.personal_capacitado', $anexo2_1->seccion_2['personal_capacitado']) == '3' ? 'checked' : '' }}
                                                    required></td>
                                        </tr>
                                        <tr>
                                            <td>¿La UE cuenta con áreas especializadas?</td>
                                            <td><input type="radio" name="seccion_2[areas_especializadas]"
                                                    value="1"
                                                    {{ old('seccion_2.areas_especializadas', $anexo2_1->seccion_2['areas_especializadas']) == '1' ? 'checked' : '' }}
                                                    required></td>
                                            <td><input type="radio" name="seccion_2[areas_especializadas]"
                                                    value="2"
                                                    {{ old('seccion_2.areas_especializadas', $anexo2_1->seccion_2['areas_especializadas']) == '2' ? 'checked' : '' }}
                                                    required></td>
                                            <td><input type="radio" name="seccion_2[areas_especializadas]"
                                                    value="3"
                                                    {{ old('seccion_2.areas_especializadas', $anexo2_1->seccion_2['areas_especializadas']) == '3' ? 'checked' : '' }}
                                                    required></td>
                                        </tr>
                                        <tr>
                                            <td>¿La UE puede designar un mentor con título de licenciatura?</td>
                                            <td><input type="radio" name="seccion_2[mentor_licenciatura]"
                                                    value="1"
                                                    {{ old('seccion_2.mentor_licenciatura', $anexo2_1->seccion_2['mentor_licenciatura']) == '1' ? 'checked' : '' }}
                                                    required></td>
                                            <td><input type="radio" name="seccion_2[mentor_licenciatura]"
                                                    value="2"
                                                    {{ old('seccion_2.mentor_licenciatura', $anexo2_1->seccion_2['mentor_licenciatura']) == '2' ? 'checked' : '' }}
                                                    required></td>
                                            <td><input type="radio" name="seccion_2[mentor_licenciatura]"
                                                    value="3"
                                                    {{ old('seccion_2.mentor_licenciatura', $anexo2_1->seccion_2['mentor_licenciatura']) == '3' ? 'checked' : '' }}
                                                    required></td>
                                        </tr>
                                        <tr>
                                            <td>¿La UE puede cumplir con un plan de formación?</td>
                                            <td><input type="radio" name="seccion_2[plan_formacion]" value="1"
                                                    {{ old('seccion_2.plan_formacion', $anexo2_1->seccion_2['plan_formacion']) == '1' ? 'checked' : '' }}
                                                    required></td>
                                            <td><input type="radio" name="seccion_2[plan_formacion]" value="2"
                                                    {{ old('seccion_2.plan_formacion', $anexo2_1->seccion_2['plan_formacion']) == '2' ? 'checked' : '' }}
                                                    required></td>
                                            <td><input type="radio" name="seccion_2[plan_formacion]" value="3"
                                                    {{ old('seccion_2.plan_formacion', $anexo2_1->seccion_2['plan_formacion']) == '3' ? 'checked' : '' }}
                                                    required></td>
                                        </tr>
                                        <tr>
                                            <td>¿La UE tiene capacidad para llevar a cabo el plan de formación por 1-3 años?
                                            </td>
                                            <td><input type="radio" name="seccion_2[capacidad_plan]" value="1"
                                                    {{ old('seccion_2.capacidad_plan', $anexo2_1->seccion_2['capacidad_plan']) == '1' ? 'checked' : '' }}
                                                    required></td>
                                            <td><input type="radio" name="seccion_2[capacidad_plan]" value="2"
                                                    {{ old('seccion_2.capacidad_plan', $anexo2_1->seccion_2['capacidad_plan']) == '2' ? 'checked' : '' }}
                                                    required></td>
                                            <td><input type="radio" name="seccion_2[capacidad_plan]" value="3"
                                                    {{ old('seccion_2.capacidad_plan', $anexo2_1->seccion_2['capacidad_plan']) == '3' ? 'checked' : '' }}
                                                    required></td>
                                        </tr>
                                        <tr>
                                            <td>¿La UE puede generar Puestos de Aprendizaje?</td>
                                            <td><input type="radio" name="seccion_2[puestos_aprendizaje]"
                                                    value="1"
                                                    {{ old('seccion_2.puestos_aprendizaje', $anexo2_1->seccion_2['puestos_aprendizaje']) == '1' ? 'checked' : '' }}
                                                    required></td>
                                            <td><input type="radio" name="seccion_2[puestos_aprendizaje]"
                                                    value="2"
                                                    {{ old('seccion_2.puestos_aprendizaje', $anexo2_1->seccion_2['puestos_aprendizaje']) == '2' ? 'checked' : '' }}
                                                    required></td>
                                            <td><input type="radio" name="seccion_2[puestos_aprendizaje]"
                                                    value="3"
                                                    {{ old('seccion_2.puestos_aprendizaje', $anexo2_1->seccion_2['puestos_aprendizaje']) == '3' ? 'checked' : '' }}
                                                    required></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row mt-4">
                                <!-- Sección 3 - Factores Socioeconómicos -->
                                <h4>Sección 3 - Factores Socioeconómicos</h4>
                                <table class="table ms-3 mt-3">
                                    <thead>
                                        <tr>
                                            <th>Pregunta</th>
                                            <th>No Cumple</th>
                                            <th>Parcialmente</th>
                                            <th>Cumple</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>¿La UE puede brindar apoyos económicos, transporte o alimentación?</td>
                                            <td><input type="radio" name="seccion_3[apoyos_economicos]" value="1"
                                                    {{ old('seccion_3.apoyos_economicos', $anexo2_1->seccion_3['apoyos_economicos']) == '1' ? 'checked' : '' }}
                                                    required></td>
                                            <td><input type="radio" name="seccion_3[apoyos_economicos]" value="2"
                                                    {{ old('seccion_3.apoyos_economicos', $anexo2_1->seccion_3['apoyos_economicos']) == '2' ? 'checked' : '' }}
                                                    required></td>
                                            <td><input type="radio" name="seccion_3[apoyos_economicos]" value="3"
                                                    {{ old('seccion_3.apoyos_economicos', $anexo2_1->seccion_3['apoyos_economicos']) == '3' ? 'checked' : '' }}
                                                    required></td>
                                        </tr>
                                        <tr>
                                            <td>¿La UE está a menos de 20 km de la IE?</td>
                                            <td><input type="radio" name="seccion_3[menos_20km]" value="1"
                                                    {{ old('seccion_3.menos_20km', $anexo2_1->seccion_3['menos_20km']) == '1' ? 'checked' : '' }}
                                                    required></td>
                                            <td><input type="radio" name="seccion_3[menos_20km]" value="2"
                                                    {{ old('seccion_3.menos_20km', $anexo2_1->seccion_3['menos_20km']) == '2' ? 'checked' : '' }}
                                                    required></td>
                                            <td><input type="radio" name="seccion_3[menos_20km]" value="3"
                                                    {{ old('seccion_3.menos_20km', $anexo2_1->seccion_3['menos_20km']) == '3' ? 'checked' : '' }}
                                                    required></td>
                                        </tr>
                                        <tr>
                                            <td>¿La UE cuida que las actividades no sean peligrosas para los estudiantes?
                                            </td>
                                            <td><input type="radio" name="seccion_3[actividades_seguras]"
                                                    value="1"
                                                    {{ old('seccion_3.actividades_seguras', $anexo2_1->seccion_3['actividades_seguras']) == '1' ? 'checked' : '' }}
                                                    required></td>
                                            <td><input type="radio" name="seccion_3[actividades_seguras]"
                                                    value="2"
                                                    {{ old('seccion_3.actividades_seguras', $anexo2_1->seccion_3['actividades_seguras']) == '2' ? 'checked' : '' }}
                                                    required></td>
                                            <td><input type="radio" name="seccion_3[actividades_seguras]"
                                                    value="3"
                                                    {{ old('seccion_3.actividades_seguras', $anexo2_1->seccion_3['actividades_seguras']) == '3' ? 'checked' : '' }}
                                                    required></td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>

                        <!-- Botones de Acción -->
                        <div class="navigation-buttons" style="margin-bottom: 60px;">
                            <x-buttons.success-button text="Actualizar" />
                            <x-buttons.cancel-button url="{{ route('anexo2_1.index') }}" />
                        </div>

                        {{-- progress-container --}}
                        <div id="progress-container"
                            style="position: fixed; bottom: 0; left: 0; width: 100%; background: #f8f9fa; padding: 10px; box-shadow: 0 -2px 5px rgba(0,0,0,0.1);">
                            <div id="progress-bar"
                                style="width: 0; height: 30px; border-radius: 5px; text-align: center; line-height: 30px; color: white;">
                            </div>
                            <p id="progress-message" style="text-align: center; margin-top: 10px;"></p>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.getElementById('anexo2_1_form').addEventListener('input', function() {
            const progressBar = document.getElementById('progress-bar');
            const progressMessage = document.getElementById('progress-message');
            const progressContainer = document.getElementById('progress-container');
            const porcentaje = calcularPorcentaje(); // Implementar esta función para calcular el porcentaje
            progressBar.style.width = porcentaje + '%';
            progressBar.textContent = porcentaje.toFixed(2) + '%';

            if (porcentaje <= 45) {
                progressBar.style.backgroundColor = '#ff4d4d';
                progressMessage.textContent =
                    'Alta Vulnerabilidad: La UE no es viable para incorporarse a la Educación Dual.';
            } else if (porcentaje <= 66) {
                progressBar.style.backgroundColor = '#ffcc00';
                progressMessage.textContent =
                    'Mediana Vulnerabilidad: La UE tiene opción a incorporarse, pero requiere mejoras.';
            } else {
                progressBar.style.backgroundColor = '#4caf50';
                progressMessage.textContent =
                    'Baja Vulnerabilidad: La UE es apta para incorporarse a la Educación Dual.';
            }

            progressContainer.style.display = 'block';
            progressBar.style.transition = 'width 1s';

        });

        function calcularPorcentaje() {
            // Implementar la lógica para calcular el porcentaje basado en las respuestas del formulario
            const seccion1 = document.querySelectorAll('input[name^="seccion_1"]:checked');
            const seccion2 = document.querySelectorAll('input[name^="seccion_2"]:checked');
            const seccion3 = document.querySelectorAll('input[name^="seccion_3"]:checked');

            //  const puntosSeccion1 = Array.from(seccion1).reduce((acc, input) => acc + (input.value === 'Sí' ? 1 : 0), 0);
            const puntosSeccion1 = Array.from(seccion1).reduce((acc, input) => acc + parseInt(input.value), 0);
            const puntosSeccion2 = Array.from(seccion2).reduce((acc, input) => acc + parseInt(input.value), 0);
            const puntosSeccion3 = Array.from(seccion3).reduce((acc, input) => acc + parseInt(input.value), 0);

            //const maxSeccion1 = 8;
            const maxSeccion1 = 4;
            const maxSeccion2 = 18;
            const maxSeccion3 = 9;

            const porcentajeSeccion1 = (puntosSeccion1 / maxSeccion1) * 100;
            const porcentajeSeccion2 = (puntosSeccion2 / maxSeccion2) * 100;
            const porcentajeSeccion3 = (puntosSeccion3 / maxSeccion3) * 100;

            return (porcentajeSeccion1 + porcentajeSeccion2 + porcentajeSeccion3) / 3;
        }
    </script>
@endsection
