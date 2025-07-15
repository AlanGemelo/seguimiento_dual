@extends('layouts.app')
@section('title', 'Estadísticas')

@section('content')
<body class="body">
    <div class="container mt-5">
        <!-- Encabezado principal -->
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header-adjusted">

                        <h6 class="card-title">Estadísticas Generales de la Direccion:
                            {{ session('direccion')->name }}</h6>

                    </div>
                    <div class="card-body">
                        <!-- Selectores de Estadísticas -->
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-header bg-primary text-white rounded">
                                        <h5 class="text-center fw-bold ">Estudiantes por Status</h5>
                                    </div>
                                    <div class="card-body">
                                        <select id="statusSelect" class="form-select border border-dark rounded">
                                            <option value="">Seleccione un Status</option>
                                            <option value="0">Activos</option>
                                            <option value="1">Inactivos</option>
                                            <option value="2">Egresados</option>
                                            <option value="3">Bajas</option>
                                        </select>

                                        <div id="estudiantesStatus" class="mt-3"></div>
                                        <div class="text-center mt-3">
                                            <a href="#" id="exportStatusExcel"
                                                class="btn btn-success text-white">Exportar a Excel</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-header bg-danger text-white rounded">
                                        <h5 class="text-center fw-bold">Estudiantes Becados</h5>
                                    </div>
                                    <div class="card-body">
                                        <select id="becaSelect" class="form-select border border-dark rounded">
                                            <option value="">Seleccione una Opción</option>
                                            <option value="becados">Becados</option>
                                            <option value="sin_beca">Sin Beca</option>
                                        </select>
                                        <div id="estudiantesBeca" class="mt-3"></div>
                                        <div class="text-center mt-3">
                                            <a href="#" id="exportBecaExcel"
                                                class="btn btn-success text-white">Exportar a Excel</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-header bg-info text-white rounded">
                                        <h5 class="text-center fw-bold">Estudiantes por Mentor Académico</h5>
                                    </div>
                                    <div class="card-body">
                                        <select id="mentorSelect" class="form-select border border-dark rounded">
                                            <option value="">Seleccione un Mentor Académico</option>
                                            @foreach ($mentores as $mentor)
                                                <option value="{{ $mentor->id }}">
                                                    {{ $mentor->titulo . ' ' . $mentor->name . ' ' . $mentor->apellidoP . ' ' . $mentor->apellidoM }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div id="estudiantesMentor" class="mt-3"></div>
                                        <div class="text-center mt-3">
                                            <a href="#" id="exportMentorExcel"
                                                class="btn btn-success text-white">Exportar a Excel</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-header bg-warning text-white rounded">
                                        <h5 class="text-center fw-bold">Estudiantes por Empresa</h5>
                                    </div>
                                    <div class="card-body">
                                        <select id="empresaSelect" class="form-select border border-dark rounded">
                                            <option value="">Seleccione una Empresa</option>
                                            @foreach ($empresas as $empresa)
                                                <option value="{{ $empresa->id }}">
                                                    {{ $empresa->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div id="estudiantesEmpresa" class="mt-3"></div>
                                        <div class="text-center mt-3">
                                            <a href="#" id="exportEmpresaExcel"
                                                class="btn btn-success text-white">Exportar a Excel</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-header bg-secondary text-white rounded">
                                        <h5 class="text-center fw-bold">Estudiantes por Carrera</h5>
                                    </div>
                                    <div class="card-body">
                                        <select id="carreraSelect" class="form-select border border-dark rounded">
                                            <option value="">Seleccione una Carrera</option>
                                            @foreach ($carreras as $carrera)
                                                <option value="{{ $carrera->id }}">
                                                    {{ $carrera->grado_academico . ' en ' . $carrera->nombre }}</option>
                                            @endforeach
                                        </select>
                                        <div id="estudiantesCarrera" class="mt-3"></div>
                                        <div class="text-center mt-3">
                                            <a href="#" id="exportCarreraExcel"
                                                class="btn btn-success text-white">Exportar a Excel</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Fin de Selectores -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <!-- Filtro de Estudiantes -->
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header-adjusted">

                        <h6 class="card-title">Filtro de Estudiantes</h6>

                    </div>
                    <div class="card-body">
                        <form id="filtroEstudiantesForm">
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="estatusSelect" class="form-label text-dark">Estatus del
                                            Estudiante</label>
                                        <select id="estatusSelect" name="estatus"
                                            class="form-select border border-dark rounded">
                                            <option value="">Seleccione un Estatus</option>
                                            <option value="0">Reprobación</option>
                                            <option value="1">Término de Convenio</option>
                                            <option value="2">Ciclo de Renovación Concluido</option>
                                            <option value="3">Término del PE</option>
                                            <option value="activo">Activo</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="empresaSelectFiltro" class="form-label text-dark">Empresa</label>
                                        <select id="empresaSelectFiltro" name="empresa_id"
                                            class="form-select border border-dark rounded" disabled>
                                            <option value="">Seleccione una Empresa</option>
                                            @foreach ($empresas as $empresa)
                                                <option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mentorSelectFiltro" class="form-label text-dark">Mentor
                                            Académico</label>
                                        <select id="mentorSelectFiltro" name="academico_id"
                                            class="form-select border border-dark rounded" disabled>
                                            <option value="">Seleccione un Mentor Académico</option>
                                            @foreach ($mentores as $mentor)
                                                <option value="{{ $mentor->id }}">
                                                    {{ $mentor->titulo . ' ' . $mentor->name . ' ' . $mentor->apellidoP . ' ' . $mentor->apellidoM }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="carreraSelectFiltro" class="form-label text-dark">Carrera</label>
                                        <select id="carreraSelectFiltro" name="carrera_id"
                                            class="form-select border border-dark rounded" disabled>
                                            <option value="">Seleccione una Carrera</option>
                                            @foreach ($carreras as $carrera)
                                                <option value="{{ $carrera->id }}">{{ $carrera->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tipoBecaSelect" class="form-label text-dark">Tipo de Beca</label>
                                        <select id="tipoBecaSelect" name="tipoBeca"
                                            class="form-select border border-dark rounded" disabled>
                                            <option value="">Seleccione un Tipo de Beca</option>
                                            <option value="0">Apoyo por Empresa</option>
                                            <option value="1">Beca Dual Comecyt</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fechaFiltro" class="form-label text-dark">Filtrar por Fechas</label>
                                        <select id="fechaFiltro" name="fechaFiltro"
                                            class="form-select border border-dark rounded" disabled>
                                            <option value="">Seleccione una Opción</option>
                                            <option value="inicio">Fecha de Inicio en la IE</option>
                                            <option value="fin">Fecha de Fin en la IE</option>
                                            <option value="inicio_dual">Fecha de Inicio en Dual</option>
                                            <option value="fin_dual">Fecha de Fin en Dual</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fechaInicio" class="form-label text-dark">Fecha de Inicio</label>
                                        <input type="date" id="fechaInicio" name="fechaInicio"
                                            class="form-control border border-dark rounded" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fechaFin" class="form-label text-dark">Fecha de Fin</label>
                                        <input type="date" id="fechaFin" name="fechaFin"
                                            class="form-control border border-dark rounded" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center mt-3">
                                <button type="button" id="exportFiltroExcel" class="btn btn-success text-white"
                                    disabled>Exportar a Excel</button>
                            </div>
                        </form>
                        <div id="estudiantesFiltro" class="mt-4"></div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.getElementById('estatusSelect').addEventListener('change', function() {
                let isEnabled = this.value !== '';
                document.getElementById('empresaSelectFiltro').disabled = !isEnabled;
                document.getElementById('mentorSelectFiltro').disabled = !isEnabled;
                document.getElementById('carreraSelectFiltro').disabled = !isEnabled;
                document.getElementById('tipoBecaSelect').disabled = !isEnabled;
                document.getElementById('fechaFiltro').disabled = !isEnabled;
                document.getElementById('fechaInicio').disabled = !isEnabled;
                document.getElementById('fechaFin').disabled = !isEnabled;
                document.getElementById('exportFiltroExcel').disabled = !isEnabled;
            });
        </script>
    </div>

    <div class="container mt-5">
        <!-- Gráficas -->
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header-adjusted">

                        <h6 class="card-title">Gráficas de Estadísticas</h6>

                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-header text-white rounded" style="background-color: #006837;">
                                        <h5 class="text-center m-0 fw-bold">Estudiantes por Empresa</h5>
                                    </div>
                                    <div class="card-body d-flex flex-column">
                                        <div style="height: 300px;">
                                            {!! $chartEmpresa->container() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-header text-dark rounded" style="background-color: #f5f5f5">
                                        <h5 class="text-center m-0 fw-bold">Estudiantes por Carrera</h5>
                                    </div>
                                    <div class="card-body d-flex flex-column">
                                        <div style="height: 300px;">
                                            {!! $chartCarrera->container() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-header text-white rounded" style="background-color: #66bb6a;">
                                        <h5 class="text-center m-0 fw-bold">Estudiantes por Mentor Académico</h5>
                                    </div>
                                    <div class="card-body d-flex flex-column">
                                        <div style="height: 300px;">
                                            {!! $chartMentor->container() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-header bg-warning text-white rounded">
                                        <h5 class="text-center m-0 fw-bold">Estudiantes Becados</h5>
                                    </div>
                                    <div class="card-body d-flex flex-column">
                                        <div style="height: 300px;">
                                            {!! $chartBeca->container() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ LarapexChart::cdn() }}"></script>
    @foreach ([$chartEmpresa, $chartCarrera, $chartMentor, $chartBeca] as $chart)
        {!! $chart->script() !!}
    @endforeach

    <script>
        document.getElementById('statusSelect').addEventListener('change', function() {
            let status = this.value;
            if (status) {
                fetch(`/${window.BASE_URL}/estadisticas/status/${status}`)
                    .then(response => response.json())
                    .then(data => {
                        let estudiantesStatus = document.getElementById('estudiantesStatus');
                        estudiantesStatus.innerHTML = '<ul>' + data.map(est =>
                            `<li>${est.name} ${est.apellidoP} ${est.apellidoM}</li>`).join(
                            '') + '</ul>';
                        document.getElementById('exportStatusExcel').href =
                            `/${window.BASE_URL}/estadisticas/status/${status}/excel`;
                    });
            } else {
                document.getElementById('estudiantesStatus').innerHTML = '';
                document.getElementById('exportStatusExcel').href = '#';
            }
        });

        document.getElementById('becaSelect').addEventListener('change', function() {
            let beca = this.value;
            if (beca) {
                fetch(`/${window.BASE_URL}/estadisticas/beca/${beca}`)
                    .then(response => response.json())
                    .then(data => {
                        let estudiantesBeca = document.getElementById('estudiantesBeca');
                        estudiantesBeca.innerHTML = '<ul>' + data.map(est =>
                                `<li>${est.name} ${est.apellidoP} ${est.apellidoM}</li>`).join('') +
                            '</ul>';
                        document.getElementById('exportBecaExcel').href =
                            `/${window.BASE_URL}/estadisticas/beca/${beca}/excel`;
                    });
            } else {
                document.getElementById('estudiantesBeca').innerHTML = '';
                document.getElementById('exportBecaExcel').href = '#';
            }
        });

        document.getElementById('mentorSelect').addEventListener('change', function() {
            let mentorId = this.value;
            if (mentorId) {
                fetch(`/${window.BASE_URL}/estadisticas/mentor/${mentorId}`)
                    .then(response => response.json())
                    .then(data => {
                        let estudiantesMentor = document.getElementById('estudiantesMentor');
                        estudiantesMentor.innerHTML = '<ul>' + data.map(est =>
                            `<li>${est.name} ${est.apellidoP} ${est.apellidoM}</li>`).join(
                            '') + '</ul>';
                        document.getElementById('exportMentorExcel').href =
                            `/${window.BASE_URL}/estadisticas/mentor/${mentorId}/excel`;
                    });
            } else {
                document.getElementById('estudiantesMentor').innerHTML = '';
                document.getElementById('exportMentorExcel').href = '#';
            }
        });

        document.getElementById('empresaSelect').addEventListener('change', function() {
            let empresaId = this.value;
            if (empresaId) {
                fetch(`/${window.BASE_URL}/estadisticas/empresa/${empresaId}`)
                    .then(response => response.json())
                    .then(data => {
                        let estudiantesEmpresa = document.getElementById('estudiantesEmpresa');
                        estudiantesEmpresa.innerHTML = '<ul>' + data.map(est =>
                            `<li>${est.name} ${est.apellidoP} ${est.apellidoM}</li>`).join(
                            '') + '</ul>';
                        document.getElementById('exportEmpresaExcel').href =
                            `/${window.BASE_URL}/estadisticas/empresa/${empresaId}/excel`;
                    });
            } else {
                document.getElementById('estudiantesEmpresa').innerHTML = '';
                document.getElementById('exportEmpresaExcel').href = '#';
            }
        });

        document.getElementById('carreraSelect').addEventListener('change', function() {
            let carreraId = this.value;
            if (carreraId) {
                fetch(`/${window.BASE_URL}/estadisticas/carrera/${carreraId}`)
                    .then(response => response.json())
                    .then(data => {
                        let estudiantesCarrera = document.getElementById('estudiantesCarrera');
                        estudiantesCarrera.innerHTML = '<ul>' + data.map(est =>
                            `<li>${est.name} ${est.apellidoP} ${est.apellidoM}</li>`).join(
                            '') + '</ul>';
                        document.getElementById('exportCarreraExcel').href =
                            `/${window.BASE_URL}/estadisticas/carrera/${carreraId}/excel`;
                    });
            } else {
                document.getElementById('estudiantesCarrera').innerHTML = '';
                document.getElementById('exportCarreraExcel').href = '#';
            }
        });

        document.getElementById('exportFiltroExcel').addEventListener('click', function() {
            let form = document.getElementById('filtroEstudiantesForm');
            let formData = new FormData(form);
            let queryString = new URLSearchParams(formData).toString();
            window.location.href = `/${window.BASE_URL}/estadisticas/filtro/excel?${queryString}`;
        });

        function actualizarEstudiantesFiltro() {
            let form = document.getElementById('filtroEstudiantesForm');
            let formData = new FormData(form);
            let queryString = new URLSearchParams(formData).toString();

            fetch(`/${window.BASE_URL}/estadisticas/filtro?${queryString}`)
                .then(response => response.json())
                .then(data => {
                    let estudiantesFiltro = document.getElementById('estudiantesFiltro');
                    estudiantesFiltro.innerHTML = '<ul>' + data.map(est =>
                        `<li>${est.name} ${est.apellidoP} ${est.apellidoM}</li>`).join('') + '</ul>';
                });
        }

        document.getElementById('empresaSelectFiltro').addEventListener('change', actualizarEstudiantesFiltro);
        document.getElementById('mentorSelectFiltro').addEventListener('change', actualizarEstudiantesFiltro);
        document.getElementById('carreraSelectFiltro').addEventListener('change', actualizarEstudiantesFiltro);
        document.getElementById('tipoBecaSelect').addEventListener('change', actualizarEstudiantesFiltro);
        document.getElementById('estatusSelect').addEventListener('change', actualizarEstudiantesFiltro);
        document.getElementById('fechaFiltro').addEventListener('change', actualizarEstudiantesFiltro);
        document.getElementById('fechaInicio').addEventListener('change', actualizarEstudiantesFiltro);
        document.getElementById('fechaFin').addEventListener('change', actualizarEstudiantesFiltro);
    </script>
@endsection
</body>