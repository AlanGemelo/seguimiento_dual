{{-- TAB: ESTUDIANTES DUAL --}}

<div class="row">

    {{-- Header --}}
    <div class="col-12 mb-3 d-flex justify-content-between align-items-center">
        <h6 class="mb-0">
            <i class="mdi mdi-check-circle text-success me-1"></i>
            Unidades Economicas
        </h6>

        {{--   @if (Auth::user()->rol_id === 1 || Auth::user()->rol_id === 2 || Auth::user()->rol_id === 4)
            <a href="{{ route('empresas.create') }}" class="btn btn-sm btn-add" title="Agregar unidad Económica">
                <i class="mdi mdi-plus-circle-outline"></i>
            </a>
        @endif --}}
    </div>

    {{-- Buscador --}}
    <div class="col-md-6 mb-3">
        <form method="GET" action="{{ route('empresas.index') }}">
            <input type="hidden" name="tab" value="unidades_registradas">

            <div class="input-group">
                <input type="text" name="search_ue" class="form-control" style="height: 40px;"
                    value="{{ $searchUE ?? '' }}" placeholder="Buscar Unidad Economica...">

                <!-- Botón para enviar la búsqueda -->
                <button type="submit" class="btn btn-primary d-flex align-items-center"
                    style="gap: 5px; height: 40px; font-weight: 500;">
                    <i class="mdi mdi-magnify"></i> Buscar
                </button>

                @if (!empty($searchUE))
                    <!-- Botón para limpiar búsqueda -->
                    <a href="{{ route('empresas.index', ['tab' => 'unidades_registradas']) }}"
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
                        <th>Nombre de la UE</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Fecha de Registro</th>
                        <th>Convenio </th>
                        <th>No.<br>Alumnos</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>

                <tbody id="empresaTable">
                    @forelse ($empresas ?? collect() as $empresa)
                        <tr>
                            <td>
                                {{ ($empresas->currentPage() - 1) * $empresas->perPage() + $loop->iteration }}
                            </td>
                            <td>{{ $empresa->nombre }}</td>
                            <td>{{ $empresa->email }}</td>
                            <td>{{ $empresa->telefono }}</td>
                            <td>{{ $empresa->created_at->format('d \d\e F \d\e Y') }}</td>
                            <td>{{ $empresa->inicio_conv }} a {{ $empresa->fin_conv }}</td>
                            <td>{{ $empresa->estudiantes_count }}</td>
                            <td class="text-center">
                                {{-- Ver --}}
                                <x-buttons.show-button
                                    url="{{ route('empresas.show_establecidas', Vinkla\Hashids\Facades\Hashids::encode($empresa->id)) }}" />
                                {{-- Editar --}}
                                <x-buttons.edit-button
                                    url="{{ route('empresas.edit', Vinkla\Hashids\Facades\Hashids::encode($empresa->id)) }}"
                                    title="Editar UE" />
                                {{-- Eliminar --}}
                                @if (Auth::user()->rol_id === 1 || Auth::user()->rol_id === 4)
                                    <a href="{{ route('empresas.suspendForm', Vinkla\Hashids\Facades\Hashids::encode($empresa->id)) }}"
                                        class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Dar de baja">
                                        <i class="mdi mdi-store-off"></i>
                                    </a>
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
                {{ $empresas->appends(['tab' => 'unidades_registradas'])->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>

</div>
