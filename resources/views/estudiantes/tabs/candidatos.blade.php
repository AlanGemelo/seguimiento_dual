{{-- <--TAB: CANDIDATOS A DUAL --> --}}
<div class="row">

    {{-- Header del tab --}}
    <div class="col-12 mb-3 d-flex justify-content-between align-items-center">
        <h6 class="mb-0">
            <i class="mdi mdi-account-clock text-warning me-1"></i>
            Lista de Candidatos a Dual
        </h6>

        @if (Auth::user()->rol_id === 1 || Auth::user()->rol_id === 4)
            <a href="{{ route('estudiantes.crearC') }}" class="btn btn-sm btn-add" title="Agregar nuevo candidato">
                <i class="mdi mdi-plus-circle-outline"></i>
            </a>
        @endif
    </div>

    {{-- Buscador --}}
    <div class="col-md-6 mb-3">
        <form method="GET" action="{{ route('estudiantes.index') }}">
            <input type="hidden" name="tab" value="candidatos">

            <div class="input-group">
                <input type="text" name="search_candidatos" class="form-control"
                    value="{{ $search_candidatos ?? '' }}" placeholder="Buscar candidato...">

                @if (!empty($search_candidatos))
                    <a href="{{ route('estudiantes.index', ['tab' => 'candidatos']) }}"
                        class="btn btn-outline-secondary d-flex align-items-center" title="Limpiar búsqueda">
                        <i class="mdi mdi-close"></i>
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
                        <th>Matricula</th>
                        <th>Candidato</th>
                        <th>Carrera</th>
                        <th>Email</th>
                        <th>Cuatrimestre</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($candidatos as $candidato)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $estudiante->matricula }}</td>
                            <td>
                                {{ $candidato->name }}
                                {{ $candidato->apellidoP }}
                                {{ $candidato->apellidoM }}
                            </td>

                            <td>{{ $candidato->carrera->nombre }}</td>

                            <td>
                                {{ $candidato->usuario?->email ?? 'Sin correo' }}
                            </td>

                            <td>{{ $candidato->cuatrimestre }}</td>

                            <td class="text-center">

                                {{-- Ver --}}
                                <a href="{{ route('estudiantes.showC', Vinkla\Hashids\Facades\Hashids::encode($candidato->matricula)) }}"
                                    class="btn btn-sm btn-facebook" title="Ver candidato">
                                    <i class="mdi mdi-eye"></i>
                                </a>

                                {{-- Aprobar (sube a Dual) --}}
                                <a href="{{ route('estudiantes.edit', Vinkla\Hashids\Facades\Hashids::encode($candidato->matricula)) }}"
                                    class="btn btn-sm btn-success" title="Aprobar candidato">
                                    <i class="mdi mdi-arrow-up-bold"></i>
                                </a>

                                {{-- Eliminar --}}
                                @if (Auth::user()->rol_id === 1 || Auth::user()->rol_id === 4)
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal1"
                                        onclick="deleteEstudiante({{ $candidato->matricula }},5)">
                                        <i class="mdi mdi-delete"></i>
                                    </button>
                                @endif

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="alert alert-warning mb-0">
                                    No hay candidatos registrados
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Paginación --}}
            <div class="d-flex justify-content-center mt-3">
                {{ $candidatos->appends(['tab' => 'candidatos'])->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>

</div>
