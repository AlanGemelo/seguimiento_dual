@extends('layouts.app')

@section('title', 'Empresas')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary rounded pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Empresas Registradas</h6>
                    <div class="float-end">
                        <a href="{{ route('empresas.create') }}" class="btn btn-primary" title="Crear Nueva Empresa">
                            <i class="mdi mdi-plus-circle-outline"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <input type="text" id="search" class="form-control" placeholder="Buscar...">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nombre de la UE</th>
                                <th>Email</th>
                                <th>Teléfono</th>
                                <th>Fecha de Registro</th>
                                <th>Inicio - Termino del convenio </th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="empresaTable">
                            @foreach ($empresas as $empresa)
                                <tr>
                                    <td>{{ $empresa->nombre }}</td>
                                    <td>{{ $empresa->email }}</td>
                                    <td>{{ $empresa->telefono }}</td>
                                    <td>{{ $empresa->created_at->format('d \d\e F \d\e Y') }}</td>
                                    <td>{{ $empresa->inicio_conv }} - {{ $empresa->fin_conv }}</td>
                                    <td>
                                        <a href="{{ route('empresas.edit', $empresa->id) }}"
                                            class="btn btn-warning">Editar</a>

                                        <a href="{{ route('empresas.downloadPDF', $empresa->id) }}"
                                            class="btn btn-info">PDF</a>
                                        <a href="{{ route('empresas.suspendForm', Hashids::encode($empresa->id)) }}"
                                            class="btn btn-danger"
                                            onclick="return confirm('¿Está seguro de iniciar el proceso de baja temporal de esta empresa?')">
                                            Baja
                                        </a>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Componente de Empresas Interesadas -->
        <div class="card mt-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary rounded pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Unidades Económicas Interesadas (UEI)</h6>
                    <div class="float-end">
                        <a href="{{ route('empresas.exportUeiPdf') }}" class="btn btn-danger" title="Descargar PDF">
                            <i class="mdi mdi-file-pdf"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <input type="text" id="searchInteresadas" class="form-control" placeholder="Buscar...">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nombre de la UE</th>
                                <th>Email</th>
                                <th>Teléfono</th>
                                <th>Fecha de Registro</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="empresaInteresadasTable">
                            @foreach ($empresasInteresadas as $empresa)
                                <tr>
                                    <td>{{ $empresa->nombre }}</td>
                                    <td>{{ $empresa->email }}</td>
                                    <td>{{ $empresa->telefono }}</td>
                                    <td>{{ $empresa->created_at->translatedFormat('d \d\e F \d\e Y') }}</td>
                                    <td>
                                        <a href="{{ route('empresas.darAlta', $empresa->id) }}" class="btn btn-success">Dar
                                            de Alta</a>
                                        <a href="{{ route('empresas.show', Vinkla\Hashids\Facades\Hashids::encode($empresa->id)) }}"
                                            class="btn btn-facebook">
                                            <i class="mdi mdi-eye btn-icon-prepend"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary rounded pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Historial de UEI - Bajas Temporales</h6>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <input type="text" id="searchInteresadas" class="form-control" placeholder="Buscar...">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nombre Empresa</th>
                                <th>Teléfono</th>
                                <th>Email</th>
                                <th>Motivo Baja</th>
                                <th>Fecha Baja</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($empresasSuspendidas as $empresa)
                                <tr>
                                    <td>{{ $empresa->nombre }}</td>
                                    <td>{{ $empresa->telefono }}</td>
                                    <td>{{ $empresa->email }}</td>
                                    <td>{{ $empresa->motivo_baja }}</td>
                                    <td>{{ $empresa->fecha_baja }}</td>
                                    <td>
                                        <a href="{{ route('empresas.darAlta', $empresa->id) }}" class="btn btn-success">Dar
                                            de Alta</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('search').addEventListener('keyup', function() {
            let value = this.value.toLowerCase();
            let rows = document.querySelectorAll('#empresaTable tr');
            rows.forEach(row => {
                let showRow = false;
                row.querySelectorAll('td').forEach(cell => {
                    if (cell.textContent.toLowerCase().includes(value)) {
                        showRow = true;
                    }
                });
                row.style.display = showRow ? '' : 'none';
            });
        });

        document.getElementById('searchInteresadas').addEventListener('keyup', function() {
            let value = this.value.toLowerCase();
            let rows = document.querySelectorAll('#empresaInteresadasTable tr');
            rows.forEach(row => {
                let showRow = false;
                row.querySelectorAll('td').forEach(cell => {
                    if (cell.textContent.toLowerCase().includes(value)) {
                        showRow = true;
                    }
                });
                row.style.display = showRow ? '' : 'none';
            });
        });
    </script>
@endsection
