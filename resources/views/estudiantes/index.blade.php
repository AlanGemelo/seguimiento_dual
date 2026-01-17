@extends('layouts.app')
@section('title', 'Gestión de Estudiantes')

@php
    $activeTab = request('tab', 'dual');
@endphp

@section('content')
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">

                {{-- Header --}}
                <div class="card-header-adjusted d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Gestión de Estudiantes Duales</h5>

                    {{-- Botón de descarga de anexos --}}
                    <button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#modalAnexos">
                        <i class="mdi mdi-download me-1"></i> Anexos
                    </button>

                </div>

                {{-- Tabs --}}
                <div class="card-body">
                    <ul class="nav nav-tabs" id="estudiantesTabs" role="tablist">

                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $activeTab === 'dual' ? 'active' : '' }}" data-bs-toggle="tab"
                                data-bs-target="#dual" type="button" role="tab">
                                <i class="mdi mdi-check-circle me-1"></i>
                                Estudiantes Dual
                            </button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $activeTab === 'candidatos' ? 'active' : '' }}" data-bs-toggle="tab"
                                data-bs-target="#candidatos" type="button" role="tab">
                                <i class="mdi mdi-account-clock me-1"></i>
                                Candidatos a Dual
                            </button>
                        </li>

                        @if (Auth::user()->rol_id === 1 || Auth::user()->rol_id === 4)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ $activeTab === 'eliminados' ? 'active' : '' }}"
                                    data-bs-toggle="tab" data-bs-target="#eliminados" type="button" role="tab">
                                    <i class="mdi mdi-trash-can me-1"></i>
                                    Eliminados
                                </button>
                            </li>
                        @endif
                    </ul>



                    {{-- Contenido --}}
                    <div class="tab-content mt-4">

                        <div class="tab-pane fade {{ $activeTab === 'dual' ? 'show active' : '' }}" id="dual"
                            role="tabpanel">
                            @include('estudiantes.tabs.dual')
                        </div>

                        <div class="tab-pane fade {{ $activeTab === 'candidatos' ? 'show active' : '' }}" id="candidatos"
                            role="tabpanel">
                            @include('estudiantes.tabs.candidatos')
                        </div>

                        @if (Auth::user()->rol_id === 1 || Auth::user()->rol_id === 4)
                            <div class="tab-pane fade {{ $activeTab === 'eliminados' ? 'show active' : '' }}"
                                id="eliminados" role="tabpanel">
                                @include('estudiantes.tabs.eliminados')
                            </div>
                        @endif
                    </div>

                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="modalAnexos" tabindex="-1" aria-labelledby="modalAnexosLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                {{-- Header --}}
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAnexosLabel">
                        Plantillas de los Anexos
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                {{-- Body --}}
                <div class="modal-body">
                    <ul class="list-group">

                        {{-- Anexo 5.1 --}}
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Anexo 5.1 – Plan de Formación</span>

                            <div class="btn-group">
                                <a href="/descargar/Anexo 5.1 Plan de Formación.docx" class="btn btn-sm btn-info"
                                    data-bs-toggle="tooltip" title="Descargar Word">
                                    <i class="mdi mdi-file-word"></i>
                                </a>

                                <a href="/descargar/5.1 Plan de Formación.pdf" class="btn btn-sm btn-danger"
                                    data-bs-toggle="tooltip" title="Descargar PDF">
                                    <i class="mdi mdi-file-pdf"></i>
                                </a>
                            </div>
                        </li>

                        {{-- Anexo 5.4 --}}
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Anexo 5.4 – Reporte de Actividades</span>

                            <div class="btn-group">
                                <a href="/descargar/Anexo 5.4 Reporte de Actividades.docx" class="btn btn-sm btn-info">
                                    <i class="mdi mdi-file-word"></i>
                                </a>

                                <a href="/descargar/anexo 5.4 .pdf" class="btn btn-sm btn-danger" data-bs-toggle="tooltip"
                                    title="Descargar PDF">
                                    <i class="mdi mdi-file-pdf"></i>
                                </a>
                            </div>
                        </li>

                        {{-- Anexo 5.5 --}}
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Anexo 5.5 – Seguimiento y Evaluación</span>

                            <div class="btn-group">
                                <a href="/descargar/Anexo 5.5 Seguimiento y Evaluación.docx" class="btn btn-sm btn-info">
                                    <i class="mdi mdi-file-word"></i>
                                </a>

                                <a href="/descargar/anexo 5.5.pdf" class="btn btn-sm btn-danger" data-bs-toggle="tooltip"
                                    title="Descargar PDF">
                                    <i class="mdi mdi-file-pdf"></i>
                                </a>
                            </div>
                        </li>

                    </ul>
                </div>

                {{-- Footer --}}
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Salir
                    </button>
                </div>

            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => {
                new bootstrap.Tooltip(el)
            })
        })
    </script>
@endpush
