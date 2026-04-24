{{-- TAB: ESTUDIANTES ELIMINADOS --}}

<div class="row">

    {{-- Header --}}
    <div class="col-12 mb-3">
        <h6 class="mb-0">
            <i class="mdi mdi-trash-can text-danger me-1"></i>
            Bajas duales
        </h6>
    </div>

    {{-- Buscador --}}
    <div class="col-md-6 mb-3">
        <form method="GET" action="{{ route('estudiantes.index') }}">
            <input type="hidden" name="tab" value="eliminados">

            <div class="input-group">
                <!-- Input de búsqueda -->
                <input type="text" name="search_eliminados" class="form-control"
                    value="{{ $searchEliminados ?? '' }}" placeholder="Buscar registro eliminado..."
                    style="height: 40px";>

                <!-- Botón para enviar la búsqueda -->
                <button type="submit" class="btn btn-primary d-flex align-items-center"
                    style="gap: 5px; height: 40px; font-weight: 500;">
                    <i class="mdi mdi-magnify"></i> Buscar
                </button>

                <!-- Botón para limpiar búsqueda -->
                @if (!empty($searchEliminados))
                    <a href="{{ route('estudiantes.index', ['tab' => 'eliminados']) }}"
                        class="btn btn-outline-secondary d-flex align-items-center"
                        style="gap: 5px; height: 40px; font-weight: 500; background: #f4b400; color: #2e2e2e;""
                        title="Limpiar búsqueda">
                        <i class="mdi mdi-broom"></i> Limpiar búsqueda
                    </a>
                @endif
            </div>
        </form>
    </div>

    {{-- FILTRO (STATUS) --}}
    <div class="col-12 mb-3">
        <div class="d-flex flex-wrap gap-2">

            {{-- Todos --}}
            <a href="{{ route('estudiantes.index', array_merge(request()->except('status'), ['tab' => request('tab')])) }}"
                class="btn btn-sm rounded-pill {{ request('status') === null ? 'btn-success' : 'btn-outline-secondary' }}">
                Todos
            </a>
            @php
                $situacionesFiltradas = collect($situaciones);

                if (request('tab') === 'eliminados') {
                    $situacionesFiltradas = $situacionesFiltradas->only([3, 4, 5]);
                }
            @endphp
            @foreach ($situaciones as $id => $label)
                <a href="{{ route(
                    'estudiantes.index',
                    array_merge(request()->all(), [
                        'status' => $id,
                        'tab' => request('tab'),
                    ]),
                ) }}"
                    class="btn btn-sm rounded-pill 
        {{ request('status') !== null && request('status') == $id ? 'btn-success' : 'btn-outline-secondary' }}">
                    {{ $label }}
                </a>
            @endforeach

        </div>
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
                            <td>{{ $deleted->cuatrimestre }}</td>
                            <td>{{ $deleted->status_text }}</td>

                            <td class="text-center">

                                {{-- Restaurar --}}
                                <x-buttons.restore-button funcion="restoreEstudiante"
                                    parametro="{{ $deleted->matricula }}" />

                                {{-- Eliminar permanente --}}
                                <x-buttons.delete-button funcion="destroyPermanent"
                                    parametro="{{ $deleted->matricula }}" />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <div class="alert alert-danger mb-0">
                                    No hay alumnos en baja registrados
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
