<div class="row">

    {{-- HEADER --}}
    <div class="col-12 mb-3 d-flex justify-content-between align-items-center">
        <h6 class="mb-0">
            <i class="mdi mdi-alert-circle text-warning me-1"></i>
            Estudiantes Dual - Próximos a vencer / Vencidos
        </h6>
    </div>

    {{-- RESUMEN COMPACTO --}}
    <div class="col-12 mb-3">
        <div class="d-flex gap-3 flex-wrap">

            <span class="badge bg-danger p-2">
                Vencidos: {{ $estudiantes_vencidos->count() }}
            </span>

            <span class="badge bg-warning text-dark p-2">
                Próximos: {{ $estudiantes_proximos->count() }}
            </span>

        </div>
    </div>

    {{-- TABLA --}}
    <div class="col-12">
        <div class="table-responsive">

            <table class="table table-hover align-middle table-sm">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Matrícula</th>
                        <th>Estudiante</th>
                        <th>Programa educativo</th>
                        <th>Fin Dual</th>
                        <th>Días</th>
                        <th>Estado</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>

                <tbody>

                    @php
                        $coleccion = $estudiantes
                            ->filter(function ($e) {
                                return $e->fin_dual != null;
                            })
                            ->sortBy('fin_dual');
                    @endphp

                    @forelse ($coleccion as $estudiante)
                        @php
                            $fechaFin = \Carbon\Carbon::parse($estudiante->fin_dual);
                            $dias = now()->diffInDays($fechaFin, false);
                        @endphp

                        <tr
                            class="
                            @if ($dias < 0) table-danger
                            @elseif($dias <= 15) table-warning @endif
                        ">

                            {{-- # --}}
                            <td>
                                {{ ($estudiantes->currentPage() - 1) * $estudiantes->perPage() + $loop->iteration }}
                            </td>

                            {{-- MATRÍCULA --}}
                            <td class="fw-semibold">
                                {{ $estudiante->matricula }}
                            </td>

                            {{-- NOMBRE --}}
                            <td>
                                {{ $estudiante->name }}
                                {{ $estudiante->apellidoP }}
                                {{ $estudiante->apellidoM }}
                            </td>

                            {{-- CARRERA --}}
                            <td>
                                <small>{{ $estudiante->carrera->nombre }}</small>
                            </td>

                            {{-- FIN DUAL --}}
                            <td>
                                {{ $estudiante->fin_dual }}
                            </td>

                            {{-- DIAS --}}
                            <td>
                                <span class="small">
                                    {{ $dias }}
                                </span>
                            </td>

                            {{-- ESTADO --}}
                            <td>
                                @if ($dias < 0)
                                    <span class="badge bg-danger">Vencido</span>
                                @elseif($dias <= 15)
                                    <span class="badge bg-warning text-dark">Próximo</span>
                                @else
                                    <span class="badge bg-success">Vigente</span>
                                @endif
                            </td>

                            {{-- ACCIONES --}}
                            <td class="text-center">

                                {{-- Ver --}}
                                <x-buttons.show-button
                                    url="{{ route('estudiantes.show', Hashids::encode($estudiante->matricula)) }}" />

                                {{-- Enviar Correo --}}
                                <a href="#" class="btn btn-sm btn-outline-secondary" title="Enviar correo"
                                    style="transition: none;">
                                    <i class="mdi mdi-email"></i>
                                </a>

                                {{-- Renovar --}}
                                <a href="{{ route('estudiantes.renovar', $estudiante->matricula) }}"
                                    class="btn btn-sm btn-outline-success" title="Renovar convenio"
                                    style="transition: none;">
                                    <i class="mdi mdi-refresh"></i>
                                </a>

                            </td>

                        </tr>

                    @empty
                        <tr>
                            <td colspan="8">
                                <div class="alert alert-info mb-0 text-center">
                                    No hay estudiantes con periodo dual próximo a vencer o vencido
                                </div>
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>

            {{-- PAGINACIÓN --}}
            <div class="d-flex justify-content-center mt-3">
                {{ $estudiantes->appends(['tab' => 'dual'])->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>

</div>
