{{-- TAB: PROGRAMAS EDUCATIVOS --}}

<div class="row">

    {{-- Header --}}
    <div class="col-12 mb-3">
        <h6 class="mb-0">
            <i class="mdi mdi-trash-can text-danger me-1"></i>
            Programas Educativos Inactivos
        </h6>
    </div>

    {{-- Buscador --}}

    <div class="col-md-6 mb-3">
        <form method="GET" action="{{ route('empresas.index') }}">
            <input type="hidden" name="tab" value="bajas_temporales">

            <div class="input-group">
                <!-- Input de búsqueda -->
                <input type="text" name="search_eliminados" class="form-control"
                    value="{{ $search_eliminados ?? '' }}" placeholder="Buscar registro eliminado..."
                    style="height: 40px";>

                <!-- Botón para enviar la búsqueda -->
                <button type="submit" class="btn btn-primary d-flex align-items-center"
                    style="gap: 5px; height: 40px; font-weight: 500;">
                    <i class="mdi mdi-magnify"></i> Buscar
                </button>

                <!-- Botón para limpiar búsqueda -->
                @if (!empty($search_eliminados))
                    <a href="{{ route('empresas.index', ['tab' => 'bajas_temporales']) }}"
                        class="btn btn-outline-secondary d-flex align-items-center"
                        style="gap: 5px; height: 40px; font-weight: 500; background: #f4b400; color: #2e2e2e;""
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

                <tbody>
                    @forelse ($carrerasDeleted as $carrera)
                        <tr>
                            <td>
                                {{ ($carrerasDeleted->currentPage() - 1) * $carreras->perPage() + $loop->iteration }}
                            </td>
                            <td>{{ $carrera->grado_academico }}</td>
                            <td>{{ $carrera->nombre }}</td>
                            <td>{{ $carrera->direccion->name }}</td>

                            <td class="text-center">
                                {{-- Ver --}}
                                <x-buttons.show-button
                                    url="{{ route('carreras.show', Hashids::encode($carrera->id)) }}" />

                                {{-- Restaurar --}}
                                <x-buttons.restore-button funcion="restoreProgramaEducativo"
                                    parametro="{{ Hashids::encode($carrera->id) }}" />

                                {{-- Eliminar permanente --}}
                                <x-buttons.delete-button funcion="destroyPermanentProgramaEducativo"
                                    parametro="{{ Hashids::encode($carrera->id) }}" />

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
                {{ $carrerasDeleted->appends(['tab' => 'programas_inactivos'])->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>

</div>
