@extends('layouts.app')
@section('title', 'Estadísticas')
@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg">
                <div class="card-header bg-dark text-white">
                    <h4 class="text-center">Estadísticas Generales</h4>
                </div>
                <div class="card-body">
                    <!-- Selectores de Estudiantes por Status, Becados, Mentores Académicos, Empresas y Carreras -->
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="text-center">Estudiantes por Status</h5>
                                </div>
                                <div class="card-body">
                                    <select id="statusSelect" class="form-control">
                                        <option value="">Seleccione un Status</option>
                                        <option value="activos">Activos</option>
                                        <option value="inactivos">Inactivos</option>
                                        <option value="egresados">Egresados</option>
                                        <option value="baja">Bajas</option>
                                    </select>
                                    <div id="estudiantesStatus" class="mt-3"></div>
                                    <div class="text-center mt-3">
                                        <a href="#" id="exportStatusExcel" class="btn btn-info">Exportar a Excel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header bg-danger text-white">
                                    <h5 class="text-center">Estudiantes Becados</h5>
                                </div>
                                <div class="card-body">
                                    <select id="becaSelect" class="form-control">
                                        <option value="">Seleccione una Opción</option>
                                        <option value="becados">Becados</option>
                                        <option value="sin_beca">Sin Beca</option>
                                    </select>
                                    <div id="estudiantesBeca" class="mt-3"></div>
                                    <div class="text-center mt-3">
                                        <a href="#" id="exportBecaExcel" class="btn btn-info">Exportar a Excel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header bg-info text-white">
                                    <h5 class="text-center">Estudiantes por Mentor Académico</h5>
                                </div>
                                <div class="card-body">
                                    <select id="mentorSelect" class="form-control">
                                        <option value="">Seleccione un Mentor Académico</option>
                                        @foreach($mentores as $mentor)
                                            <option value="{{ $mentor->id }}">{{ $mentor->name }}</option>
                                        @endforeach
                                    </select>
                                    <div id="estudiantesMentor" class="mt-3"></div>
                                    <div class="text-center mt-3">
                                        <a href="#" id="exportMentorExcel" class="btn btn-info">Exportar a Excel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-warning text-white">
                                    <h5 class="text-center">Estudiantes por Empresa</h5>
                                </div>
                                <div class="card-body">
                                    <select id="empresaSelect" class="form-control">
                                        <option value="">Seleccione una Empresa</option>
                                        @foreach($empresas as $empresa)
                                            <option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
                                        @endforeach
                                    </select>
                                    <div id="estudiantesEmpresa" class="mt-3"></div>
                                    <div class="text-center mt-3">
                                        <a href="#" id="exportEmpresaExcel" class="btn btn-info">Exportar a Excel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-secondary text-white">
                                    <h5 class="text-center">Estudiantes por Carrera</h5>
                                </div>
                                <div class="card-body">
                                    <select id="carreraSelect" class="form-control">
                                        <option value="">Seleccione una Carrera</option>
                                        @foreach($carreras as $carrera)
                                            <option value="{{ $carrera->id }}">{{ $carrera->nombre }}</option>
                                        @endforeach
                                    </select>
                                    <div id="estudiantesCarrera" class="mt-3"></div>
                                    <div class="text-center mt-3">
                                        <a href="#" id="exportCarreraExcel" class="btn btn-info">Exportar a Excel</a>
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

<script>
document.getElementById('statusSelect').addEventListener('change', function() {
    let status = this.value;
    if (status) {
        fetch(`/estadisticas/status/${status}`)
            .then(response => response.json())
            .then(data => {
                let estudiantesStatus = document.getElementById('estudiantesStatus');
                estudiantesStatus.innerHTML = '<ul>' + data.map(est => `<li>${est.name}</li>`).join('') + '</ul>';
                document.getElementById('exportStatusExcel').href = `/estadisticas/status/${status}/excel`;
            });
    } else {
        document.getElementById('estudiantesStatus').innerHTML = '';
        document.getElementById('exportStatusExcel').href = '#';
    }
});

document.getElementById('becaSelect').addEventListener('change', function() {
    let beca = this.value;
    if (beca) {
        fetch(`/estadisticas/beca/${beca}`)
            .then(response => response.json())
            .then(data => {
                let estudiantesBeca = document.getElementById('estudiantesBeca');
                estudiantesBeca.innerHTML = '<ul>' + data.map(est => `<li>${est.name}</li>`).join('') + '</ul>';
                document.getElementById('exportBecaExcel').href = `/estadisticas/beca/${beca}/excel`;
            });
    } else {
        document.getElementById('estudiantesBeca').innerHTML = '';
        document.getElementById('exportBecaExcel').href = '#';
    }
});

document.getElementById('mentorSelect').addEventListener('change', function() {
    let mentorId = this.value;
    if (mentorId) {
        fetch(`/estadisticas/mentor/${mentorId}`)
            .then(response => response.json())
            .then(data => {
                let estudiantesMentor = document.getElementById('estudiantesMentor');
                estudiantesMentor.innerHTML = '<ul>' + data.map(est => `<li>${est.name}</li>`).join('') + '</ul>';
                document.getElementById('exportMentorExcel').href = `/estadisticas/mentor/${mentorId}/excel`;
            });
    } else {
        document.getElementById('estudiantesMentor').innerHTML = '';
        document.getElementById('exportMentorExcel').href = '#';
    }
});

document.getElementById('empresaSelect').addEventListener('change', function() {
    let empresaId = this.value;
    if (empresaId) {
        fetch(`/estadisticas/empresa/${empresaId}`)
            .then(response => response.json())
            .then(data => {
                let estudiantesEmpresa = document.getElementById('estudiantesEmpresa');
                estudiantesEmpresa.innerHTML = '<ul>' + data.map(est => `<li>${est.name}</li>`).join('') + '</ul>';
                document.getElementById('exportEmpresaExcel').href = `/estadisticas/empresa/${empresaId}/excel`;
            });
    } else {
        document.getElementById('estudiantesEmpresa').innerHTML = '';
        document.getElementById('exportEmpresaExcel').href = '#';
    }
});

document.getElementById('carreraSelect').addEventListener('change', function() {
    let carreraId = this.value;
    if (carreraId) {
        fetch(`/estadisticas/carrera/${carreraId}`)
            .then(response => response.json())
            .then(data => {
                let estudiantesCarrera = document.getElementById('estudiantesCarrera');
                estudiantesCarrera.innerHTML = '<ul>' + data.map(est => `<li>${est.name}</li>`).join('') + '</ul>';
                document.getElementById('exportCarreraExcel').href = `/estadisticas/carrera/${carreraId}/excel`;
            });
    } else {
        document.getElementById('estudiantesCarrera').innerHTML = '';
        document.getElementById('exportCarreraExcel').href = '#';
    }
});
</script>
@endsection
