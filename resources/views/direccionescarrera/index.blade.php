@extends('layouts.app')
@section('title', 'Direcciones de Carrera')

@php
    $activeTab = request('tab', 'direcciones_carrera');
@endphp

@section('content')
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">

                {{-- Header --}}
                <div class="card-header-adjusted d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Gestión de las Direcciones de Carrera</h5>
                </div>

                {{-- Tabs --}}
                <div class="card-body">

                    {{-- Alertas generales --}}
                    <x-alerts.flash-messages />

                    {{-- Pestanas para la seccion --}}
                    <ul class="nav nav-tabs" id="empresasTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $activeTab === 'direcciones_carrera' ? 'active' : '' }}"
                                data-bs-toggle="tab" data-bs-target="#direcciones_carrera" type="button" role="tab">
                                <i class="mdi mdi-check-circle me-1"></i>
                                Direcciones de carrera
                            </button>
                        </li>

                        @if (Auth::user()->rol_id === 1 || Auth::user()->rol_id === 4)
                            <li class="nav-item" role="presentation">
                                <button
                                    class="nav-link {{ $activeTab === 'direcciones_carrera_inactivas' ? 'active' : '' }}"
                                    data-bs-toggle="tab" data-bs-target="#direcciones_carrera_inactivas" type="button"
                                    role="tab">
                                    <i class="mdi mdi-trash-can me-1"></i>
                                    Bajas
                                </button>
                            </li>
                        @endif
                    </ul>



                    {{-- Contenido --}}
                    <div class="tab-content mt-4">

                        <div class="tab-pane fade {{ $activeTab === 'direcciones_carrera' ? 'show active' : '' }}"
                            id="direcciones_carrera" role="tabpanel">
                            @include('direccionescarrera.tabs.direcciones_carrera')
                        </div>

                        @if (Auth::user()->rol_id === 1 || Auth::user()->rol_id === 4)
                            <div class="tab-pane fade {{ $activeTab === 'direcciones_carrera_inactivas' ? 'show active' : '' }}"
                                id="direcciones_carrera_inactivas" role="tabpanel">
                                @include('direccionescarrera.tabs.direcciones_carrera_inactivas')
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

    <!-- Modal de confirmación para eliminar Direcciones de Carrera -->
    <div class="modal fade" id="deleteModalDireccionesCarrera" tabindex="-1"
        aria-labelledby="deleteModalDireccionesCarreraLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalDireccionesCarreraLabel">Eliminar Dirección de Carrera</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar">
                    </button>
                </div>
                <div class="modal-body">
                    <p id="bannerDireccionesCarrera">¿Estás seguro de eliminar este registro?</p>
                    <div class="mb-3">

                    </div>
                </div>
                <div class="modal-footer">
                    <form action="" id="deleteFormDireccionesCarrera" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de restauracion Direcciones de Carrera-->
    <div class="modal fade" id="restoreModalDireccionesCarrera" tabindex="-1"
        aria-labelledby="restoreModalDireccionesCarreraLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white" style="    background: #34B1AA;">
                    <h5 class="modal-title" id="restoreModalDireccionesCarreraLabel">Restaurar Dirección de Carrera</h5>
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
    <div class="modal fade" id="destroyModalDireccionesCarrera" tabindex="-1"
        aria-labelledby="destroyModalDireccionesCarreraLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="destroyModalDireccionesCarreraLabel">Destruir Registro</h5>
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
        });

        // Obtener info de la Dirección de Carrera
        function getDireccionCarreraInfo(hashId, callback) {
            const url = `${BASE_URL}/direcciones/${hashId}/json`;
            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    if (response && Object.keys(response).length > 0) {
                        // response es un objeto, no un array
                        callback(response);
                    } else {
                        console.error('Dirección de Carrera no encontrada');
                    }
                },
                error: function(err) {
                    console.error('Error al obtener Dirección de Carrera:', err);
                }
            });
        }

        // Mostrar modal de eliminación
        function showDeleteModal(direccion_carrera, hashId) {
            document.getElementById('bannerDireccionesCarrera').innerHTML =
                `¿Estás seguro de eliminar a <strong>${direccion_carrera.name}</strong>?`;
            document.getElementById('deleteFormDireccionesCarrera').action =
                `${BASE_URL}/direcciones/${hashId}/delete`;
            bootstrap.Modal.getOrCreateInstance(
                document.getElementById('deleteModalDireccionesCarrera')
            ).show();
        }

        //Funcion para eliminar Direcciones de Carrera

        function deleteDireccionCarrera(hashId) {
            getDireccionCarreraInfo(hashId, function(direccion_carrera) {
                showDeleteModal(direccion_carrera, hashId);
            });
        }


        //Funcion para restaurar Direcciones de Carrera

        function restoreDireccionCarrera(hashId) {
            getDireccionCarreraInfo(hashId, function(direccion_carrera) {
                const bannerRestore = document.getElementById('bannerRestore');
                if (bannerRestore) {
                    bannerRestore.innerHTML =
                        `¿Estás seguro de restaurar a <strong>${direccion_carrera.name}</strong>?`;
                }

                const restoreForm = document.getElementById('restoreForm');
                if (restoreForm) {
                    restoreForm.action = `/direcciones/${hashId}/reactivate`;
                }

                const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById(
                    'restoreModalDireccionesCarrera'));
                modal.show();
            });
        }

        //Funcion para destruir Direcciones de Carrera
        function destroyPermanent(hashId) {
            getDireccionCarreraInfo(hashId, function(direccion_carrera) {
                const modalBody = document.getElementById('destroyModalDireccionesCarrera')?.querySelector(
                    '.modal-body');
                if (modalBody) {
                    modalBody.innerHTML =
                        `¿Deseas eliminar permanentemente a <strong>${direccion_carrera.name}</strong>?`;
                }

                const destroyForm = document.getElementById('destroyForm');
                if (destroyForm) {
                    destroyForm.action = `/direcciones/${hashId}/force`;
                }

                const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById(
                    'destroyModalDireccionesCarrera'));
                modal.show();
            });
        }
    </script>
@endpush
