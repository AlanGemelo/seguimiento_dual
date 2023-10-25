@php use Illuminate\Support\Facades\Storage; @endphp
@extends('layouts.app')
@section('title', 'Mostrar Estudiante')

@section('content')
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Estudiante Dual</h4>
                            <div class="dropdown-divider"></div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="matricula">Matricula</label>
                                        <input type="number" class="form-control form-control-lg" id="matricula"
                                               name="matricula" value="{{ $estudiante->matricula }}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control form-control-lg" id="name"
                                               placeholder="Juan Perez Hermenegildo" name="name"
                                               value="{{ $estudiante->name }}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="curp">CURP</label>
                                        <input type="text" class="form-control form-control-lg" id="curp" name="curp"
                                               value="{{ $estudiante->curp }}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="fecha_na">Fecha de Nacimiento</label>
                                        <div class="input-group date datepicker navbar-date-picker">
                                        <span class="input-group-addon input-group-prepend border-right">
                                            <span class="icon-calendar input-group-text calendar-icon"></span>
                                        </span>
                                            <input type="text" class="form-control" name="fecha_na" id="fecha_na"
                                                   value="{{ $estudiante->fecha_na }}" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="cuatrimestre">Cuatrimestre</label>
                                        <input type="text" class="form-control form-control-lg" id="cuatrimestre"
                                               name="cuatrimestre"
                                               value="{{ $estudiante->cuatrimestre }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="accordion" id="accordionExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#collapseOne" aria-expanded="true"
                                                        aria-controls="collapseOne">
                                                    Documentos
                                                </button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse show"
                                                 data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="card" style="width: 18rem;">
                                                        <div class="card-body">
                                                            <h5 class="card-title">INE</h5>
                                                            <a href="{{ Storage::url($estudiante->ine) }}"
                                                               class="btn btn-primary" target="_blank">Ver Documento
                                                                <span class="mdi mdi-file-pdf-box"></span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
