<div class="row">

    {{-- HEADER --}}
    <div class="col-12 mb-3 d-flex justify-content-between align-items-center">
        <h6 class="mb-0">
            <i class="mdi mdi-alert-outline text-danger me-1"></i>
            Convenios por vencer y vencidos - Empresas
        </h6>
    </div>

    {{-- RESUMEN --}}
    <div class="col-12 mb-3">
        <div class="d-flex gap-3 flex-wrap">

            <span class="badge bg-danger p-2">
                Vencidos: {{ $convenios_vencidos->count() }}
            </span>

            <span class="badge bg-warning text-dark p-2">
                Próximos a vencer: {{ $convenios_proximos->count() }}
            </span>

        </div>
    </div>

    {{-- TABLA --}}
    <div class="col-12">
        <div class="table-responsive">

            <table class="table table-hover align-middle table-sm lh-lg">

                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Empresa</th>
                        <th>Convenio</th>
                        <th>Vence</th>
                        <th>Días</th>
                        <th>Estado</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($empresas as $empresa)
                        @php
                            $convenio = $empresa->convenios->first();

                            if ($convenio) {
                                $fechaFin = \Carbon\Carbon::parse($convenio->fin);
                                $dias = now()->diffInDays($fechaFin, false);
                            } else {
                                $fechaFin = null;
                                $dias = null;
                            }
                        @endphp

                        <tr
                            class="
                                @if ($dias !== null && $dias < 0) table-danger
                                @elseif($dias !== null && $dias <= 15) table-warning @endif
                            ">

                            {{-- NUMERO --}}
                            <td>
                                {{ ($empresas->currentPage() - 1) * $empresas->perPage() + $loop->iteration }}
                            </td>

                            {{-- EMPRESA --}}
                            <td>
                                <div class="d-flex flex-column gap-1">
                                    <span class="fw-semibold">
                                        {{ $empresa->nombre }}
                                    </span>

                                    <span class="text-muted small">
                                        {{ $empresa->telefono }}
                                    </span>
                                </div>
                            </td>

                            {{-- CONVENIO --}}
                            <td>
                                <div class="d-flex flex-column gap-1">

                                    <span class="fw-semibold">
                                        {{ $convenio->tipo ?? 'Sin convenio' }}
                                    </span>

                                    @if ($convenio)
                                        <span class="text-muted small">
                                            {{ \Carbon\Carbon::parse($convenio->inicio)->format('Y') }}
                                            -
                                            {{ \Carbon\Carbon::parse($convenio->fin)->format('Y') }}
                                        </span>
                                    @endif

                                </div>
                            </td>

                            {{-- FECHA FIN --}}
                            <td>
                                @if ($convenio)
                                    {{ \Carbon\Carbon::parse($convenio->fin)->format('d/m/Y') }}
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>

                            {{-- DIAS --}}
                            <td>
                                @if ($dias !== null)
                                    {{ $dias }}
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>

                            {{-- ESTADO --}}
                            <td>
                                @if ($dias === null)
                                    <span class="badge bg-secondary">Sin convenio</span>
                                @elseif ($dias < 0)
                                    <span class="badge bg-danger">Vencido</span>
                                @elseif ($dias <= 15)
                                    <span class="badge bg-warning text-dark">Por vencer</span>
                                @else
                                    <span class="badge bg-success">Vigente</span>
                                @endif
                            </td>

                            {{-- ACCIONES --}}
                            <td class="text-center">

                                <a href="{{ route('empresas.show_establecidas', Hashids::encode($empresa->id)) }}"
                                    class="btn btn-sm btn-outline-primary" title="Ver empresa"
                                    style="transition: none;">
                                    <i class="mdi mdi-eye"></i>
                                </a>

                                <a href="#" class="btn btn-sm btn-outline-secondary" title="Enviar correo"
                                    style="transition: none;">
                                    <i class="mdi mdi-email"></i>
                                </a>

                                <a href="{{ route('empresas.renovar', $empresa->id) }}"
                                    class="btn btn-sm btn-outline-success" title="Renovar convenio"
                                    style="transition: none;">
                                    <i class="mdi mdi-refresh"></i>
                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="7">
                                <div class="alert alert-info mb-0 text-center">
                                    No hay convenios próximos a vencer o vencidos
                                </div>
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>

            {{-- PAGINACIÓN --}}
            <div class="d-flex justify-content-center mt-3">
                {{ $empresas->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>

</div>
