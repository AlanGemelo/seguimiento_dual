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


@endsection

{{-- Section de modals --}}
@section('modals')
    <!-- Modal de Anexos -->
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
                                <a href="descargar/Anexo 5.1 Plan de Formación.docx" class="btn btn-sm btn-info"
                                    data-bs-toggle="tooltip" title="Descargar Word">
                                    <i class="mdi mdi-file-word"></i>
                                </a>

                                <a href="descargar/5.1 Plan de Formación.pdf" class="btn btn-sm btn-danger"
                                    data-bs-toggle="tooltip" title="Descargar PDF">
                                    <i class="mdi mdi-file-pdf"></i>
                                </a>
                            </div>
                        </li>

                        {{-- Anexo 5.4 --}}
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Anexo 5.4 – Reporte de Actividades</span>

                            <div class="btn-group">
                                <a href="descargar/Anexo 5.4 Reporte de Actividades.docx" class="btn btn-sm btn-info">
                                    <i class="mdi mdi-file-word"></i>
                                </a>

                                <a href="descargar/anexo 5.4 .pdf" class="btn btn-sm btn-danger" data-bs-toggle="tooltip"
                                    title="Descargar PDF">
                                    <i class="mdi mdi-file-pdf"></i>
                                </a>
                            </div>
                        </li>

                        {{-- Anexo 5.5 --}}
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Anexo 5.5 – Seguimiento y Evaluación</span>

                            <div class="btn-group">
                                <a href="descargar/Anexo 5.5 Seguimiento y Evaluación.docx" class="btn btn-sm btn-info">
                                    <i class="mdi mdi-file-word"></i>
                                </a>

                                <a href="descargar/anexo 5.5.pdf" class="btn btn-sm btn-danger" data-bs-toggle="tooltip"
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
    <!-- Modal de confirmación para eliminar estudiante dual -->
    <div class="modal fade" id="deleteModalDual" tabindex="-1" aria-labelledby="deleteModalDualLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalDualLabel">Eliminar Estudiante Dual</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <p id="bannerDual">¿Estás seguro de eliminar este registro?</p>

                    <div class="mb-3">
                        <label for="selectMotivoDual" class="form-label">Motivo de baja</label>
                        <select id="selectMotivoDual" class="form-select">
                            <option value="">-- Selecciona un motivo --</option>
                        </select>
                        <div id="warningMessage" class="text-danger mt-1" style="display:none;">
                            Debes seleccionar un motivo para eliminar al estudiante.
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <form id="deleteFormDual" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="status" id="statusInputDual">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de confirmación para eliminar estudiante dual -->
    <div class="modal fade" id="deleteModalCandidatos" tabindex="-1" aria-labelledby="deleteModalCandidatosLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalCandidatosLabel">Eliminar Alumno Dual</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Cerrar">
                    </button>
                </div>
                <div class="modal-body">
                    <p id="bannerCandidato"></p>¿Estás seguro de eliminar este registro?</p>
                    <div class="mb-3">
                        <label for="selectMotivoCandidato" class="form-label">Motivo de baja</label>
                        <select id="selectMotivoCandidato" class="form-select">
                            <option value="">-- Selecciona un motivo --</option>
                        </select>
                        <div id="warningMessege" class="text-danger mt-1" style="display: none">
                            Debes seleccionar un motivo para eliminar al estudiante.
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <form action="" id="deleteFormCandidato" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="status" id="statusInputCandidato">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de restauracion estudiante dual y candidato-->
    <div class="modal fade" id="restoreModalEstudiante" tabindex="-1" aria-labelledby="restoreModalEstudianteLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white" style="    background: #34B1AA;">
                    <h5 class="modal-title" id="deleteModalCandidatosLabel">Restaurar Alumno</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Cerrar">
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

    <!-- Modal de eliminacion permanente-->
    <div class="modal fade" id="destroyModalEstudiante" tabindex="-1" aria-labelledby="destroyModalEstudianteLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalCandidatosLabel">Destruir Registro</h5>
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
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => {
                new bootstrap.Tooltip(el)
            });

            // Llenar motivos al abrir modales
            document.getElementById('deleteModalDual').addEventListener('show.bs.modal', function() {
                llenarMotivos('selectMotivoDual');
            });

            document.getElementById('deleteModalCandidatos').addEventListener('show.bs.modal', function() {
                llenarMotivos('selectMotivoCandidato');
            });

            setupFormValidations();
        });

        // Obtener info del estudiante
        function getEstudianteInfo(matricula, callback) {
            $.ajax({
                url: `/estudiantes/${matricula}/json`,
                type: 'GET',
                success: function(response) {
                    if (response && response.length > 0) {
                        callback(response[0]);
                    } else {
                        console.error('Estudiante no encontrado');
                    }
                },
                error: function(err) {
                    console.error('Error al obtener estudiante:', err);
                }
            });
        }

        // Mostrar modal de eliminación
        function showDeleteModal(estudiante, tipo) {
            const bannerId = tipo === 'dual' ? 'bannerDual' : 'bannerCandidato';
            const formId = tipo === 'dual' ? 'deleteFormDual' : 'deleteFormCandidato';
            const modalId = tipo === 'dual' ? 'deleteModalDual' : 'deleteModalCandidatos';

            document.getElementById(bannerId).innerHTML =
                `¿Estás seguro de eliminar a <strong>${estudiante.name} ${estudiante.apellidoP} ${estudiante.apellidoM}</strong>, Matrícula: ${estudiante.matricula}?`;

            document.getElementById(formId).action = `estudiantes/${estudiante.matricula}/delete`;

            new bootstrap.Modal(document.getElementById(modalId)).show();
        }

        function deleteEstudiante(matricula, tipo) {
            getEstudianteInfo(matricula, function(estudiante) {
                showDeleteModal(estudiante, tipo);
            });
        }

        // Llenar select de motivos
        function llenarMotivos(selectId) {
            const motivos = [
                'Reprobación',
                'Término de Convenio',
                'Ciclo de Renovación Concluido',
                'Término del PE'
            ];

            const select = document.getElementById(selectId);
            select.innerHTML = '<option value="">-- Selecciona un motivo --</option>';

            motivos.forEach((motivo, index) => {
                const option = document.createElement('option');
                option.value = index;
                option.textContent = motivo;
                select.appendChild(option);
            });
        }

        function setupFormValidations() {
            // Dual
            document.getElementById('deleteFormDual').addEventListener('submit', function(e) {
                const select = document.getElementById('selectMotivoDual');
                const statusInput = document.getElementById('statusInput');

                if (select.value === '') {
                    e.preventDefault();
                    document.getElementById('warningMessage').style.display = 'block';
                } else {
                    statusInput.value = select.value;
                }
            });

            document.getElementById('deleteFormCandidato').addEventListener('submit', function(e) {
                const select = document.getElementById('selectMotivoCandidato');
                const statusInput = document.getElementById('statusInputCandidato');

                if (select.value === '') {
                    e.preventDefault();
                } else {
                    statusInput.value = select.value;
                }
            });
        }

        function restoreEstudiante(id) {
            getEstudianteInfo(id, function(estudiante) {
                document.getElementById('bannerRestore').innerHTML =
                    `¿Estás seguro de restaurar a <strong>${estudiante.name} ${estudiante.apellidoP} ${estudiante.apellidoM}</strong>, Matrícula: ${estudiante.matricula}?`;
                document.getElementById('restoreForm').action = `/estudiantes/${id}/restaurar`;
                const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById(
                    'restoreModalEstudiante'));
                modal.show();
            });
        }

        function destroyPermanent(id) {
            // Traer información del estudiante
            getEstudianteInfo(id, function(estudiante) {
                // Actualizar el contenido del modal
                const modalBody = document.getElementById('destroyModalEstudiante').querySelector('.modal-body');
                modalBody.innerHTML =
                    `¿Deseas eliminar permanentemente a <strong>${estudiante.name} ${estudiante.apellidoP} ${estudiante.apellidoM}</strong>, Matrícula: ${estudiante.matricula}?`;
                document.getElementById('destroyForm').action = `/estudiantes/${id}/force`;
                const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById(
                    'destroyModalEstudiante'));
                modal.show();
            });
        }
    </script>
@endpush
