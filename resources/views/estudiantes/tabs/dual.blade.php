{{-- TAB: ESTUDIANTES DUAL --}}

<div class="row">

    {{-- Header --}}
    <div class="col-12 mb-3 d-flex justify-content-between align-items-center">
        <h6 class="mb-0">
            <i class="mdi mdi-check-circle text-success me-1"></i>
            Estudiantes Dual
        </h6>

        {{--   @if (Auth::user()->rol_id === 1 || Auth::user()->rol_id === 2 || Auth::user()->rol_id === 4)
            <a href="{{ route('estudiantes.create') }}" class="btn btn-sm btn-add" title="Agregar estudiante dual">
                <i class="mdi mdi-plus-circle-outline"></i>
            </a>
        @endif --}}
    </div>

    {{-- Buscador --}}
    <div class="col-md-6 mb-3">
        <form method="GET" action="{{ route('estudiantes.index') }}">
            <input type="hidden" name="tab" value="dual">

            <div class="input-group">
                <input type="text" name="search" class="form-control" style="height: 40px;"
                    value="{{ $search ?? '' }}" placeholder="Buscar estudiante dual...">

                <!-- Botón para enviar la búsqueda -->
                <button type="submit" class="btn btn-primary d-flex align-items-center"
                    style="gap: 5px; height: 40px; font-weight: 500;">
                    <i class="mdi mdi-magnify"></i> Buscar
                </button>

                @if (!empty($search))
                    <!-- Botón para limpiar búsqueda -->
                    <a href="{{ route('estudiantes.index', ['tab' => 'dual']) }}"
                        class="btn btn-outline-secondary d-flex align-items-center"
                        style="gap: 5px; height: 40px; font-weight: 500; background: #f4b400; color: #2e2e2e;"
                        title="Limpiar búsqueda">
                        <i class="mdi mdi-broom"></i> Limpiar búsqueda
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
                        <th>Matricula</th>
                        <th>Estudiante</th>
                        <th>Carrera</th>
                        <th>Cuatrimestre</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($estudiantes ?? collect() as $estudiante)
                        <tr>
                            <td>
                                {{ ($estudiantes->currentPage() - 1) * $estudiantes->perPage() + $loop->iteration }}
                            </td>
                            <td>{{ $estudiante->matricula }}</td>
                            <td>
                                {{ $estudiante->name }}
                                {{ $estudiante->apellidoP }}
                                {{ $estudiante->apellidoM }}
                            </td>

                            <td>{{ $estudiante->carrera->nombre }}</td>
                            <td>{{ $estudiante->cuatrimestre }}</td>

                            <td class="text-center">

                                {{-- Ver --}}
                                <x-buttons.show-button :url="route(
                                    'estudiantes.show',
                                    Vinkla\Hashids\Facades\Hashids::encode($estudiante->matricula),
                                )" />
                                {{-- Editar --}}
                                <x-buttons.edit-button
                                    url="{{ route('estudiantes.edit', Vinkla\Hashids\Facades\Hashids::encode($estudiante->matricula)) }}"
                                    title="Editar Dual" />
                                {{-- Eliminar --}}
                                @if (Auth::user()->rol_id === 1 || Auth::user()->rol_id === 4)
                                    <button class="btn btn-sm btn-danger"
                                        onclick="deleteEstudiante('{{ $estudiante->matricula }}')">
                                        <i class="mdi mdi-delete"></i>
                                    </button>
                                @endif

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="alert alert-info mb-0">
                                    No hay estudiantes dual registrados
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Paginación --}}
            <div class="d-flex justify-content-center mt-3">
                {{ $estudiantes->appends(['tab' => 'dual'])->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>

</div>
