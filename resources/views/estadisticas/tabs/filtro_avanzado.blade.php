<div class="card shadow-sm">
    <div class="card-body">

        <form id="filtroEstudiantesForm">

            <div class="row mb-3">
                {{-- 1. Tipo de Alumno --}}
                <div class="col-md-6">
                    <label class="form-label">Tipo de Alumno</label>
                    <select id="tipoAlumnoSelect" name="tipoAlumno" class="form-select">
                        <option value="">Seleccione</option>
                        <option value="activo">Activo</option>
                        <option value="inactivo">Inactivo</option>
                    </select>
                </div>

                {{-- 2. Estatus --}}
                <div class="col-md-6">
                    <label class="form-label">Estatus del Estudiante</label>
                    <select id="estatusAcademicoSelect" name="estatus_academico" class="form-select" disabled>
                        <option value="">Seleccione</option>

                        <option value="0" data-group="activo">Primera vez</option>
                        <option value="1" data-group="activo">Renovación Dual</option>

                        <option value="2" data-group="inactivo">Reprobación</option>
                        <option value="3" data-group="inactivo">Término de Convenio</option>
                        <option value="4" data-group="inactivo">Ciclo Concluido</option>
                        <option value="5" data-group="inactivo">Término PE</option>
                    </select>
                </div>
            </div>

            {{-- 3. Filtros secundarios --}}
            <div class="row mb-3">

                <div class="col-md-4">
                    <label>Empresa</label>
                    <select id="empresaSelectFiltro" name="empresa_id" class="form-select" disabled>
                        <option value="">Seleccione una unidad economica</option>
                        @foreach ($empresas as $empresa)
                            <option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label>Mentor</label>
                    <select id="mentorSelectFiltro" name="academico_id" class="form-select" disabled>
                        <option value="">Seleccione un mentor academico</option>
                        @foreach ($mentores as $mentor)
                            <option value="{{ $mentor->id }}">
                                {{ $mentor->titulo . '. ' . $mentor->name . ' ' . $mentor->apellidoP . ' ' . $mentor->apellidoM }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label>Programa Educativo</label>
                    <select id="carreraSelectFiltro" name="carrera_id" class="form-select" disabled>
                        <option value="">Seleccione un programa educativo</option>
                        @foreach ($carreras as $carrera)
                            <option value="{{ $carrera->id }}">{{ $carrera->nombre }}</option>
                        @endforeach
                    </select>
                </div>

            </div>

            {{-- 4. Beca + Fecha --}}
            <div class="row mb-3">

                <div class="col-md-6">
                    <label>Tipo de Beca</label>
                    <select id="tipoBecaSelect" name="tipoBeca" class="form-select" disabled>
                        <option value="">Seleccione un tipo de beca</option>
                        <option value="sin">Sin beca</option>
                        <option value="0">Apoyo Empresa</option>
                        <option value="1">Comecyt</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label>Filtro por Fecha</label>
                    <select id="fechaFiltro" name="fechaFiltro" class="form-select" disabled>
                        <option value="">Seleccione el criterio de fecha</option>
                        <option value="inicio">Inicio IE</option>
                        <option value="fin">Fin IE</option>
                        <option value="inicio_dual">Inicio Dual</option>
                        <option value="fin_dual">Fin Dual</option>
                    </select>
                </div>

            </div>

            {{-- 5. Rango --}}
            <div class="row mb-3">

                <div class="col-md-6">
                    <label>Mes inicio</label>
                    <input type="month" id="fechaInicio" name="fechaInicio" class="form-control" disabled>
                </div>

                <div class="col-md-6">
                    <label>Mes fin</label>
                    <input type="month" id="fechaFin" name="fechaFin" class="form-control" disabled>
                </div>

            </div>

            {{-- Acciones --}}
            <div class="text-end">
                <button type="button" id="exportFiltroExcel" class="btn btn-success btn-sm" disabled>
                    Exportar Excel
                </button>
            </div>

        </form>

        <div id="filtroLoader" class="text-center my-2" style="display:none;">
            <div class="spinner-border text-success" role="status"></div>
            <div class="small text-muted">Cargando filtros...</div>
        </div>
        {{-- Resultados --}}
        <div class="mt-4">
            <h6>Resultados</h6>
            <div id="estudiantesFiltro"></div>
        </div>

    </div>
</div>
