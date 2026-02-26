{{-- TAB: ESTUDIANTES ELIMINADOS --}}

<div class="row">

    {{-- Header --}}
    <div class="col-12 mb-3">
        <h6 class="mb-0">
            <i class="mdi mdi-trash-can text-danger me-1"></i>
            Historial de UEI - Bajas Temporales
        </h6>
    </div>

    {{-- Buscador --}}

    <div class="col-md-6 mb-3">
        <form method="GET" action="{{ route('empresas.index') }}">
            <input type="hidden" name="tab" value="bajas_temporales">

            <div class="input-group">
                <!-- Input de búsqueda -->
                <input type="text" name="search_bajas_temporales" class="form-control"
                    value="{{ $searchBajasTemporales ?? '' }}" placeholder="Buscar registro eliminado..."
                    style="height: 40px";>

                <!-- Botón para enviar la búsqueda -->
                <button type="submit" class="btn btn-primary d-flex align-items-center"
                    style="gap: 5px; height: 40px; font-weight: 500;">
                    <i class="mdi mdi-magnify"></i> Buscar
                </button>

                <!-- Botón para limpiar búsqueda -->
                @if (!empty($searchBajasTemporales))
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
                        <th>Nombre Empresa</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Motivo Baja</th>
                        <th>Fecha Baja</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($empresasSuspendidas as $empresa)
                        <tr>
                            <td>
                                {{ ($empresasSuspendidas->currentPage() - 1) * $empresasSuspendidas->perPage() + $loop->iteration }}
                            </td>
                            <td>{{ $empresa->nombre }}</td>
                            <td>{{ $empresa->telefono }}</td>
                            <td>{{ $empresa->email }}</td>
                            <td>{{ $empresa->motivo_baja }}</td>
                            <td>{{ $empresa->fecha_baja }}</td>

                            <td class="text-center">
                                {{-- Ver --}}
                                <x-buttons.show-button
                                    url="{{ route('empresas.show_establecidas', Hashids::encode($empresa->id)) }}" />

                                {{-- Restaurar --}}
                                <x-buttons.restore-button funcion="restoreUnidadEconomica"
                                    parametro="{{ Hashids::encode($empresa->id) }}" />

                                {{-- Eliminar permanente --}}
                                <x-buttons.delete-button funcion="destroyPermanent"
                                    parametro="{{ Hashids::encode($empresa->id) }}" />

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
                {{ $empresasSuspendidas->appends(['tab' => 'bajas_temporales'])->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>

</div>
