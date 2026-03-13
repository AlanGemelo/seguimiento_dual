@extends('layouts.app')
@section('title', 'Directores de Carrera')

@section('content')
    <div class="row">
        <div class="col-12 grid-margin">

            <body class="body">
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">

                            <div class="card-header-adjusted">
                                <h6 class="card-title">Lista de Directores de Carrera</h6>
                                <div class="float-end">
                                    {{-- Button del modal --}}
                                    <a href="{{ route('directores.create') }}" class="btn btn-add"
                                        title="Agregar una nueva Direccion de Carrera">
                                        <i class="mdi mdi-account-edit btn-icon-prepend"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row mb-3">

                                    {{-- Alertas generales --}}
                                    <x-alerts.flash-messages />

                                    <div class="col-md-6">
                                        <input type="text" id="search" class="form-control"
                                            placeholder="Buscar director...">
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nombre</th>
                                                <th>Correo Electronico</th>
                                                <th>Direccion</th>

                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody id="directorTable">
                                            @foreach ($directores as $carrera)
                                                <tr class="animate__animated animate__fadeInDown animate__repeat-2 "
                                                    id='aiuda'>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $carrera->nombre . ' ' . $carrera->apellidoP . ' ' . $carrera->apellidoM }}
                                                    </td>
                                                    <td>{{ $carrera->email }}</td>
                                                    <td>{{ $carrera->direccion->name }}</td>
                                                    <td>

                                                        {{-- Ver --}}
                                                        <x-buttons.show-button
                                                            url="{{ route('directores.show', Vinkla\Hashids\Facades\Hashids::encode($carrera->id)) }}" />
                                                        @if (Auth::user()->rol_id === 1 || Auth::user()->rol_id === 4)
                                                            {{-- Editar --}}
                                                            <x-buttons.edit-button
                                                                url="{{ route('directores.edit', Vinkla\Hashids\Facades\Hashids::encode($carrera->id)) }}"
                                                                title="Editar director" />
                                                        @endif
                                                        @if (Auth::user()->rol_id === 1 || Auth::user()->rol_id === 4)
                                                            {{-- Eliminar --}}
                                                            <x-buttons.delete-button funcion="deleteDirectores"
                                                                parametro="{{ Hashids::encode($carrera->id) }}" />
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
        </div>
    </div>
@endsection

@section('modals')
    <!-- Modal de confirmación para eliminar Direcciones de Carrera -->
    <div class="modal fade" id="deleteModalDirectores" tabindex="-1" aria-labelledby="deleteModalDirectoresLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalDirectoresLabel">Eliminar Dirección de Carrera</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar">
                    </button>
                </div>
                <div class="modal-body">
                    <p id="bannerDirectores">¿Estás seguro de eliminar este registro?</p>
                    <div class="mb-3">

                    </div>
                </div>
                <div class="modal-footer">
                    <form action="" id="deleteFormDirectores" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Director</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <form action="" id="deleteForm" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <p id="banner">¿Estas seguro de eliminar este registro?</p>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancelar
                                        </button>
                                        <button class="btn btn-danger" type="submit">Eliminar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        // Filtrar directores
        document.getElementById('search').addEventListener('keyup', function() {
            let value = this.value.toLowerCase();
            let rows = document.querySelectorAll('#directorTable tr');
            rows.forEach(row => {
                let name = row.cells[1].textContent.toLowerCase();
                let email = row.cells[2].textContent.toLowerCase();
                if (name.includes(value) || email.includes(value)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });


        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => {
                new bootstrap.Tooltip(el)
            });
        });

        // Obtener info del Director
        function getDirectoresInfo(hashId, callback) {
            if (!hashId) {
                console.error('HashId no proporcionado');
                return;
            }

            const url = `${BASE_URL}/directores/${hashId}/json`;

            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    if (Array.isArray(response) && response.length > 0) {
                        callback(response[0]);
                    } else if (response) {
                        callback(response);
                    } else {
                        console.error('Director no encontrado');
                    }
                },
                error: function(err) {
                    console.error('Error al obtener Director:', err);
                }
            });
        }
        // Mostrar modal de eliminación temporal
        function deleteDirectores(hashId) {
            getDirectoresInfo(hashId, function(mentorAcademico) {
                document.getElementById('bannerDirectores').innerHTML =
                    `¿Estás seguro de eliminar temporalmente a <strong>${mentorAcademico.nombre} ${mentorAcademico.apellidoP} ${mentorAcademico.apellidoM}</strong>?`;
                document.getElementById('deleteFormDirectores').action =
                    `/directores/${hashId}`;
                new bootstrap.Modal(document.getElementById('deleteModalDirectores')).show();
            });
        }
    </script>
@endsection
</body>
