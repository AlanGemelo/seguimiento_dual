@extends('layouts.app')
@section('title', 'Empresas')

@php
    $activeTab = request('tab', 'graficas');
@endphp

@section('styles')
    <style>
        .header-empresa {
            color: #0a3d62;
        }

        .header-carrera {
            color: #14532d;
        }

        .header-mentor {
            color: #0c4a6e;
        }

        .header-beca {
            color: #7c2d12;
        }

        .card-empresa {
            border-top: 4px solid #0a3d62;
        }

        .card-carrera {
            border-top: 4px solid #14532d;
        }

        .card-mentor {
            border-top: 4px solid #0c4a6e;
        }

        .card-beca {
            border-top: 4px solid #7c2d12;
        }

        .chart-container {
            position: relative;
            overflow: visible;
            /* 👈 clave */
        }

        .chart-wrapper {
            position: relative;
            overflow: visible;
            z-index: 10;
        }

        .chart-box {
            overflow: hidden;
            position: relative;
        }

        .chart-card {
            width: 420px;
            display: flex;
            flex-direction: column;
        }

        .chart-body {
            flex: 1;
            min-height: 0;
        }

        .apexcharts-tooltip {
            max-width: 200px !important;
            white-space: normal !important;
            word-break: break-word;
        }

        .card-body ul {
            max-height: 150px;
            overflow-y: auto;
            padding-left: 18px;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">

                {{-- Header --}}
                <div class="card-header-adjusted d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Estadísticas Generales de la Direccion</h5>
                </div>

                {{-- Tabs --}}
                <div class="card-body">

                    {{-- Alertas generales --}}
                    <x-alerts.flash-messages />

                    {{-- Pestanas para la seccion --}}
                    <ul class="nav nav-tabs" id="graficasTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $activeTab === 'graficas' ? 'active' : '' }}" data-bs-toggle="tab"
                                data-bs-target="#graficas" type="button" role="tab">
                                <i class="mdi mdi-chart-line me-1"></i>
                                Gráficas
                            </button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $activeTab === 'consultas_rapidas' ? 'active' : '' }}"
                                data-bs-toggle="tab" data-bs-target="#consultas_rapidas" type="button" role="tab">
                                <i class="mdi mdi-lightning-bolt-outline me-1"></i>
                                Consultas rápidas
                            </button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $activeTab === 'filtro_avanzado' ? 'active' : '' }}"
                                data-bs-toggle="tab" data-bs-target="#filtro_avanzado" type="button" role="tab">
                                <i class="mdi mdi-filter-variant me-1"></i>
                                Filtro avanzado
                            </button>
                        </li>
                    </ul>

                    {{-- Contenido --}}
                    <div class="tab-content mt-4">

                        <div class="tab-pane fade {{ $activeTab === 'graficas' ? 'show active' : '' }}" id="graficas"
                            role="tabpanel">
                            @include('estadisticas.tabs.graficas')
                        </div>

                        <div class="tab-pane fade {{ $activeTab === 'consultas_rapidas' ? 'show active' : '' }}"
                            id="consultas_rapidas" role="tabpanel">
                            @include('estadisticas.tabs.consultas_rapidas')
                        </div>

                        <div class="tab-pane fade {{ $activeTab === 'filtro_avanzado' ? 'show active' : '' }}"
                            id="filtro_avanzado" role="tabpanel">
                            @include('estadisticas.tabs.filtro_avanzado')
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>


@endsection

{{-- Section de modals --}}
@section('modals')

@endsection

{{-- Section de scripts JS --}}
@push('scripts')

    <script src="{{ LarapexChart::cdn() }}"></script>

    @foreach ([$chartEmpresa, $chartCarrera, $chartMentor, $chartBeca] as $chart)
        {!! $chart->script() !!}
    @endforeach

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => {
                new bootstrap.Tooltip(el);
            });


            function safeListener(id, event, callback) {
                const el = document.getElementById(id);
                if (el) el.addEventListener(event, callback);
            }

            //Exportacion por Status
            document.getElementById('exportStatusExcel').addEventListener('click', function(e) {
                e.preventDefault();

                let status = document.getElementById('statusSelect').value;
                if (!status) return;

                fetch(`${window.BASE_URL}/estadisticas/status/${status}/excel`)
                    .then(response => {
                        if (!response.ok) throw new Error('Error al descargar el archivo');

                        const disposition = response.headers.get('Content-Disposition');
                        let fileName = 'archivo.xlsx';

                        if (disposition && disposition.includes('filename=')) {
                            fileName = disposition.split('filename=')[1].replace(/"/g, '');
                        }

                        return response.blob().then(blob => ({
                            blob,
                            fileName
                        }));
                    })
                    .then(({
                        blob,
                        fileName
                    }) => {
                        const url = window.URL.createObjectURL(blob);
                        const a = document.createElement('a');
                        a.href = url;
                        a.download = fileName;
                        document.body.appendChild(a);
                        a.click();
                        a.remove();
                        window.URL.revokeObjectURL(url);
                    })
                    .catch(console.error);
            });

            //Exportacion por Beca
            document.getElementById('exportBecaExcel').addEventListener('click', function(e) {
                e.preventDefault();

                let beca = document.getElementById('becaSelect').value;
                if (!beca) return;

                fetch(`${window.BASE_URL}/estadisticas/beca/${beca}/excel`)
                    .then(response => {
                        if (!response.ok) throw new Error('Error al descargar el archivo');

                        const disposition = response.headers.get('Content-Disposition');
                        let fileName = 'archivo.xlsx';

                        if (disposition && disposition.includes('filename=')) {
                            fileName = disposition.split('filename=')[1].replace(/"/g, '');
                        }

                        return response.blob().then(blob => ({
                            blob,
                            fileName
                        }));
                    })
                    .then(({
                        blob,
                        fileName
                    }) => {
                        const url = window.URL.createObjectURL(blob);
                        const a = document.createElement('a');
                        a.href = url;
                        a.download = fileName;
                        document.body.appendChild(a);
                        a.click();
                        a.remove();
                        window.URL.revokeObjectURL(url);
                    })
                    .catch(console.error);
            });

            //Exportacion de mentores
            document.getElementById('exportMentorExcel').addEventListener('click', function(e) {
                e.preventDefault();

                let id = document.getElementById('mentorSelect').value;
                if (!id) return;

                fetch(`${window.BASE_URL}/estadisticas/mentor/${id}/excel`)
                    .then(response => {
                        if (!response.ok) throw new Error('Error al descargar el archivo');

                        const disposition = response.headers.get('Content-Disposition');
                        let fileName = 'archivo.xlsx';

                        if (disposition && disposition.includes('filename=')) {
                            fileName = disposition.split('filename=')[1].replace(/"/g, '');
                        }

                        return response.blob().then(blob => ({
                            blob,
                            fileName
                        }));
                    })
                    .then(({
                        blob,
                        fileName
                    }) => {
                        const url = window.URL.createObjectURL(blob);
                        const a = document.createElement('a');
                        a.href = url;
                        a.download = fileName;
                        document.body.appendChild(a);
                        a.click();
                        a.remove();
                        window.URL.revokeObjectURL(url);
                    })
                    .catch(console.error);
            });

            //Exportacion por Empresas
            document.getElementById('exportEmpresaExcel').addEventListener('click', function(e) {
                e.preventDefault();

                let id = document.getElementById('empresaSelect').value;
                if (!id) return;

                fetch(`${window.BASE_URL}/estadisticas/empresa/${id}/excel`)
                    .then(response => {
                        if (!response.ok) throw new Error('Error al descargar el archivo');

                        const disposition = response.headers.get('Content-Disposition');
                        let fileName = 'archivo.xlsx';

                        if (disposition && disposition.includes('filename=')) {
                            fileName = disposition.split('filename=')[1].replace(/"/g, '');
                        }

                        return response.blob().then(blob => ({
                            blob,
                            fileName
                        }));
                    })
                    .then(({
                        blob,
                        fileName
                    }) => {
                        const url = window.URL.createObjectURL(blob);
                        const a = document.createElement('a');
                        a.href = url;
                        a.download = fileName;
                        document.body.appendChild(a);
                        a.click();
                        a.remove();
                        window.URL.revokeObjectURL(url);
                    })
                    .catch(console.error);
            });

            //Exportacion por Carrera
            document.getElementById('exportCarreraExcel').addEventListener('click', function(e) {
                e.preventDefault();

                let id = document.getElementById('carreraSelect').value;
                if (!id) return;

                fetch(`${window.BASE_URL}/estadisticas/carrera/${id}/excel`)
                    .then(response => {
                        if (!response.ok) throw new Error('Error al descargar el archivo');

                        const disposition = response.headers.get('Content-Disposition');
                        let fileName = 'archivo.xlsx';

                        if (disposition && disposition.includes('filename=')) {
                            fileName = disposition.split('filename=')[1].replace(/"/g, '');
                        }

                        return response.blob().then(blob => ({
                            blob,
                            fileName
                        }));
                    })
                    .then(({
                        blob,
                        fileName
                    }) => {
                        const url = window.URL.createObjectURL(blob);
                        const a = document.createElement('a');
                        a.href = url;
                        a.download = fileName;
                        document.body.appendChild(a);
                        a.click();
                        a.remove();
                        window.URL.revokeObjectURL(url);
                    })
                    .catch(console.error);
            });


            safeListener('exportFiltroExcel', 'click', function() {
                let form = document.getElementById('filtroEstudiantesForm');
                if (!form) return;

                let data = new FormData(form);
                let query = new URLSearchParams(data).toString();
                window.location.href = `${window.BASE_URL}/estadisticas/filtro/excel?${query}`;
            });

        });

        document.addEventListener("DOMContentLoaded", function() {

            const tipoAlumno = document.getElementById('tipoAlumnoSelect');
            const estatus = document.getElementById('estatusAcademicoSelect');

            if (!tipoAlumno || !estatus) return;
            console.log(tipoAlumno);
            console.log("Hola");

            tipoAlumno.addEventListener('change', function() {

                let enabled = this.value !== '';

                const dependientes = [
                    'empresaSelectFiltro',
                    'mentorSelectFiltro',
                    'carreraSelectFiltro',
                    'tipoBecaSelect',
                    'fechaFiltro',
                    'fechaInicio',
                    'fechaFin',
                    'exportFiltroExcel'
                ];

                dependientes.forEach(id => {
                    const el = document.getElementById(id);
                    if (el) el.disabled = !enabled;
                });

                // 🔥 IMPORTANTE: reset primero
                estatus.value = '';

                // filtrar opciones
                Array.from(estatus.options).forEach(opt => {

                    if (!opt.value) return;

                    const grupo = opt.dataset.group;

                    const permitido = !this.value || grupo === this.value;

                    opt.disabled = !permitido;
                    opt.hidden = !permitido;
                });

            });

        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const tipoAlumno = document.getElementById('tipoAlumnoSelect');
            const estatus = document.getElementById('estatusAcademicoSelect');

            const dependientes = [
                'empresaSelectFiltro',
                'mentorSelectFiltro',
                'carreraSelectFiltro',
                'tipoBecaSelect',
                'fechaFiltro',
                'fechaInicio',
                'fechaFin',
                'exportFiltroExcel'
            ];

            function toggleDependientes(enable) {
                dependientes.forEach(id => {
                    const el = document.getElementById(id);
                    if (el) el.disabled = !enable;
                });
            }

            //  Tipo alumno
            tipoAlumno.addEventListener('change', function() {

                estatus.disabled = !this.value;
                estatus.value = '';

                toggleDependientes(false);

                Array.from(estatus.options).forEach(opt => {

                    if (!opt.value) return;

                    const permitido = opt.dataset.group === this.value;

                    opt.hidden = !permitido;
                });
            });

            //  Estatus seleccionado
            estatus.addEventListener('change', function() {

                if (!this.value) {
                    toggleDependientes(false);
                    return;
                }

                toggleDependientes(true);
                ejecutarFiltro();
            });

            // 3. Detectar cambios en filtros secundarios
            document.querySelectorAll('#filtroEstudiantesForm select, #filtroEstudiantesForm input')
                .forEach(el => {
                    el.addEventListener('change', ejecutarFiltro);
                });

            //  AJAX filtro
            function ejecutarFiltro() {

                let form = document.getElementById('filtroEstudiantesForm');
                let data = new FormData(form);

                // Validación mínima
                if (!data.get('tipoAlumno') || data.get('estatus_academico') === '') return;

                fetch(`${window.BASE_URL}/estadisticas/getfiltroEstudiantes?` + new URLSearchParams(data))
                    .then(res => res.json())
                    .then(data => renderResultados(data))
                    .catch(console.error);
            }

            // Render resultados
            function renderResultados(data) {

                let cont = document.getElementById('estudiantesFiltro');

                if (!data.length) {
                    cont.innerHTML = `<div class="text-muted">Sin resultados</div>`;
                    return;
                }

                let html = `
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th>Matrícula</th>
                        <th>Nombre</th>
                        <th>Empresa</th>
                        <th>Carrera</th>
                    </tr>
                </thead>
                <tbody>
        `;

                data.forEach(e => {
                    html += `
                <tr>
                    <td>${e["Matrícula"]}</td>
                    <td>${e["Nombre"]}</td>
                    <td>${e["Empresa"] ?? ''}</td>
                    <td>${e["Programa Educativo"] ?? ''}</td>
    
                </tr>
            `;
                });

                html += `</tbody></table>`;
                cont.innerHTML = html;
            }

        });

        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById('filtroEstudiantesForm');
            const tipoAlumno = document.getElementById('tipoAlumnoSelect');
            const estatus = document.getElementById('estatusAcademicoSelect');
            const loader = document.getElementById('filtroLoader');
            const btnExport = document.getElementById('exportFiltroExcel');

            const selectsSecundarios = {
                'empresaSelectFiltro': 'empresas',
                'mentorSelectFiltro': 'mentores',
                'carreraSelectFiltro': 'carreras',
                'tipoBecaSelect': 'becas'
            };

            let fetchController = new AbortController(); // Para cancelar peticiones previas

            function toggleSecundarios(enabled) {
                Object.keys(selectsSecundarios).forEach(id => document.getElementById(id).disabled = !enabled);
                document.getElementById('fechaFiltro').disabled = !enabled;
                document.getElementById('fechaInicio').disabled = !enabled;
                document.getElementById('fechaFin').disabled = !enabled;
                btnExport.disabled = !enabled;
            }

            function lockUI(locked) {
                // Bloquea/Desbloquea todo durante la carga AJAX
                Array.from(form.elements).forEach(el => el.disabled = locked);
                loader.style.display = locked ? 'block' : 'none';
                if (!locked && estatus.value) toggleSecundarios(true);
            }

            //Manejo de Filtros Primarios
            tipoAlumno.addEventListener('change', function() {
                estatus.disabled = !this.value;
                estatus.value = '';
                toggleSecundarios(false);
                document.getElementById('estudiantesFiltro').innerHTML = '';

                Array.from(estatus.options).forEach(opt => {
                    if (!opt.value) return;
                    opt.hidden = opt.dataset.group !== this.value;
                });
            });

            estatus.addEventListener('change', function() {
                if (!this.value) {
                    toggleSecundarios(false);
                    return;
                }
                ejecutarFiltro();
            });

            // Ejecutar al cambiar cualquier filtro
            form.addEventListener('change', function(e) {
                if (e.target.id === 'tipoAlumnoSelect' || !estatus.value) return;
                ejecutarFiltro();
            });

            //  Petición AJAX Principal
            async function ejecutarFiltro() {
                fetchController.abort(); // Cancela la petición anterior si hay race condition
                fetchController = new AbortController();

                let data = new FormData(form);
                if (!data.get('tipoAlumno') || data.get('estatus_academico') === '') return;

                lockUI(true);

                try {
                    const response = await fetch(`/estadisticas/filtros-avanzados?` +
                        new URLSearchParams(data), {
                            signal: fetchController.signal,
                            headers: {
                                'Accept': 'application/json'
                            }
                        });

                    const result = await response.json();

                    renderResultados(result.resultados);
                    actualizarSelects(result.opciones);

                } catch (error) {
                    if (error.name !== 'AbortError') console.error('Error AJAX:', error);
                } finally {
                    lockUI(false);
                }
            }

            //  Actualizar opciones de los Dropdowns
            function actualizarSelects(opciones) {
                // Empresas
                reconstruirSelect('empresaSelectFiltro', opciones.empresas, 'Seleccione una unidad economica',
                    opt => `<option value="${opt.id}">${opt.nombre}</option>`);

                // Mentores
                reconstruirSelect('mentorSelectFiltro', opciones.mentores, 'Seleccione un mentor academico', opt =>
                    `<option value="${opt.id}">${opt.titulo}. ${opt.name} ${opt.apellidoP} ${opt.apellidoM}</option>`
                );

                // Carreras
                reconstruirSelect('carreraSelectFiltro', opciones.carreras, 'Seleccione un programa educativo',
                    opt => `<option value="${opt.id}">${opt.nombre}</option>`);

                // Becas (Manejo especial por valores numéricos/nulos)
                const becaSelect = document.getElementById('tipoBecaSelect');
                const becaVal = becaSelect.value;
                let becaHtml = '<option value="">Seleccione un tipo de beca</option>';
                if (opciones.becas.includes(null)) becaHtml += '<option value="sin">Sin beca</option>';
                if (opciones.becas.includes(0)) becaHtml += '<option value="0">Apoyo Empresa</option>';
                if (opciones.becas.includes(1)) becaHtml += '<option value="1">Comecyt</option>';
                becaSelect.innerHTML = becaHtml;
                if (Array.from(becaSelect.options).some(o => o.value === becaVal)) becaSelect.value = becaVal;
            }

            function reconstruirSelect(elementId, datos, placeholder, templateFn) {
                const select = document.getElementById(elementId);
                const valorActual = select.value;

                let html = `<option value="">${placeholder}</option>`;
                datos.forEach(item => html += templateFn(item));

                select.innerHTML = html;

                // Restaurar valor si sigue estando disponible
                if (valorActual && Array.from(select.options).some(o => o.value === valorActual)) {
                    select.value = valorActual;
                }
            }

            // Render de Tabla (Optimizado de tu código original)
            function renderResultados(data) {
                let cont = document.getElementById('estudiantesFiltro');
                if (!data.length) {
                    cont.innerHTML =
                        `<div class="alert alert-warning py-2 text-center">Sin resultados para esta combinación</div>`;
                    return;
                }

                let html =
                    `<table class="table table-sm table-bordered">
            <thead class="table-light"><tr><th>Matrícula</th><th>Nombre</th><th>Empresa</th><th>Carrera</th></tr></thead><tbody>`;

                data.forEach(e => {
                    html +=
                        `<tr><td>${e["Matrícula"]}</td><td>${e["Nombre"]}</td><td>${e["Empresa"]}</td><td>${e["Programa Educativo"]}</td></tr>`;
                });
                cont.innerHTML = html + `</tbody></table>`;
            }
        });
    </script>


@endpush
