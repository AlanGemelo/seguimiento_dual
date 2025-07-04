@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/listas.css') }}">

    <body class="body">
    <div class="container">
        <div class="card">
            <div class="card-header-adjusted">
                <h3 class="card-title">Editar Anexo 1.3 - Formato de Registro de Interesados de UE y Estudiantes ED</h3>
                <!-- Botón de Ayuda -->
                <button type="button" class="btn btn-help" onclick="openHelpModal()">
                    ¿Necesitas ayuda? 🔍
                </button>
            </div>
            <div class="card-body">
                <form action="{{ route('anexo1_3.update', $anexo1_3->id) }}" method="POST" id="anexo1_3_form">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="fecha_realizacion" class="form-label">Fecha de Realización</label>
                            <input type="date" class="form-control" id="fecha_realizacion" name="fecha_realizacion"
                                value="{{ \Carbon\Carbon::parse($anexo1_3->fecha_realizacion)->format('Y-m-d') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="lugar" class="form-label">Lugar</label>
                            <input type="text" class="form-control" id="lugar" name="lugar"
                                value="{{ $anexo1_3->lugar }}" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="razon_social" class="form-label">Razón Social</label>
                            <input type="text" data-tipo="text" class="form-control" id="razon_social"
                                name="razon_social" value="{{ $anexo1_3->razon_social }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="rfc" class="form-label">RFC</label>
                            <input type="text" data-tipo="rcf" class="form-control uppercase" id="rfc"
                                name="rfc" value="{{ $anexo1_3->rfc }}" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="domicilio" class="form-label">Domicilio</label>
                            <input type="text" class="form-control" id="domicilio" name="domicilio"
                                value="{{ $anexo1_3->domicilio }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="nombre_representante" class="form-label">Nombre del Representante</label>
                            <input type="text" data-tipo="text" class="form-control" id="nombre_representante"
                                name="nombre_representante" value="{{ $anexo1_3->nombre_representante }}" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="cargo_representante" class="form-label">Cargo del Representante</label>
                            <input type="text" class="form-control" id="cargo_representante" name="cargo_representante"
                                value="{{ $anexo1_3->cargo_representante }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="text" data-tipo="numbers" class="form-control" id="telefono" name="telefono"
                                value="{{ $anexo1_3->telefono }}" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="correo_electronico" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="correo_electronico" name="correo_electronico"
                                value="{{ $anexo1_3->correo_electronico }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="actividad_economica" class="form-label">Actividad Económica</label>
                            <input type="text" data-tipo="text" class="form-control" id="actividad_economica"
                                name="actividad_economica" value="{{ $anexo1_3->actividad_economica }}" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="numero_empleados" class="form-label">Número de Empleados</label>
                            <input type="number" data-tipo="numbers" class="form-control" id="numero_empleados"
                                name="numero_empleados" value="{{ $anexo1_3->numero_empleados }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="participacion_anterior" class="form-label">¿Ha participado anteriormente en
                                Educación Dual?</label>
                            <select class="form-control" id="participacion_anterior" name="participacion_anterior"
                                required>
                                <option value="1" {{ $anexo1_3->participacion_anterior ? 'selected' : '' }}>Sí
                                </option>
                                <option value="0" {{ !$anexo1_3->participacion_anterior ? 'selected' : '' }}>No
                                </option>
                            </select>
                        </div>
                    </div>
                    @if (!$anexo1_3->participacion_anterior)
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="motivo_no_participacion" class="form-label">Motivo de no participación</label>
                                <textarea class="form-control" id="motivo_no_participacion" name="motivo_no_participacion">{{ $anexo1_3->motivo_no_participacion }}</textarea>
                            </div>
                        </div>
                    @endif
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="interes_participar" class="form-label">¿Tiene interés en participar en Educación
                                Dual?</label>
                            <select class="form-control" id="interes_participar" name="interes_participar" required>
                                <option value="1" {{ $anexo1_3->interes_participar ? 'selected' : '' }}>Sí</option>
                                <option value="0" {{ !$anexo1_3->interes_participar ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                    </div>
                    @if ($anexo1_3->interes_participar)
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="numero_estudiantes" class="form-label">Número de estudiantes que podría
                                    recibir</label>
                                <input type="number" data-tipo="numbers" class="form-control" id="numero_estudiantes"
                                    name="numero_estudiantes" value="{{ $anexo1_3->numero_estudiantes }}">
                            </div>
                        </div>
                    @else
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="motivo_no_interes" class="form-label">Motivo de no interés</label>
                                <textarea class="form-control" id="motivo_no_interes" name="motivo_no_interes">{{ $anexo1_3->motivo_no_interes }}</textarea>
                            </div>
                        </div>
                    @endif
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="informacion_clara" class="form-label">¿La información proporcionada fue
                                clara?</label>
                            <select class="form-control" id="informacion_clara" name="informacion_clara" required>
                                <option value="1" {{ $anexo1_3->informacion_clara ? 'selected' : '' }}>Sí</option>
                                <option value="0" {{ !$anexo1_3->informacion_clara ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="comentarios_adicionales" class="form-label">Comentarios adicionales</label>
                            <textarea class="form-control" id="comentarios_adicionales" name="comentarios_adicionales">{{ $anexo1_3->comentarios_adicionales }}</textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="quien_elaboro_id" class="form-label">Quién Elaboró</label>
                            <input type="text" class="form-control"
                                value="{{ $responsableIE->name . '' . $responsableIE->apellidoP . ' ' . $responsableIE->apellidoM }}"
                                disabled>
                            <input type="hidden" name="quien_elaboro_id" value="{{ $responsableIE->id }}">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <a href="{{ route('anexo1_3.index') }}" class="btn btn-danger">Cancelar</a>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal de Ayuda -->
    <div id="helpModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeHelpModal()">&times;</span>
            <h2>Guía de Referencias para el Anexo 1.3</h2>
            <ol>
                <li><strong>Referencia 1:</strong> Registrar en qué sitio se llevó a cabo la actividad (salón, auditorio,
                    instalaciones externas, etc.).</li>
                <li><strong>Referencia 2:</strong> Registrar el folio consecutivo correspondiente.</li>
                <li><strong>Referencia 3:</strong> Colocar el nombre completo de quien realiza la actividad.</li>
                <li><strong>Referencia 4:</strong> Describir la actividad realizada.</li>
                <li><strong>Referencia 5:</strong> Indicar el número de asistentes.</li>
                <li><strong>Referencia 6:</strong> Registrar el nombre de la institución educativa.</li>
                <li><strong>Referencia 7:</strong> Registrar el nombre del programa educativo.</li>
                <li><strong>Referencia 8:</strong> Indicar el nombre del responsable de la actividad.</li>
                <li><strong>Referencia 9:</strong> Registrar el cargo del responsable de la actividad.</li>
                <li><strong>Referencia 10:</strong> Indicar el teléfono de contacto del responsable.</li>
                <li><strong>Referencia 11:</strong> Registrar el correo electrónico del responsable.</li>
                <li><strong>Referencia 12:</strong> Describir la participación de la unidad económica en la actividad.</li>
                <li><strong>Referencia 13:</strong> Indicar el número de estudiantes que participaron en la actividad.</li>
                <li><strong>Referencia 14:</strong> Registrar el nombre del representante de la unidad económica.</li>
                <li><strong>Referencia 15:</strong> Indicar el cargo del representante de la unidad económica.</li>
                <li><strong>Referencia 16:</strong> Registrar el teléfono de contacto del representante de la unidad
                    económica.</li>
                <li><strong>Referencia 17:</strong> Indicar el correo electrónico del representante de la unidad económica.
                </li>
            </ol>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
    </body>