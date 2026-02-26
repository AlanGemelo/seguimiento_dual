{{-- <--TAB: Unidades Interesadas --> --}}
<div class="row">

    {{-- Header del tab --}}
    <div class="col-12 mb-3 d-flex justify-content-between align-items-center">
        <h6 class="mb-0">
            <i class="mdi mdi-account-clock text-warning me-1"></i>
            Lista de Unidaes Economicas Interesadas
        </h6>

        @if (Auth::user()->rol_id === 1 || Auth::user()->rol_id === 4)
            <div class="row g-2">
                <div class="col-auto">
                    <x-buttons.add-button url="{{ route('empresas.create') }}"
                        title="{{ 'Agregar nueva unidad económica' }}" />
                </div>
                <div class="col-auto">
                    <x-buttons.pdf-button url="{{ route('empresas.exportUeiPdf') }} " title="{{ 'Exportar PDF' }}" />
                </div>
            </div>
        @endif
    </div>
    {{-- Buscador --}}
    <div class="col-md-6 mb-3">
        <form method="GET" action="{{ route('empresas.index') }}">
            <input type="hidden" name="tab" value="unidades_interesadas">

            <div class="input-group">
                <!-- Input de búsqueda -->
                <input type="text" name="search_ue_interesadas" class="form-control"
                    value="{{ $searchUEInteresadas ?? '' }}" placeholder="Buscar Unidad Economica..."
                    style="height: 40px;">

                <!-- Botón para enviar la búsqueda -->
                <button type="submit" class="btn btn-primary d-flex align-items-center"
                    style="gap: 5px; height: 40px; font-weight: 500;">
                    <i class="mdi mdi-magnify"></i> Buscar
                </button>

                <!-- Botón para limpiar búsqueda -->
                @if (!empty($searchUEInteresadas))
                    <a href="{{ route('empresas.index', ['tab' => 'unidades_interesadas']) }}"
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
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>

                <tbody id="empresaInteresadasTable">
                    @forelse ($empresasInteresadas as $empresa)
                        <tr>
                            <td>
                                {{ ($empresasInteresadas->currentPage() - 1) * $empresasInteresadas->perPage() + $loop->iteration }}
                            </td>
                            <td>{{ $empresa->nombre }}</td>
                            <td>{{ $empresa->email }}</td>
                            <td>{{ $empresa->telefono }}</td>
                            <td>{{ $empresa->created_at->translatedFormat('d \d\e F \d\e Y') }}</td>
                            <td class="text-center">

                                {{-- Ver --}}
                                <x-buttons.show-button
                                    url="{{ route('empresas.show', Hashids::encode($empresa->id)) }}"
                                    title="{{ 'Ver Unidad Academica' }}" />
                                {{-- Aprobar --}}
                                <x-buttons.approve-button
                                    url="{{ route('empresas.darAlta', Hashids::encode($empresa->id)) }}"
                                    title="{{ 'Aprobar Unidad Economica' }}" />
                                {{-- Eliminar --}}
                                @if (Auth::user()->rol_id === 1 || Auth::user()->rol_id === 4)
                                    {{-- <x-buttons.delete-button funcion="deleteUnidadEconomica"
                                        parametro="{{ $empresa->id }}" /> --}}
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="alert alert-warning mb-0">
                                    No hay Undidades Economicas Interesadas Registradas
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Paginación --}}
            <div class="d-flex justify-content-center mt-3">
                {{ $empresasInteresadas->appends(['tab' => 'unidades_interesadas'])->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>

</div>
