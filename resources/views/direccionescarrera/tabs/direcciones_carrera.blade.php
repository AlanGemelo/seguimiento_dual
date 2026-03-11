{{-- TAB: Direcciones de Carrera --}}

<div class="row">

    {{-- Header --}}
    <div class="col-12 mb-3 d-flex justify-content-between align-items-center">
        <h6 class="mb-0">
            <i class="mdi mdi-check-circle text-success me-1"></i>
            Direcciones de Carrera
        </h6>
        @if (Auth::user()->rol_id === 1 || Auth::user()->rol_id === 4)
            <x-buttons.add-button url="{{ route('direcciones.create') }}" title="{{ 'Agregar dirección de carrera' }}" />
        @endif
    </div>

    {{-- Buscador --}}
    <div class="col-md-6 mb-3">
        <form method="GET" action="{{ route('direcciones.index') }}">
            <input type="hidden" name="tab" value="direcciones_carrera">

            <div class="input-group">
                <input type="text" name="search_direcciones" class="form-control" style="height: 40px;"
                    value="{{ $searchDireccionCarrera ?? '' }}" placeholder="Buscar dirección de carrera...">

                <!-- Botón para enviar la búsqueda -->
                <button type="submit" class="btn btn-primary d-flex align-items-center"
                    style="gap: 5px; height: 40px; font-weight: 500;">
                    <i class="mdi mdi-magnify"></i> Buscar
                </button>

                @if (!empty($searchDireccionCarrera))
                    <!-- Botón para limpiar búsqueda -->
                    <a href="{{ route('direcciones.index', ['tab' => 'direcciones_carrera']) }}"
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
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>

                <tbody id="empresaTable">
                    @forelse ($direcciones ?? collect() as $carrera)
                        <tr>
                            <td>
                                {{ ($direcciones->currentPage() - 1) * $direcciones->perPage() + $loop->iteration }}
                            </td>
                            <td>{{ $carrera->name }}</td>
                            <td>{{ $carrera->email }}</td>
                            <td>
                                {{ $carrera->telefono ? $carrera->telefono . ($carrera->ext_telefonica ? ' ext. ' . $carrera->ext_telefonica : '') : 'N/A' }}
                            </td>
                            <td class="text-center">
                                {{-- Ver --}}
                                <x-buttons.show-button
                                    url="{{ route('direcciones.show', Hashids::encode($carrera->id)) }}" />

                                @if (Auth::user()->rol_id === 1 || Auth::user()->rol_id === 4)
                                    {{-- Editar --}}
                                    <x-buttons.edit-button
                                        url="{{ route('direcciones.edit', Hashids::encode($carrera->id)) }}"
                                        title="Editar dirección" />
                                    {{-- Eliminar --}}
                                    <x-buttons.delete-button funcion="deleteDireccionCarrera"
                                        parametro="{{ Hashids::encode($carrera->id) }}" />
                                @endif

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="alert alert-info mb-0">
                                    No hay direcciones de carrera registradas
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Paginación --}}
            <div class="d-flex justify-content-center mt-3">
                {{ $direcciones->appends(['tab' => 'direcciones_carrera'])->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>

</div>
