@extends('layouts.app')
@section('title', 'Empresas')

@php
    $activeTab = request('tab', 'unidades_registradas');
@endphp

@section('content')
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">

                {{-- Header --}}
                <div class="card-header-adjusted d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Gestión de Unidades Economicas</h5>
                </div>

                {{-- Tabs --}}
                <div class="card-body">

                    {{-- Alertas generales --}}
                    <x-alerts.flash-messages />

                    {{-- Pestanas para la seccion --}}
                    <ul class="nav nav-tabs" id="empresasTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $activeTab === 'unidades_registradas' ? 'active' : '' }}"
                                data-bs-toggle="tab" data-bs-target="#unidades_registradas" type="button" role="tab">
                                <i class="mdi mdi-check-circle me-1"></i>
                                Unidades Economicas (UE)
                            </button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $activeTab === 'unidades_interesadas' ? 'active' : '' }}"
                                data-bs-toggle="tab" data-bs-target="#unidades_interesadas" type="button" role="tab">
                                <i class="mdi mdi-account-clock me-1"></i>
                                Unidades Económicas Interesadas (UEI)
                            </button>
                        </li>

                        @if (Auth::user()->rol_id === 1 || Auth::user()->rol_id === 4)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ $activeTab === 'bajas_temporales' ? 'active' : '' }}"
                                    data-bs-toggle="tab" data-bs-target="#bajas_temporales" type="button" role="tab">
                                    <i class="mdi mdi-trash-can me-1"></i>
                                    Bajas Temporales (UE)
                                </button>
                            </li>
                        @endif
                    </ul>



                    {{-- Contenido --}}
                    <div class="tab-content mt-4">

                        <div class="tab-pane fade {{ $activeTab === 'unidades_registradas' ? 'show active' : '' }}"
                            id="unidades_registradas" role="tabpanel">
                            @include('empresas.tabs.unidades_registradas')
                        </div>

                        <div class="tab-pane fade {{ $activeTab === 'unidades_interesadas' ? 'show active' : '' }}"
                            id="unidades_interesadas" role="tabpanel">
                            @include('empresas.tabs.unidades_interesadas')
                        </div>

                        @if (Auth::user()->rol_id === 1 || Auth::user()->rol_id === 4)
                            <div class="tab-pane fade {{ $activeTab === 'bajas_temporales' ? 'show active' : '' }}"
                                id="bajas_temporales" role="tabpanel">
                                @include('empresas.tabs.bajas_temporales')
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

    <!-- Modal de confirmación para eliminar unidad Interesadas -->
    <div class="modal fade" id="deleteModalInteresadas" tabindex="-1" aria-labelledby="deleteModalInteresadasLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalInteresadasLabel">Eliminar Unidad Economica</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar">
                    </button>
                </div>
                <div class="modal-body">
                    <p id="bannerInteresadas">¿Estás seguro de eliminar este registro?</p>
                    <div class="mb-3">

                    </div>
                </div>
                <div class="modal-footer">
                    <form action="" id="deleteFormInteresadas" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de restauracion Unidades economicas-->
    <div class="modal fade" id="restoreModalUnidadEconomica" tabindex="-1"
        aria-labelledby="restoreModalUnidadEconomicaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white" style="    background: #34B1AA;">
                    <h5 class="modal-title" id="restoreModalUnidadEconomicaLabel">Restaurar Unidad Economica</h5>
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
    <div class="modal fade" id="destroyModalUnidadEconomica" tabindex="-1"
        aria-labelledby="destroyModalUnidadEconomicaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="destroyModalUnidadEconomicaLabel">Destruir Registro</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Cerrar">
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

        // Obtener info de la unidad economica
        function getUnidadEconomicaInfo(hashId, callback) {
            const url = `${BASE_URL}/empresas/${hashId}/json`;
            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    if (response && Object.keys(response).length > 0) {
                        // response es un objeto, no un array
                        callback(response);
                    } else {
                        console.error('Unidad Economica no encontrada');
                    }
                },
                error: function(err) {
                    console.error('Error al obtener unidad economica:', err);
                }
            });
        }

        // Mostrar modal de eliminación
        function showDeleteModal(unidad_economica, hashId) {
            document.getElementById('bannerUnidadesRegistradas').innerHTML =
                `¿Estás seguro de eliminar a <strong>${unidad_economica.nombre}</strong>?`;
            document.getElementById('deleteFormUnidadesRegistradas').action =
                `${BASE_URL}/empresas/${hashId}/suspend`;
            bootstrap.Modal.getOrCreateInstance(
                document.getElementById('deleteModalUnidadesRegistradas')
            ).show();
        }

        //Funcion para eliminar UE 

        function deleteUnidadEconomica(hashId) {
            getUnidadEconomicaInfo(hashId, function(unidad_economica) {
                showDeleteModal(unidad_economica, hashId);
            });
        }

        function setupFormValidations() {

            document.getElementById('deleteFormUnidadesRegistradas').addEventListener('submit', function(e) {

            });

            document.getElementById('deleteFormInteresadas').addEventListener('submit', function(e) {

            });
        }

        function restoreUnidadEconomica(id) {
            getUnidadEconomicaInfo(id, function(unidad_economica) {
                document.getElementById('bannerRestore').innerHTML =
                    `¿Estás seguro de restaurar a <strong>${unidad_economica.nombre}?`;
                document.getElementById('restoreForm').action = `/empresas/${id}/reactivate`;
                const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById(
                    'restoreModalUnidadEconomica'));
                modal.show();
            });
        }

        function destroyPermanent(id) {
            // Traer información de la unidad economica
            getUnidadEconomicaInfo(id, function(unidad_economica) {
                // Actualizar el contenido del modal
                const modalBody = document.getElementById('destroyModalUnidadEconomica').querySelector(
                    '.modal-body');
                modalBody.innerHTML =
                    `¿Deseas eliminar permanentemente a <strong>${unidad_economica.nombre}?`;
                document.getElementById('destroyForm').action = `empresas/${id}/delete`;
                const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById(
                    'destroyModalUnidadEconomica'));
                modal.show();
            });
        }
    </script>
@endpush
