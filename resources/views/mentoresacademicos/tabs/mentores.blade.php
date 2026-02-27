{{-- TAB: MENTORES ACADÉMICOS --}}

<div class="row">

    {{-- Header --}}
    <div class="col-12 mb-3 d-flex justify-content-between align-items-center">
        <h6 class="mb-0">
            <i class="mdi mdi-check-circle text-success me-1"></i>
            Mentores Academicos
        </h6>

        @if (Auth::user()->rol_id === 1 || Auth::user()->rol_id === 2 || Auth::user()->rol_id === 4)
            <div class="row g-2">
                <div class="col-auto">
                    <x-buttons.add-button url="{{ route('academicos.create') }}"
                        title="{{ 'Agregar Mentor Academico' }}" />
                </div>
                <div class="col-auto">

                </div>
            </div>
        @endif
    </div>

    {{-- Buscador --}}
    <div class="col-md-6 mb-3">
        <form method="GET" action="{{ route('academicos.index') }}">
            <input type="hidden" name="tab" value="mentores">

            <div class="input-group">
                <input type="text" name="search_mentores" class="form-control" style="height: 40px;"
                    value="{{ $search_mentores ?? '' }}" placeholder="Buscar mentor Academico...">

                <!-- Botón para enviar la búsqueda -->
                <button type="submit" class="btn btn-primary d-flex align-items-center"
                    style="gap: 5px; height: 40px; font-weight: 500;">
                    <i class="mdi mdi-magnify"></i> Buscar
                </button>

                @if (!empty($search_mentores))
                    <!-- Botón para limpiar búsqueda -->
                    <a href="{{ route('academicos.index', ['tab' => 'mentores']) }}"
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
                        <th>Identificación Profesional</th>
                        <th>Correo Electronico</th>
                        <th>Direccion de Carrera</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($mentores ?? collect() as $mentor)
                        <tr>
                            <td>
                                {{ ($mentores->currentPage() - 1) * $mentores->perPage() + $loop->iteration }}
                            </td>
                            <td>{{ $mentor->titulo . ' ' . $mentor->name . ' ' . $mentor->apellidoP . ' ' . $mentor->apellidoM }}
                            </td>
                            <td>{{ $mentor->email }}</td>
                            <td>{{ $mentor->direccion->name }}</td>

                            <td class="text-center">

                                {{-- Ver --}}
                                <x-buttons.show-button
                                    url="{{ route('academicos.show', Vinkla\Hashids\Facades\Hashids::encode($mentor->id)) }}" />
                                @if (Auth::user()->rol_id === 1 || Auth::user()->rol_id === 4)
                                    {{-- Editar --}}
                                    <x-buttons.edit-button
                                        url="{{ route('academicos.edit', Vinkla\Hashids\Facades\Hashids::encode($mentor->id)) }}"
                                        title="Editar Mentor" />
                                    {{-- Eliminar --}}
                                    @if (Auth::user()->rol_id === 1 || Auth::user()->rol_id === 4)
                                        <x-buttons.delete-button funcion="deleteMentorAcademico"
                                            parametro="{{ $mentor->id }}" />
                                    @endif
                                @endif

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="alert alert-info mb-0">
                                    No hay Mentores Academicos Registrados
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Paginación --}}
            <div class="d-flex justify-content-center mt-3">
                {{ $mentores->appends(['tab' => 'mentores'])->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>

</div>
