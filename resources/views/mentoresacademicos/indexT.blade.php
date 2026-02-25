{{-- <!-- @extends('layouts.app')
@section('title', 'Mentores')

@section('content')
    <div class="row">
        <div class="col-12 grid-margin">
            @if (session('status'))
                <div class="alert alert-success alert-dismissible text-dark" role="alert">
                    <span class="text-sm"> <a href="javascript:" class="alert-link text-dark">Excelente</a>.
                        {{ session('status') }}.</span>
                    <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if (session('statusError'))
                <div class="alert alert-danger alert-dismissible text-dark" role="alert">
                    <span class="text-sm"> <a href="javascript:" class="alert-link text-dark">Error</a>.
                        {{ session('statusError') }}.</span>
                    <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">

                        <div class="card-header-adjusted">
                            <h6 class="card-title">Lista De Mentores Academicos</h6>
                            @if (Auth::user()->rol_id === 1 || Auth::user()->rol_id === 4)
                                <div class="float-end">
                                    {{-- Button del modal --}}
<a href="{{ route('academicos.create') }}" class="btn btn-add" title="Agregar una nuevo Mentor Academico">
    <i class="mdi mdi-plus-circle-outline"></i>
</a>
</div>
@endif
</div>

<div class="card-body">
    <div class="row mb-3">
        <div class="col-md-6">
            <input type="text" id="search" class="form-control" placeholder="Buscar mentor...">
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Identificación Profesional</th>
                    <th>Correo Electronico</th>
                    <th>Direccion de Carrera</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="mentorTable">
                @foreach ($mentores as $mentor)
                    <tr class="animate__animated animate__fadeInDown animate__repeat-2 "
                        id="mentor-{{ $mentor->id }}">
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $mentor->titulo . ' ' . $mentor->name . ' ' . $mentor->apellidoP . ' ' . $mentor->apellidoM }}
                        </td>
                        <td>{{ $mentor->email }}</td>
                        <td>{{ $mentor->direccion->name }}</td>
                        <td>

                            {{-- Ver --}}
                            <x-buttons.show-button
                                url="{{ route('academicos.show', Vinkla\Hashids\Facades\Hashids::encode($mentor->id)) }}" />
                            @if (Auth::user()->rol_id === 1 || Auth::user()->rol_id === 4)
                                {{-- Editar --}}
                                <x-buttons.edit-button
                                    url="{{ route('academicos.edit', Vinkla\Hashids\Facades\Hashids::encode($mentor->id)) }}"
                                    title="Editar Mentor" />
                                {{-- Eliminar --}}
                                <x-buttons.delete-button funcion="deleteMentorAcademico"
                                    parametro="{{ $mentor->id }}" />
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>

</div>
</div>
</div>
@if ($mentoresDeleted->count() !== 0)
    @if (Auth::user()->rol_id === 1 || Auth::user()->rol_id === 4)
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary rounded pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Lista De Mentores Academicos Eliminados</h6>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Identificación Profesional</th>
                                    <th>Correo Electronico</th>
                                    <th>Acciones</th>
                                </tr>mentoresDeleted
                            </thead>
                            <tbody>
                                @foreach ($mentoresDeleted as $mentorDeletd)
                                    <tr class="animate__animated animate__fadeInDown animate__repeat-2 "
                                        id="mentor-{{ $mentorDeletd->id }}">
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $mentorDeletd->titulo . ' ' . $mentorDeletd->name . ' ' . $mentorDeletd->apellidoP . ' ' . $mentorDeletd->apellidoM }}
                                        </td>
                                        <td>{{ $mentorDeletd->email }}</td>
                                        <td>
                                            {{-- Restaurar --}}
                                            <x-buttons.restore-button funcion="restoreMentorAcademico"
                                                parametro="{{ $mentorDeletd->id }}" />


                                            {{-- Eliminar permanente --}}
                                            <x-buttons.delete-button funcion="destroyPermanentMentorAcademico"
                                                parametro="{{ $mentorDeletd->id }}" />
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endif
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

@endsection --> --}}
