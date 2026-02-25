@extends('layouts.app')
@section('title', 'Gestión de Mentores Academicos')

@php
    $activeTab = request('tab', 'mentores');
@endphp

@section('content')
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">

                {{-- Header --}}
                <div class="card-header-adjusted d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Gestión de Mentores Academicos</h5>
                </div>

                {{-- Tabs --}}
                <div class="card-body">
                    <ul class="nav nav-tabs" id="mentoresTabs" role="tablist">

                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $activeTab === 'mentores' ? 'active' : '' }}" data-bs-toggle="tab"
                                data-bs-target="#mentores" type="button" role="tab">
                                <i class="mdi mdi-check-circle me-1"></i>
                                Mentores Academicos
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

                        <div class="tab-pane fade {{ $activeTab === 'mentores' ? 'show active' : '' }}" id="mentores"
                            role="tabpanel">
                            @include('mentoresacademicos.tabs.mentores')
                        </div>

                        @if (Auth::user()->rol_id === 1 || Auth::user()->rol_id === 4)
                            <div class="tab-pane fade {{ $activeTab === 'eliminados' ? 'show active' : '' }}"
                                id="eliminados" role="tabpanel">
                                @include('mentoresacademicos.tabs.eliminados')
                            </div>
                        @endif
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection

@section('modals')

    <!-- Modal de confirmación para eliminar un Mentor Academicos -->
    <div class="modal fade" id="deleteModalMentorAcademicos" tabindex="-1" aria-labelledby="deleteMentorAcademicosLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteMentorAcademicosLabel">Eliminar Mentor Academico
                        Temporalmente</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar">
                    </button>
                </div>
                <div class="modal-body">
                    <p id="bannerMentorAcademico"></p>¿Estás seguro de eliminar este registro?</p>
                    <div class="mb-3">

                    </div>
                </div>
                <div class="modal-footer">
                    <form action="" id="deleteFormMentorAcademico" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de restauracion un Mentor Academicos -->
    <div class="modal fade" id="restoreModalMentorAcademico" tabindex="-1"
        aria-labelledby="restoreModalMentorAcademicoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white" style="    background: #34B1AA;">
                    <h5 class="modal-title" id="deleteModalMentoresAcademicosLabel">Restaurar Mentor Academico</h5>
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
                        @method('patch')
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-warning">Restaurar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de eliminacion permanente de un Mentor Academicos -->
    <div class="modal fade" id="destroyModalMentorAcademico" tabindex="-1"
        aria-labelledby="destroyModalMentorAcademicoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalMentoresAcademicosLabel">Destruir Registro</h5>
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

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => {
                new bootstrap.Tooltip(el)
            });

            setupFormValidations();
        });
        // Obtener info del Mentor Academico
        function getMentorAcademicoInfo(id, callback) {
            if (!id) return;

            const url = `${BASE_URL}/academicos/${id}/json`;

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
        function deleteMentorAcademico(id) {
            getMentorAcademicoInfo(id, function(mentorAcademico) {
                document.getElementById('bannerMentorAcademico').innerHTML =
                    `¿Estás seguro de eliminar temporalmente a <strong>${mentorAcademico.titulo} ${mentorAcademico.name} ${mentorAcademico.apellidoP} ${mentorAcademico.apellidoM}</strong>?`;
                document.getElementById('deleteFormMentorAcademico').action =
                    `/academicos/${id}/delete`;
                new bootstrap.Modal(document.getElementById('deleteModalMentorAcademicos')).show();
            });
        }

        // Mostrar modal de resturacion 

        function restoreMentorAcademico(id) {
            getMentorAcademicoInfo(id, function(mentorAcademico) {
                document.getElementById('bannerRestore').innerHTML =
                    `¿Estás seguro de restaurar a <strong>${mentorAcademico.titulo} ${mentorAcademico.name} ${mentorAcademico.apellidoP} ${mentorAcademico.apellidoM}</strong>?`;
                document.getElementById('restoreForm').action = `${BASE_URL}/academicos/${id}/restaurar`
                const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById(
                    'restoreModalMentorAcademico'));
                modal.show();
            });
        }

        // Mostrar modal de eliminación permanente
        function destroyPermanentMentorAcademico(id) {
            // Traer información del mentorAcademico
            getMentorAcademicoInfo(id, function(mentorAcademico) {
                // Actualizar el contenido del modal
                const modalBody = document.getElementById('destroyModalMentorAcademico').querySelector(
                    '.modal-body');
                modalBody.innerHTML =
                    `¿Deseas eliminar permanentemente a <strong>${mentorAcademico.titulo} ${mentorAcademico.name} ${mentorAcademico.apellidoP} ${mentorAcademico.apellidoM}</strong>?`;
                document.getElementById('destroyForm').action = `${BASE_URL}/academicos/${id}/force`;
                const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById(
                    'destroyModalMentorAcademico'));
                modal.show();
            });
        }

        function setupFormValidations() {

        }
    </script>

@endsection
