@php use Illuminate\Support\Facades\Storage; @endphp

@extends('layouts.app')
@section('title', 'Mostrar Empresa')

@section('content')
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Empresa</h4>
                            <div class="dropdown-divider"></div>
                            <div class="form-group">
                                <label for="nombre">Name</label>
                                <input type="text" class="form-control form-control-lg" id="nombre"
                                       placeholder="" name="nombre" value="{{ $empresa->nombre }}" disabled>

                            </div>
                            <div class="form-group">
                                <label for="direccion">Direccion</label>
                                <input type="text" class="form-control form-control-lg" id="direccion"
                                       name="direccion"
                                       value="{{ $empresa->direccion }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="inicio_conv">Inicio Convenio</label>
                                <div id="datepicker-popup" class="input-group date datepicker navbar-date-picker">
                                        <span class="input-group-addon input-group-prepend border-right">
                                            <span class="icon-calendar input-group-text calendar-icon"></span>
                                        </span>
                                    <input type="text" class="form-control" name="inicio_conv" id="inicio_conv" value="{{ $empresa->inicio_conv }}" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="fin_conv">Fin Convenio</label>
                                <div id="datepicker-popup" class="input-group date datepicker navbar-date-picker">
                                        <span class="input-group-addon input-group-prepend border-right">
                                            <span class="icon-calendar input-group-text calendar-icon"></span>
                                        </span>
                                    <input type="date" class="form-control" name="fin_conv" id="fin_conv" value="{{ $empresa->fin_conv }}" disabled>
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
                                                <h5 class="card-title">Convenio Academico</h5>
                                            </td>
                                            <td>
                                            <a href="{{ Storage::url($empresa->convenioA) }}"
                                                   class="btn btn-primary" target="_blank">Ver
                                                    Convenio Academico
                                                    <span class="mdi mdi-file-pdf-box"></span>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>
                                                <h5 class="card-title">Convenio Marco-Empresa</h5>
                                            </td>
                                            <td>
                                            <a href="{{ Storage::url($empresa->convenioMA) }}"
                                                   class="btn btn-primary" target="_blank">Ver
                                                    Convenio Marco-Empresa
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
@endsection
