@php use Illuminate\Support\Facades\Storage; @endphp
@extends('layouts.app')
@section('title', 'Mostrar Estudiante')

@section('content')
<link rel="stylesheet" href="{{ asset('css/listas.css') }}">
    <body class="body">
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Estudiante Dual</h4>
                            <div class="dropdown-divider"></div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="matricula">Matricula</label>
                                        <input type="number" class="form-control form-control-lg" id="matricula"
                                            name="matricula" value="{{ $estudiante->matricula }}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Nombre(s)</label>
                                        <input type="text" class="form-control form-control-lg" id="name"
                                            placeholder="Nombre(s)" name="name" value="{{ $estudiante->name }}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="apellidoP">Apellido Paterno</label>
                                        <input type="text" class="form-control form-control-lg" id="apellidoP"
                                            placeholder="Apellido Paterno" name="apellidoP"
                                            value="{{ $estudiante->apellidoP }}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="apellidoM">Apellido Materno</label>
                                        <input type="text" class="form-control form-control-lg" id="apellidoM"
                                            placeholder="Apellido Materno" name="apellidoM"
                                            value="{{ $estudiante->apellidoM }}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="curp">CURP</label>
                                        <input type="text" class="form-control form-control-lg" id="curp"
                                            name="curp" value="{{ $estudiante->curp }}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="fecha_na">Fecha de Nacimiento</label>
                                        <input type="date" class="form-control form-control-lg" name="fecha_na"
                                            id="fecha_na" value="{{ $estudiante->fecha_na }}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="cuatrimestre">Cuatrimestre</label>
                                        <input type="text" class="form-control form-control-lg" id="cuatrimestre"
                                            name="cuatrimestre" value="{{ $estudiante->cuatrimestre }}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="empresa_id">Empresa</label>
                                        <input type="text" class="form-control form-control-lg" id="empresa_id"
                                            name="empresa_id" value="{{ $estudiante->empresa->nombre }}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="empresa_id">Nombre del Proyecto</label>
                                        <input type="text" class="form-control form-control-lg" id="empresa_id"
                                            name="empresa_id" value="{{ $estudiante->nombre_proyecto }}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="asesorin">Asesor Industrial</label>
                                        <input type="text" class="form-control form-control-lg" id="asesorin"
                                            name="asesorin"
                                            value="{{ $estudiante->asesorin->titulo }} {{ $estudiante->asesorin->name }}"
                                            disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="asesorin">Direccion de Carrera</label>
                                        <input type="text" class="form-control form-control-lg" id="asesorin"
                                            name="asesorin" value="{{ $estudiante->direccion->name }} " disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="asesorin">Programa Educativo</label>
                                        <input type="text" class="form-control form-control-lg" id="asesorin"
                                            name="asesorin" value="{{ $estudiante->carrera->nombre }} " disabled>
                                    </div>
                                </div>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
</body>