<div class="row">

    {{-- Status --}}
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm h-100">
            <div class="card-header text-center header-empresa">
                <h6 class="mb-0">Estudiantes por Status</h6>
            </div>
            <div class="card-body">
                <select id="statusSelect" class="form-select mb-3">
                    <option value="">Seleccione un status</option>
                    <option value="0">Activos</option>
                    <option value="1">Inactivos</option>
                </select>

                <div id="estudiantesStatus" class="small"></div>

                <a href="#" id="exportStatusExcel" class="btn btn-success btn-sm w-100 mt-3">
                    Exportar a Excel
                </a>

            </div>
        </div>
    </div>

    {{-- Beca --}}
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm h-100">
            <div class="card-header text-center header-beca">
                <h6 class="mb-0">Estudiantes Becados</h6>
            </div>
            <div class="card-body">

                <select id="becaSelect" class="form-select mb-3">
                    <option value="">Seleccione una opción</option>
                    <option value="0">Becados</option>
                    <option value="1">Sin beca</option>
                </select>

                <div id="estudiantesBeca" class="small"></div>

                <a href="#" id="exportBecaExcel" class="btn btn-success btn-sm w-100 mt-3">
                    Exportar a Excel
                </a>

            </div>
        </div>
    </div>

    {{-- Mentor --}}
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm h-100">
            <div class="card-header text-center header-mentor">
                <h6 class="mb-0">Por Mentor Académico</h6>
            </div>
            <div class="card-body">

                <select id="mentorSelect" class="form-select mb-3">
                    <option value="">Seleccione un mentor</option>
                    @foreach ($mentores as $mentor)
                        <option value="{{ $mentor->id }}">
                            {{ $mentor->titulo }} {{ $mentor->name }} {{ $mentor->apellidoP }} {{ $mentor->apellidoM }}
                        </option>
                    @endforeach
                </select>

                <div id="estudiantesMentor" class="small"></div>

                <a href="#" id="exportMentorExcel" class="btn btn-success btn-sm w-100 mt-3">
                    Exportar a Excel
                </a>

            </div>
        </div>
    </div>

    {{-- Empresa --}}
    <div class="col-md-6 mb-4">
        <div class="card shadow-sm h-100">
            <div class="card-header text-center header-empresa">
                <h6 class="mb-0">Por Empresa</h6>
            </div>
            <div class="card-body">

                <select id="empresaSelect" class="form-select mb-3">
                    <option value="">Seleccione una empresa</option>
                    @foreach ($empresas as $empresa)
                        <option value="{{ $empresa->id }}">
                            {{ $empresa->nombre }}
                        </option>
                    @endforeach
                </select>

                <div id="estudiantesEmpresa" class="small"></div>

                <a href="#" id="exportEmpresaExcel" class="btn btn-success btn-sm w-100 mt-3">
                    Exportar a Excel
                </a>

            </div>
        </div>
    </div>

    {{-- Carrera --}}
    <div class="col-md-6 mb-4">
        <div class="card shadow-sm h-100">
            <div class="card-header text-center header-carrera">
                <h6 class="mb-0">Por Programa Educativo</h6>
            </div>
            <div class="card-body">

                <select id="carreraSelect" class="form-select mb-3">
                    <option value="">Seleccione un programa educativo</option>
                    @foreach ($carreras as $carrera)
                        <option value="{{ $carrera->id }}">
                            {{ $carrera->nombre }}
                        </option>
                    @endforeach
                </select>

                <div id="estudiantesCarrera" class="small"></div>

                <a href="#" id="exportCarreraExcel" class="btn btn-success btn-sm w-100 mt-3">
                    Exportar a Excel
                </a>

            </div>
        </div>
    </div>

</div>
