@extends('layouts.app')

@section('title', 'Empresas')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/listas.css') }}">

    <body class="body">
        <div class="container">
            <div class="card">

                <div class="card-header-adjusted">
                    <h6 class="card-title">Empresas Registradas</h6>
                    <div class="float-end">
                        <a href="{{ route('empresas.create') }}" class="btn btn-add" title="Crear Nueva Empresa">
                            <i class="mdi mdi-plus-circle-outline"></i>
                        </a>
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

                                            <x-buttons.show-button
                                                url="{{ route('empresas.show_establecidas', Vinkla\Hashids\Facades\Hashids::encode($empresa->id)) }}" />

                                            <a href="{{ route('empresas.edit', $empresa->id) }}"
                                                class="btn btn-warning">Editar</a>
                                            <a href="{{ route('empresas.downloadPDF', $empresa->id) }}"
                                                class="btn btn-info">PDF</a>
                                            <a href="{{ route('empresas.suspendForm', Vinkla\Hashids\Facades\Hashids::encode($empresa->id)) }}"
                                                class="btn btn-danger">Baja</a>

                                            {{-- <button type="button" class="btn btn-danger"
                                                onclick="openSuspendModal('{{ Vinkla\Hashids\Facades\Hashids::encode($empresa->id) }}')">
                                                Baja
                                            </button> --}}

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

                <div class="card-header-adjusted">
                    <h6 class="card-title">Unidades Económicas Interesadas (UEI)</h6>
                    <div class="float-end">
                        <a href="{{ route('empresas.exportUeiPdf') }}" class="btn btn-danger" title="Descargar PDF">
                            <i class="mdi mdi-file-pdf"></i>
                        </a>
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
                                            <a href="{{ route('empresas.darAlta', $empresa->id) }}"
                                                class="btn btn-success">Dar
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

            {{-- Seccion de Bajas Temporales --}}

            <div class="card mt-4">
                <div class="card-header-adjusted">
                    
                        <h6 class="card-title">Historial de UEI - Bajas Temporales</h6>
                    
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
                                            <div class="d-flex gap-2">
                                                <button class="btn btn-success btn-sm rounded-pill" title="Restaurar"
                                                    data-bs-toggle="modal" data-bs-target="#exampleModal3"
                                                    onclick="openReactivateModal('{{ Hashids::encode($empresa->id) }}')">
                                                    <i class="mdi mdi-backup-restore me-1"></i> Reactivar
                                                </button>

                                                <x-buttons.show-button
                                                    url="{{ route('empresas.show_establecidas', Vinkla\Hashids\Facades\Hashids::encode($empresa->id)) }}" />

                                                <button class="btn btn-danger btn-sm rounded-pill"
                                                    title="Eliminar Permanentemente" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal2"
                                                    onclick="openPermanentDeleteModal({{ $empresa->id }})">
                                                    <i class="mdi mdi-delete me-1"></i> Eliminar
                                                </button>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

        {{-- Seccion de el Modal de proceso de baja --}}
        <div class="modal fade" id="suspendModal" tabindex="-1" aria-labelledby="suspendModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="suspendModalLabel">Proceso de baja de la Unidad Económica</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <form id="suspendForm" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <p id="bannerSuspend">¿Estás seguro de que deseas dar de baja esta Unidad
                                            Económica?</p>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button"
                                                data-bs-dismiss="modal">Cancelar</button>
                                            <button class="btn btn-primary" type="submit">Confirmar baja</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Seccion de el Modal de restauracion --}}
        <div class="modal fade" id="reactivarModal" tabindex="-1" aria-labelledby="reactivarModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="reactivarModalLabel">Restaurar Unidad Económica</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <form id="reactivarForm" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <p id="bannerRestore">¿Estás seguro de restaurar esta UE?</p>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button"
                                                data-bs-dismiss="modal">Cancelar</button>
                                            <button class="btn btn-primary" type="submit">Confirmar Reactivación</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Seccion del Model de eliminacion permanente --}}

        <div class="modal fade" id="permanentDeleteModal" tabindex="-1" aria-labelledby="permanentDeleteModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="permanentDeleteModalLabel">Eliminar Permanentemente esta Unidad
                            Económica</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <form id="permanentDeleteForm" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <p id="bannerpermanentDelete">¿Estás seguro de eliminar permanentemente esta UE?
                                        </p>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button"
                                                data-bs-dismiss="modal">Cancelar</button>
                                            <button class="btn btn-primary" type="submit">Confirmar Eliminación</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
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

            // Función para abrir el modal de la suspencion
            function openSuspendModal(id) {
                console.log("ID recibido:", id);
                let form = document.getElementById('suspendForm');
                form.action = `/empresas/${id}/suspend`;

                $.ajax({
                    url: `/empresas/${id}/json`,
                    type: 'GET',
                    success: function(response) {
                        $('#bannerSuspend').html(
                            `¿Estás seguro de que deseas dar de baja esta Unidad Económica 
                <strong>${response.nombre}</strong>?`);
                        $('#suspendModal').modal('show');
                    },
                    error: function() {
                        alert('Error al cargar datos de la empresa');
                    }
                });
            }


            // Función para abrir el modal de reactivación
            function openReactivateModal(id) {
                let form = document.getElementById('reactivarForm');
                form.action = `/empresas/${id}/reactivate`;

                // Obtener datos de la empresa vía AJAX
                $.ajax({
                    url: `/empresas/${id}/json`,
                    type: 'GET',
                    success: function(response) {
                        $('#bannerRestore').html(
                            `¿Estás seguro de reactivar la empresa <strong>${response.nombre}</strong>?`);
                        $('#reactivarModal').modal('show');
                    },
                    error: function() {
                        alert('Error al cargar datos de la empresa');
                    }
                });
            }

            //Manejo del formulario con  AJAX para eliminacion permanentemente
            function openPermanentDeleteModal(id) {
                let form = document.getElementById('permanentDeleteForm');
                form.action = `/empresas/${id}/delete`;

                // Obtener datos de la empresa vía AJAX
                $.ajax({
                    url: `/empresas/${id}/json`,
                    type: 'GET',
                    success: function(response) {
                        $('#bannerpermanentDelete').html(
                            `¿Estás seguro de eliminar permantemente la UI <strong>${response.nombre}</strong>?`
                        );
                        $('#permanentDeleteModal').modal('show');
                    },
                    error: function() {
                        alert('Error al cargar datos de la UE');
                    }
                });
            }

            $('#permanentDeleteForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#permanentDeleteModal').modal('hide');
                        alert('Empresa eliminada con éxito');
                        location.reload(); // Recargar la página para ver cambios
                    },
                    error: function(xhr) {
                        alert('Error: ' + xhr.responseJSON.message);
                    }
                });
            });
        </script>
    @endsection
</body>
