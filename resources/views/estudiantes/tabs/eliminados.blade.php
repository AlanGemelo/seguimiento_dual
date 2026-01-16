{{-- ===============================
|  TAB: ESTUDIANTES ELIMINADOS
|  Estado: Histórico
|=============================== --}}

<div class="row">

    {{-- Header --}}
    <div class="col-12 mb-3">
        <h6 class="mb-0">
            <i class="mdi mdi-trash-can text-danger me-1"></i>
            Estudiantes Eliminados
        </h6>
    </div>

    {{-- Buscador --}}
    <div class="col-md-6 mb-3">
        <form method="GET" action="{{ route('estudiantes.index') }}">
            <input type="hidden" name="tab" value="eliminados">

            <div class="input-group">
                <input type="text" name="search_eliminados" class="form-control"
                    value="{{ $search_eliminados ?? '' }}" placeholder="Buscar estudiante eliminado...">

                @if (!empty($search_eliminados))
                    <a href="{{ route('estudiantes.index', ['tab' => 'eliminados']) }}"
                        class="btn btn-outline-secondary d-flex align-items-center" title="Limpiar búsqueda">
                        <i class="mdi mdi-close"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>


    {{-- Tabla --}}
    <div class="col-12">
        <div class="table-responsive">

            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Matrícula</th>
                        <th>Estudiante</th>
                        <th>CURP</th>
                        <th>Cuatrimestre</th>
                        <th>Motivo</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($estudiantesDeleted as $deleted)
                        <tr>
                            <td>
                                {{ ($estudiantesDeleted->currentPage() - 1) * $estudiantesDeleted->perPage() + $loop->iteration }}
                            </td>

                            <td>{{ $deleted->matricula }}</td>

                            <td>
                                {{ $deleted->name }}
                                {{ $deleted->apellidoP }}
                                {{ $deleted->apellidoM }}
                            </td>

                            <td>{{ $deleted->curp }}</td>
                            <td>{{ $deleted->cuatrimestre }}</td>
                            <td>{{ $deleted->status_text }}</td>

                            <td class="text-center">

                                {{-- Restaurar --}}
                                <button class="btn btn-sm btn-success" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal3"
                                    onclick="restoreRegistro({{ $deleted->matricula }})">
                                    <i class="mdi mdi-backup-restore"></i>
                                </button>

                                {{-- Eliminar permanente --}}
                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal2" onclick="destroyMentor({{ $deleted->matricula }})">
                                    <i class="mdi mdi-delete-forever"></i>
                                </button>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <div class="alert alert-danger mb-0">
                                    No hay registros eliminados
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Paginación --}}
            <div class="d-flex justify-content-center mt-3">
                {{ $estudiantesDeleted->appends(['tab' => 'eliminados'])->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>

</div>
