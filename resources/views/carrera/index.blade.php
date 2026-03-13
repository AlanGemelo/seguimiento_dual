@extends('layouts.app')
@section('title', 'Programas de Educativo')

@php
    $activeTab = request('tab', 'programas_educativos');
@endphp

@section('content')
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">

                {{-- Header --}}
                <div class="card-header-adjusted d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Gestión de Programas Educativos</h5>
                </div>

                {{-- Tabs --}}
                <div class="card-body">

                    {{-- Alertas generales --}}
                    <x-alerts.flash-messages />

                    {{-- Pestanas para la seccion --}}
                    <ul class="nav nav-tabs" id="empresasTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $activeTab === 'programas_educativos' ? 'active' : '' }}"
                                data-bs-toggle="tab" data-bs-target="#programas_educativos" type="button" role="tab">
                                <i class="mdi mdi-check-circle me-1"></i>
                                Programas Educativo
                            </button>
                        </li>

                        @if (Auth::user()->rol_id === 1 || Auth::user()->rol_id === 4)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ $activeTab === 'programas_inactivos' ? 'active' : '' }}"
                                    data-bs-toggle="tab" data-bs-target="#programas_inactivos" type="button"
                                    role="tab">
                                    <i class="mdi mdi-trash-can me-1"></i>
                                    Programas Inactivos
                                </button>
                            </li>
                        @endif
                    </ul>

                    {{-- Contenido --}}
                    <div class="tab-content mt-4">

                        <div class="tab-pane fade {{ $activeTab === 'programas_educativos' ? 'show active' : '' }}"
                            id="programas_educativos" role="tabpanel">
                            @include('carrera.tabs.programas_educativos')
                        </div>

                        @if (Auth::user()->rol_id === 1 || Auth::user()->rol_id === 4)
                            <div class="tab-pane fade {{ $activeTab === 'programas_inactivos' ? 'show active' : '' }}"
                                id="programas_inactivos" role="tabpanel">
                                @include('carrera.tabs.programas_inactivos')
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- Section de modals --}}
@section('modals')

    <!-- Modal de confirmación para eliminar Programa Educativo -->
    <div class="modal fade" id="deleteModalProgramasEducativos" tabindex="-1"
        aria-labelledby="deleteModalProgramasEducativosLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalProgramasEducativosLabel">Eliminar Programa Educativo</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar">
                    </button>
                </div>
                <div class="modal-body">
                    <p id="bannerProgramasEducativos">¿Estás seguro de eliminar este registro?</p>
                    <div class="mb-3">

                    </div>
                </div>
                <div class="modal-footer">
                    <form action="" id="deleteFormProgramasEducativos" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de restauracion Programa Educativo-->
    <div class="modal fade" id="restoreModalProgramasEducativos" tabindex="-1"
        aria-labelledby="restoreModalProgramasEducativosLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white" style="    background: #34B1AA;">
                    <h5 class="modal-title" id="restoreModalProgramasEducativosLabel">Restaurar Programa Educativo</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar">
                    </button>
                </div>
                <div class="modal-body">
                    <p id="bannerRestore">
                        ¿Estás seguro de restaurar este registro?
                    </p>
                    <div class="mb-3">

                    </div>
                </div>
                <div class="modal-footer">
                    <form id="restoreForm" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-warning">Restaurar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de eliminacion permanente-->
    <div class="modal fade" id="destroyModalProgramasEducativos" tabindex="-1"
        aria-labelledby="destroyModalProgramasEducativosLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="destroyModalProgramasEducativosLabel">Destruir Registro</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar">
                    </button>
                </div>
                <div class="modal-body">
                    <p id="bannerRestore">
                        ¿Estás seguro de Destruir este registro?
                    </p>
                </div>
                <div class="modal-footer">
                    <form id="destroyForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- Section de scripts JS --}}
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => {
                new bootstrap.Tooltip(el)
            });

            setupFormValidations();
        });
        // Obtener info del Mentor Academico
        function getProgramaEducativoInfo(hashId, callback) {

            if (!hashId) {
                console.error('HashId no proporcionado');
                return;
            }

            const url = `${BASE_URL}/carreras/${hashId}/json`;

            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    if (Array.isArray(response) && response.length > 0) {
                        callback(response[0]);
                    } else if (response) {
                        callback(response);
                    } else {
                        console.error('Mentor Academico no encontrado');
                    }
                },
                error: function(err) {
                    console.error('Error al obtener Mentor Academico:', err);
                }
            });
        }
        // Mostrar modal de eliminación temporal
        function deleteProgramaEducativo(hashId) {
            getProgramaEducativoInfo(hashId, function(programaEducativo) {
                document.getElementById('bannerProgramasEducativos').innerHTML =
                    `¿Estás seguro de eliminar temporalmente a <strong>${programaEducativo.grado_academico} ${programaEducativo.nombre} </strong>?`;
                document.getElementById('deleteFormProgramasEducativos').action =
                    `/carreras/${hashId}/delete`;
                new bootstrap.Modal(document.getElementById('deleteModalProgramasEducativos')).show();
            });
        }

        // Mostrar modal de resturacion 

        function restoreProgramaEducativo(hashId) {
            getProgramaEducativoInfo(hashId, function(programaEducativo) {
                document.getElementById('bannerRestore').innerHTML =
                    `¿Estás seguro de restaurar a <strong>${programaEducativo.grado_academico} ${programaEducativo.nombre}</strong>?`;
                document.getElementById('restoreForm').action = `${BASE_URL}/carreras/${hashId}/restaurar`
                const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById(
                    'restoreModalProgramasEducativos'));
                modal.show();
            });
        }

        // Mostrar modal de eliminación permanente
        function destroyPermanentProgramaEducativo(hashId) {
            // Traer información del ProgramaEducativo
            getProgramaEducativoInfo(hashId, function(programaEducativo) {
                // Actualizar el contenido del modal
                const modalBody = document.getElementById('destroyModalProgramasEducativos').querySelector(
                    '.modal-body');
                modalBody.innerHTML =
                    `¿Deseas eliminar permanentemente a <strong>${programaEducativo.grado_academico} ${programaEducativo.nombre}</strong>?`;
                document.getElementById('destroyForm').action = `${BASE_URL}/carreras/${hashId}/force`;
                const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById(
                    'destroyModalProgramasEducativos'));
                modal.show();
            });
        }
    </script>
@endpush
