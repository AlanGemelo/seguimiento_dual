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
                        <h4 class="card-title fw-bold py-3">Datos del Estudiante Dual</h4>
                        <div class="dropdown-divider"></div>
                        <div class="row py-3 text-center">
                            <div class="col-md-3">
                                Matricula:
                                <p class="fw-light fs-6">{{ $estudiante->matricula }}</p>
                            </div>
                            <div class="col-md-3">
                                Nombre:
                                <p class="fw-light fs-6">{{ $estudiante->name }}</p>
                            </div>
                            <div class="col-md-3">
                                CURP:
                                <p class="fw-light fs-6">{{ $estudiante->curp }}</p>
                            </div>
                            <div class="col-md-3">
                                Fecha de nacimiento:
                                <p class="fw-light fs-6">{{ $estudiante->fecha_na }}</p>
                            </div>
                        </div>
                        <div class="row py-3 text-center">
                            <div class="col-md-4">
                                Cuatrimestre:
                                <p class="fw-light fs-6">{{ $estudiante->cuatrimestre }}</p>
                            </div>
                            <div class="col-md-4">
                                Empresa:
                                <p class="fw-light fs-6">{{ $estudiante->empresa->nombre }}</p>
                            </div>
                            <div class="col-md-4">
                                Asesor:
                                <p class="fw-light fs-6">{{ $estudiante->asesorin->titulo }} {{ $estudiante->asesorin->name }}</p>
                            </div>
                        </div>
                        <div class="row pt-3">
                            <div class="col-2">
                                <p class="fw-semibold fs-5">Documentos</p>
                            </div>
                            <div class="col">
                            <div class="dropdown-divider"></div>
                            </div>
                        </div>
                        <div class="row py-3 text-center">
                            <div class="col-md-4">
                                <p class="fw-semibold fs-6">INE:</p>
                                <a href="{{ Storage::url($estudiante->ine) }}"
                                    class="btn btn-primary btn-sm" target="_blank">
                                    Ver Documento
                                    <span class="mdi mdi-file-pdf-box"></span>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <p class="fw-semibold fs-6">Evaluación Formación:</p>
                                <a href="{{ Storage::url($estudiante->evaluacion_form) }}"
                                    class="btn btn-primary btn-sm" target="_blank">
                                    Ver Documento
                                    <span class="mdi mdi-file-pdf-box"></span>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <p class="fw-semibold fs-6">Carta Aceptación: </p>
                                <a href="{{ Storage::url($estudiante->carta_ap) }}"
                                    class="btn btn-primary btn-sm" target="_blank">
                                    Ver Documento
                                    <span class="mdi mdi-file-pdf-box"></span>
                                </a>
                            </div>
                        </div>
                        <div class="row py-3 text-center">
                            <div class="col-md-4">
                                <p class="fw-semibold fs-6">Plan Formación: </p>
                                <a href="{{ Storage::url($estudiante->plan_form) }}"
                                    class="btn btn-primary btn-sm" target="_blank">
                                    Ver Documento
                                    <span class="mdi mdi-file-pdf-box"></span>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <p class="fw-semibold fs-6">Historial Academico: </p>
                                <a href="{{ Storage::url($estudiante->historial_academico) }}"
                                    class="btn btn-primary btn-sm" target="_blank">
                                    Ver Documento
                                    <span class="mdi mdi-file-pdf-box"></span>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <p class="fw-semibold fs-6">Perfíl Ingles: </p>
                                <a href="{{ Storage::url($estudiante->perfil_ingles) }}"
                                    class="btn btn-primary btn-sm" target="_blank">
                                    Ver Documento
                                    <span class="mdi mdi-file-pdf-box"></span>
                                </a>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="row pt-3">
                            <div class="col d-flex justify-content-end">
                            <a href="/estudiantes"
                                    class="btn btn-secondary btn-sm">
                                    Volver
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection