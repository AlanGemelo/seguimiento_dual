{{-- TAB: Direcciones Inactibas --}}

<div class="row">

    {{-- Header --}}
    <div class="col-12 mb-3">
        <h6 class="mb-0">
            <i class="mdi mdi-trash-can text-danger me-1"></i>
            Direcciones de Carrera Inactivas
        </h6>
    </div>

    {{-- Buscador --}}

    <div class="col-md-6 mb-3">
        <form method="GET" action="{{ route('direcciones.index') }}">
            <input type="hidden" name="tab" value="direcciones_carrera_inactivas">

            <div class="input-group">
                <!-- Input de búsqueda -->
                <input type="text" name="search_direcciones_carrera_inactivas" class="form-control"
                    value="{{ $searchDireccionesInactivas ?? '' }}" placeholder="Buscar registro eliminado..."
                    style="height: 40px";>

                <!-- Botón para enviar la búsqueda -->
                <button type="submit" class="btn btn-primary d-flex align-items-center"
                    style="gap: 5px; height: 40px; font-weight: 500;">
                    <i class="mdi mdi-magnify"></i> Buscar
                </button>

                <!-- Botón para limpiar búsqueda -->
                @if (!empty($searchDireccionesInactivas))
                    <a href="{{ route('direcciones.index', ['tab' => 'direcciones_carrera_inactivas']) }}"
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
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Inactivado</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($direccionesInactivas as $carreras)
                        <tr>
                            <td>
                                {{ ($direccionesInactivas->currentPage() - 1) * $direccionesInactivas->perPage() + $loop->iteration }}
                            </td>
                            <td>{{ $carreras->name }}</td>
                            <td>{{ $carreras->email }}</td>
                            <td>
                                {{ $carreras->telefono ? $carreras->telefono . ($carreras->ext_telefonica ? ' ext. ' . $carreras->ext_telefonica : '') : 'N/A' }}
                            </td>
                            <td>{{ $carreras->deleted_at ? $carreras->deleted_at->format('d-m-Y') : '' }}</td>

                            <td class="text-center">
                                {{-- Ver --}}
                                <x-buttons.show-button
                                    url="{{ route('direcciones.show', Hashids::encode($carreras->id)) }}" />

                                @if (Auth::user()->rol_id === 1 || Auth::user()->rol_id === 4)
                                    {{-- Restaurar --}}
                                    <x-buttons.restore-button funcion="restoreDireccionCarrera"
                                        parametro="{{ Hashids::encode($carreras->id) }}" />

                                    {{-- Eliminar permanente --}}
                                    <x-buttons.delete-button funcion="destroyPermanent"
                                        parametro="{{ Hashids::encode($carreras->id) }}" />
                                @endif

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
                {{ $direccionesInactivas->appends(['tab' => 'direcciones_carrera_inactivas'])->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>

</div>
