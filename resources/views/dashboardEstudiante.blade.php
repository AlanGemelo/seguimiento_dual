@extends ('layouts.app')
@section ('title', 'Dashboard Estudiante')

@section ('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboardestudiante.css') }}" />
@endsection

@section ('content')
    <div class="container">
        <div class="row">
            {{-- PERFIL --}}
            <div class="col-lg-3 col-md-4 d-flex">
                <div class="card shadow-sm w-100 perfil-card">
                    <div class="card-body text-center">
                        <div class="profile-avatar mb-3">
                            {{ strtoupper(substr($estudiante->name, 0, 1) . substr($estudiante->apellidoP, 0, 1)) }}
                        </div>

                        <h5 class="mb-1">
                            {{ $estudiante->name }} {{ $estudiante->apellidoP }} {{ $estudiante->apellidoM }}
                        </h5>

                        <p class="text-muted mb-2">
                            Matrícula: {{ $estudiante->matricula }}
                        </p>

                        <span
                            class="badge {{ match ($estudiante->status) {
                                0 => 'bg-success',
                                1 => 'bg-warning text-dark',
                                default => 'bg-secondary',
                            } }}"
                        >
                            {{ match ($estudiante->status) {
                                0 => 'Estudiante Dual',
                                1 => 'Candidato a Dual',
                                default => 'N/A',
                            } }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- CONTENIDO --}}
            <div class="col-lg-9 col-md-8">
                {{-- INFORMACIÓN PERSONAL --}}
                <div class="card shadow-sm mb-3">
                    <div class="card-header d-flex align-items-center">
                        <i class="mdi mdi-account me-2 text-success"></i>
                        <h6 class="mb-0">Información Personal</h6>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-12 mb-3">
                                <label class="info-label"
                                    >Correo institucional</label
                                >
                                <div class="info-value">
                                    {{ $estudiante->matricula }}<span>
                                        @utvtol
                                        .edu.mx</span
                                    >
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 mb-3">
                                <label class="info-label">CURP</label>
                                <div class="info-value">
                                    {{ $estudiante->curp }}
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-12 mb-3">
                                <label class="info-label"
                                    >Fecha de nacimiento</label
                                >
                                <div class="info-value">
                                    {{ \Carbon\Carbon::parse($estudiante->fecha_na)->locale('es')->translatedFormat('d \d\e F \d\e Y') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- INFORMACIÓN ACADÉMICA --}}
                <div class="card shadow-sm mb-3">
                    <div class="card-header d-flex align-items-center">
                        <i class="mdi mdi-school me-2 text-success"></i>
                        <h6 class="mb-0">Información Académica</h6>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-12 mb-3">
                                <label class="info-label">Carrera</label>
                                <div class="info-value">
                                    {{ $estudiante->direccion->name ?? 'No asignada' }}
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-12 mb-3">
                                <label class="info-label">Carrera</label>
                                <div class="info-value">
                                    {{ $estudiante->carrera->nombre ?? 'No asignada' }}
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-12 mb-3">
                                <label class="info-label">Cuatrimestre</label>
                                <div class="info-value">
                                    {{ $estudiante->cuatrimestre }}
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-12 mb-3">
                                <label class="info-label"
                                    >Mentor Académico</label
                                >
                                <div class="info-value">
                                    @if ($estudiante->academico)
                                        <p>
                                            {{ $estudiante->academico->name }} {{ $estudiante->academico->apellidoP }} {{ $estudiante->academico->apellidoM }}
                                        </p>
                                    @else
                                        <p>Académico no asignado</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- INFORMACIÓN DUAL --}}
                <div class="card shadow-sm mb-3">
                    <div class="card-header d-flex align-items-center">
                        <i class="mdi mdi-domain me-2 text-success"></i>
                        <h6 class="mb-0">Información Dual</h6>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-12 mb-3">
                                <label class="info-label"
                                    >Unidad Económica</label
                                >
                                <div class="info-value">
                                    {{ $estudiante->empresa->nombre ?? 'No asignada' }}
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-12 mb-3">
                                <label class="info-label"
                                    >Nombre del Proyecto</label
                                >
                                <div class="info-value">
                                    {{ $estudiante->nombre_proyecto ?? 'No registrado' }}
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-12 mb-3">
                                <label class="info-label"
                                    >Mentor Industrial</label
                                >
                                <div class="info-value">
                                    {{ $estudiante->asesorin?->name . ' ' . $estudiante->asesorin->apellidoM . ' ' . $estudiante->asesorin->apellidoP ?? 'No asignado' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- BENEFICIOS --}}
                <div class="card shadow-sm mb-3">
                    <div class="card-header d-flex align-items-center">
                        <i class="mdi mdi-cash me-2 text-success"></i>
                        <h6 class="mb-0">Beneficios</h6>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-12 mb-3">
                                <label class="info-label">Beca Dual</label>
                                <div class="info-value">
                                    {{ $becas[$estudiante->beca] ?? 'N/A' }}
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-12 mb-3">
                                <label class="info-label"
                                    >Apoyo Económico</label
                                >
                                <div class="info-value">
                                    {{ $tipoBeca[$estudiante->tipoBeca] ?? 'N/A' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- DOCUMENTACIÓN --}}
                <div class="card shadow-sm">
                    <div class="card-header d-flex align-items-center">
                        <i class="mdi mdi-file-document me-2 text-success"></i>
                        <h6 class="mb-0">Documentación</h6>
                    </div>

                    <div class="card-body">
                        <form
                            action="{{ route('estudiantes.updateDocDual', [Hashids::encode($estudiante->matricula), 'doc-dual']) }}"
                            method="POST"
                            enctype="multipart/form-data"
                        >
                            @csrf
                            @method ('PATCH')

                            <div class="list-group">
                                <div
                                    class="list-group-item d-flex justify-content-between align-items-center"
                                >
                                    <div>
                                        <strong>Formato 5.4</strong>
                                        <br />
                                        <small class="text-muted"
                                            >Documento del programa dual</small
                                        >
                                    </div>

                                    <div class="d-flex gap-2">
                                        {{-- Mostrar botón "Ver" solo si hay documento --}}
                                        @php
    $archivos = json_decode($estudiante->formato54, true);
@endphp

                                        @if (!empty($archivos))
                                            @foreach ($archivos as $file)
                                                <a
                                                    href="{{ Storage::url($file) }}"
                                                    target="_blank"
                                                    class="btn btn-sm btn-outline-primary mb-1"
                                                >
                                                    Ver
                                                </a>
                                            @endforeach
                                        @else
                                            <span class="text-muted"
                                                >No hay documentos</span
                                            >
                                        @endif

                                        {{-- Botón para actualizar --}}
                                        <button
                                            type="button"
                                            class="btn btn-sm btn-secondary"
                                            onclick="mostrarInput()"
                                        >
                                            Actualizar
                                        </button>
                                    </div>
                                </div>
                            </div>

                            {{-- Input y botón de guardar ocultos inicialmente --}}
                            <input
                                hidden
                                type="file"
                                id="formato54"
                                name="formato54[]"
                                multiple
                                accept=".pdf"
                            />
                            <button
                                hidden
                                id="guardar"
                                class="btn btn-success mt-3"
                            >
                                Guardar cambios
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section ('scripts')
    <script>
        function mostrarInput() {
            document.getElementById('formato54').hidden = false;
            document.getElementById('guardar').hidden = false;
        }
    </script>
@endsection
