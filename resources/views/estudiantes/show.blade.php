@php
    use Illuminate\Support\Facades\Storage;
@endphp
@extends('layouts.app')
@section('title', 'Mostrar Estudiante')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <!-- Encabezado -->
                <x-forms.section-header title="Datos del Estudiante Dual"
                    description="Visualización de la información personal del estudiante dual." />

                <div class="card-body">
                    <!-- Información General -->

                    <div class="mb-4">
                        <h5 class="section-title fw-bold ">Identificación del Estudiante</h5>
                        <div class="dropdown-divider mb-4"></div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="matricula" class="form-label">Matrícula </label>
                                <input type="number" class="form-control form-control-lg" id="matricula" name="matricula"
                                    value="{{ $estudiante->matricula }}" disabled>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="email" class="form-label">Correo electrónico institucional </label>
                                <input type="email" class="form-control form-control-lg"
                                    value="{{ $estudiante->user->email ?? 'al' . $estudiante->matricula . '@utvtol.edu.mx' }}"
                                    disabled>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="name" class="form-label">Nombre(s) <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg" id="name"
                                        placeholder="Nombre(s)" name="name" value="{{ $estudiante->name }}" disabled>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="apellidoP" class="form-label">Apellido Paterno <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg" id="apellidoP"
                                        placeholder="Apellido Paterno" name="apellidoP" value="{{ $estudiante->apellidoP }}"
                                        disabled>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="apellidoM" class="form-label">Apellido Materno <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg" id="apellidoM"
                                        placeholder="Apellido Materno" name="apellidoM" value="{{ $estudiante->apellidoM }}"
                                        disabled>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="curp" class="form-label">CURP <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg" id="curp" name="curp"
                                    value="{{ $estudiante->curp }}" disabled>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="fecha_na" class="form-label">Fecha de Nacimiento </label>
                                <input type="date" class="form-control form-control-lg" name="fecha_na" id="fecha_na"
                                    value="{{ $estudiante->fecha_na }}" disabled>
                            </div>
                        </div>

                        <div class="row">
                            <h5 class="section-title fw-bold ">Información Académica </h5>
                            <div class="dropdown-divider mb-4"></div>

                            <div class="col-md-6 mb-3">
                                <label for="direccion_id" class="form-label">Dirección de carrera </label>
                                <input type="text" class="form-control form-control-lg" id="direccion_id"
                                    name="direccion_id" value="{{ $estudiante->direccion->name }} " disabled>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="carrera_id" class="form-label">Programa Educativo </label>
                                <input type="text" class="form-control form-control-lg" id="carrera_id" name="carrera_id"
                                    value="{{ $estudiante->carrera->nombre }} " disabled>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="inicio" class="form-label">Fecha de Ingreso </label>
                                <input type="text" class="form-control form-control-lg" id="inicio" name="inicio"
                                    value="{{ $estudiante->inicio }} " disabled>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="fin" class="form-label">Fecha de Egreso </label>
                                <input type="text" class="form-control form-control-lg" id="fin" name="fin"
                                    value="{{ $estudiante->fin }} " disabled>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="cuatrimestre" class="form-label">Cuatrimestre </label>
                                <input type="text" class="form-control form-control-lg" id="cuatrimestre"
                                    name="cuatrimestre" value="{{ $estudiante->cuatrimestre }}" disabled>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="status" class="form-label">Situación Dual </label>
                                @php
                                    $situaciones = [
                                        0 => 'Primera vez',
                                        1 => 'Renovación Dual',
                                    ];
                                @endphp
                                <input type="text" class="form-control form-control-lg" id="status" name="status"
                                    value="{{ $situaciones[$estudiante->status ?? 0] }}" disabled>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="nombre_proyecto" class="form-label">Nombre del Proyecto </label>
                                <input type="text" class="form-control form-control-lg" id="nombre_proyecto"
                                    name="nombre_proyecto" value="{{ $estudiante->nombre_proyecto }}" disabled>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="academico_id" class="form-label">Mentor Academico </label>
                                <input type="text" class="form-control form-control-lg" id="academico_id"
                                    name="academico_id"
                                    value="{{ $estudiante->academico->name . ' ' . $estudiante->academico->apellidoP . ' ' . $estudiante->academico->apellidoM }}"
                                    disabled>
                            </div>

                        </div>

                        <div class="row">
                            <h5 class="section-title fw-bold  mt-4">Datos de la unidad económica </h5>
                            <div class="dropdown-divider mb-4"></div>


                            <div class="col-md-6 mb-3">
                                <label for="empresa_id" class="form-label">Empresa aplicable a Dual </label>
                                <input type="text" class="form-control form-control-lg" id="empresa_id"
                                    name="empresa_id" value="{{ $estudiante->empresa->nombre }}" disabled>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="asesorin_id" class="form-label">Asesor Industrial </label>
                                <input type="text" class="form-control form-control-lg" id="asesorin"
                                    name="asesorin"
                                    value="{{ $estudiante->asesorin->titulo }} {{ $estudiante->asesorin->name . ' ' . $estudiante->asesorin->apellidoP . ' ' . $estudiante->asesorin->apellidoM }}"
                                    disabled>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="inicio_dual" class="form-label">Inicio Dual </label>
                                <input type="date" class="form-control form-control-lg" name="inicio_dual"
                                    id="inicio_dual" value="{{ $estudiante->inicio_dual }}" disabled>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="fin_dual" class="form-label">Fin Dual <span
                                        class="text-danger">*</span></label>
                                <input type="date" class="form-control form-control-lg" name="fin_dual"
                                    id="fin_dual" value="{{ $estudiante->fin_dual }}" disabled>
                            </div>
                        </div>

                        @php
                            $tipoBecaArray = [
                                0 => 'Apoyo por Empresa',
                                1 => 'Beca Dual Comecyt',
                            ];

                            // Determina el mensaje final basado en si tiene beca o no
                            $tipoBecaTexto =
                                $estudiante->beca == 0
                                    ? $tipoBecaArray[$estudiante->tipoBeca ?? 0] ?? 'Tipo de beca no especificado'
                                    : 'El estudiante no cuenta con ningún tipo de beca asignada.';
                        @endphp

                        <div class="row">
                            <h5 class="section-title fw-bold mt-4">Beneficios</h5>
                            <div class="dropdown-divider mb-4"></div>

                            <div class="col-md-6 mb-3">
                                <label for="beca" class="form-label">Beca Dual</label>
                                <input type="text" class="form-control form-control-lg" id="beca" name="beca"
                                    value="{{ $estudiante->beca == 0 ? 'Sí' : 'No' }}" disabled>
                            </div>

                            <div class="col-md-6 mb-3" id="tipoBeca">
                                <label for="tipoBeca" class="form-label">Apoyo Económico</label>
                                <input type="text" class="form-control form-control-lg" id="tipoBeca"
                                    name="tipoBeca" value="{{ $tipoBecaTexto }}" disabled>
                            </div>
                        </div>


                        <div class="row">
                            <h5 class="section-title fw-bold  mt-4">Documentación </h5>
                            <div class="dropdown-divider mb-4"></div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nombre Documento</th>
                                                <th>Ver</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>
                                                    <h5 class="card-title">INE</h5>
                                                </td>
                                                <td>
                                                    <a href="{{ url(Storage::url($estudiante->ine)) }}"
                                                        class="btn btn-primary" target="_blank">Ver
                                                        Documento
                                                        <span class="mdi mdi-file-pdf-box"></span>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>
                                                    <h5 class="card-title">Evaluacion Formacion</h5>
                                                </td>
                                                <td>
                                                    <a href="{{ url(Storage::url($estudiante->evaluacion_form)) }}"
                                                        class="btn btn-primary" target="_blank">Ver
                                                        Documento
                                                        <span class="mdi mdi-file-pdf-box"></span>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>
                                                    <h5 class="card-title">Carta Aceptacion</h5>
                                                </td>
                                                <td>
                                                    <a href="{{ url(Storage::url($estudiante->carta_ap)) }}"
                                                        class="btn btn-primary" target="_blank">Ver
                                                        Documento
                                                        <span class="mdi mdi-file-pdf-box"></span>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>
                                                    <h5 class="card-title">Plan Formacion</h5>
                                                </td>
                                                <td>
                                                    <a href="{{ url(Storage::url($estudiante->plan_form)) }}"
                                                        class="btn btn-primary" target="_blank">Ver
                                                        Documento
                                                        <span class="mdi mdi-file-pdf-box"></span>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>
                                                    <h5 class="card-title">Historial Academico</h5>
                                                </td>
                                                <td>
                                                    <a href="{{ url(Storage::url($estudiante->historial_academico)) }}"
                                                        class="btn btn-primary" target="_blank">Ver
                                                        Documento
                                                        <span class="mdi mdi-file-pdf-box"></span>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>6</td>
                                                <td>
                                                    <h5 class="card-title">Perfil Ingles</h5>
                                                </td>
                                                <td>
                                                    <a href="{{ url(Storage::url($estudiante->perfil_ingles)) }}"
                                                        class="btn btn-primary" target="_blank">Ver
                                                        Documento
                                                        <span class="mdi mdi-file-pdf-box"></span>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>7</td>
                                                <td>
                                                    <h5 class="card-title">Formato A</h5>
                                                </td>
                                                <td>
                                                    <a href="{{ url(Storage::url($estudiante->formatoA)) }}"
                                                        class="btn btn-primary" target="_blank">Ver
                                                        Documento
                                                        <span class="mdi mdi-file-pdf-box"></span>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>6</td>
                                                <td>
                                                    <h5 class="card-title">Formato B</h5>
                                                </td>
                                                <td>
                                                    <a href="{{ url(Storage::url($estudiante->formatoB)) }}"
                                                        class="btn btn-primary" target="_blank">Ver
                                                        Documento
                                                        <span class="mdi mdi-file-pdf-box"></span>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>6</td>
                                                <td>
                                                    <h5 class="card-title">Formato C</h5>
                                                </td>
                                                <td>
                                                    <a href="{{ url(Storage::url($estudiante->formatoC)) }}"
                                                        class="btn btn-primary" target="_blank">Ver
                                                        Documento
                                                        <span class="mdi mdi-file-pdf-box"></span>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>6</td>
                                                <td>
                                                    <h5 class="card-title">Formato 5.1</h5>
                                                </td>
                                                <td>
                                                    <a href="{{ url(Storage::url($estudiante->formato51)) }}"
                                                        class="btn btn-primary" target="_blank">Ver
                                                        Documento
                                                        <span class="mdi mdi-file-pdf-box"></span>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>6</td>
                                                <td>
                                                    <h5 class="card-title">Formato 5.4</h5>
                                                </td>
                                                <td>
                                                    <a href="{{ url(Storage::url($estudiante->formato54)) }}"
                                                        class="btn btn-primary" target="_blank">Ver
                                                        Documento
                                                        <span class="mdi mdi-file-pdf-box"></span>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>6</td>
                                                <td>
                                                    <h5 class="card-title">Formato 5.5</h5>
                                                </td>
                                                <td>
                                                    <a href="{{ url(Storage::url($estudiante->formato55)) }}"
                                                        class="btn btn-primary" target="_blank">Ver
                                                        Documento
                                                        <span class="mdi mdi-file-pdf-box"></span>
                                                    </a>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Botón de regreso -->
                    <div class="d-flex justify-content-end mt-4">
                        <x-buttons.back-button url="{{ route('estudiantes.index') }}" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
