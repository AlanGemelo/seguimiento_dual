@extends('layouts.app')
@section('title', 'Directores de Carrera')

@section('content')
    <div class="row">
        <div class="col-12 grid-margin">
            @if (session('status'))
                <div class="alert alert-success alert-dismissible text-dark" role="alert">
                    <span class="text-sm"> <a href="javascript:" class="alert-link text-dark">Excelente</a>.
                        {{ session('status') }}.</span>
                    <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if (session('statusError'))
                <div class="alert alert-danger alert-dismissible text-dark" role="alert">
                    <span class="text-sm"> <a href="javascript:" class="alert-link text-dark">Error</a>.
                        {{ session('statusError') }}.</span>
                    <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
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
                                                    <a href="{{ route('directores.show', Vinkla\Hashids\Facades\Hashids::encode($carrera->id)) }}"
                                                        class="btn btn-facebook" style=" background-color: #00798c">
                                                        <i class="mdi mdi-eye btn-icon-prepend" style="font-size: 1.5em;"></i>
                                                    </a>
                                                    @if (Auth::user()->rol_id === 1 || Auth::user()->rol_id === 4)
                                                        <a href="{{ route('directores.edit', Vinkla\Hashids\Facades\Hashids::encode($carrera->id)) }}"
                                                            class="btn btn-twitter" style=" background-color: #ffa719">
                                                            <i class="mdi mdi-account-edit btn-icon-prepend" style="font-size: 1.5em;"></i>
                                                        </a>
                                                        <button class="btn btn-danger" data-bs-toggle="modal"
                                                            data-bs-target="#exampleModal1" style=" background-color: #e63946"
                                                            onclick="deleteDireccion('{{ Vinkla\Hashids\Facades\Hashids::encode($carrera->id) }}')">
                                                            <i class="mdi mdi-delete btn-icon-prepend" style="font-size: 1.5em;"></i>
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Eliminar
                                        director Temporalmente</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container">
                                        <div class="row justify-content-center">
                                            <div class="col-md-12">
                                                <form action="" id="deleteForm" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <p id="banner">¿Estas seguro de eliminar
                                                        este registro?</p>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button"
                                                            data-bs-dismiss="modal">Cancelar
                                                        </button>
                                                        <button class="btn btn-danger" type="submit">Eliminar
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Director</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
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
                                                        <button class="btn btn-secondary" type="button"
                                                            data-bs-dismiss="modal">Cancelar
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
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        // hace una peticion ajax para obtener la informacion de la carrera
        function deleteDireccion(id) {
            let form = document.getElementById('deleteForm')
            form.action = `${window.BASE_URL}/directores/${id}/delete`
            $.ajax({
                url: `${window.BASE_URL}/directores/${id}/json`,
                type: 'GET',
                success: function(response) {
                    $('#banner').text('¿Estas seguro de eliminar este registro? ' + response.nombre);
                }
            })
        }

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
    </script>
@endsection
</body>