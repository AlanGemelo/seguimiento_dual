{{-- TAB: PROGRAMAS EDUCATIVOS --}}

<div class="row">

    {{-- Header --}}
    <div class="col-12 mb-3 d-flex justify-content-between align-items-center">
        <h6 class="mb-0">
            <i class="mdi mdi-check-circle text-success me-1"></i>
            Programas Educativos
        </h6>

        {{--   @if (Auth::user()->rol_id === 1 || Auth::user()->rol_id === 2 || Auth::user()->rol_id === 4)
            <a href="{{ route('carreras.create') }}" class="btn btn-sm btn-add" title="Agregar unidad Económica">
                <i class="mdi mdi-plus-circle-outline"></i>
            </a>
        @endif --}}
    </div>

    {{-- Buscador --}}
    <div class="col-md-6 mb-3">
        <form method="GET" action="{{ route('carreras.index') }}">
            <input type="hidden" name="tab" value="unidades_registradas">

            <div class="input-group">
                <input type="text" name="search_carreras" class="form-control" style="height: 40px;"
                    value="{{ $search_carreras ?? '' }}" placeholder="Buscar Programa Educativo...">

                <!-- Botón para enviar la búsqueda -->
                <button type="submit" class="btn btn-primary d-flex align-items-center"
                    style="gap: 5px; height: 40px; font-weight: 500;">
                    <i class="mdi mdi-magnify"></i> Buscar
                </button>

                @if (!empty($search_carreras))
                    <!-- Botón para limpiar búsqueda -->
                    <a href="{{ route('carreras.index', ['tab' => 'unidades_registradas']) }}"
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
                        <th>Grado Académico</th>
                        <th>Programa Educativo</th>
                        <th>Direccion de Carrera</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>

                <tbody id="programas_educativos">
                    @forelse ($carreras ?? collect() as $carrera)
                        <tr>
                            <td>
                                {{ ($carreras->currentPage() - 1) * $carreras->perPage() + $loop->iteration }}
                            </td>
                            <td>{{ $carrera->grado_academico }}</td>
                            <td>{{ $carrera->nombre }}</td>
                            <td>{{ $carrera->direccion->name }}</td>
                            <td class="text-center">
                                {{-- Ver --}}
                                <x-buttons.show-button
                                    url="{{ route('carreras.show', Hashids::encode($carrera->id)) }}" />
                                {{-- Editar --}}
                                <x-buttons.edit-button url="{{ route('carreras.edit', Hashids::encode($carrera->id)) }}"
                                    title="Editar" />

                                @if (Auth::user()->rol_id === 1 || Auth::user()->rol_id === 4)
                                    {{-- Eliminar --}}
                                    <x-buttons.delete-button funcion="deleteProgramaEducativo"
                                        parametro="{{ Hashids::encode($carrera->id) }}" />
                                @endif

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="alert alert-info mb-0">
                                    No hay Unidades Economicas registrados
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Paginación --}}
            <div class="d-flex justify-content-center mt-3">
                {{ $carreras->appends(['tab' => 'programas_educativos'])->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>

</div>
