@extends('layouts.app')
@section('title', 'Direcciones de Carrera')

@section('content')
<link rel="stylesheet" href="{{ asset('css/listas.css') }}">
    <body class="body">
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
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        
                            <div class="card-header-adjusted">
                                <h6 class="card-title">Lista de Direcciones de Carrera</h6>
                                @if (Auth::user()->rol_id === 1 || Auth::user()->rol_id === 4)
                                    <div class="float-end">
                                        {{-- Button del modal --}}
                                        <a href="{{ route('direcciones.create') }}" class="btn btn-add"
                                            title="Agregar una nueva Direccion de Carrera">
                                            <i class="mdi mdi-plus-circle-outline"></i>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <input type="text" id="search" class="form-control"
                                        placeholder="Buscar dirección...">
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Direccion</th>
                                            <th>Correo Electronico</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="direccionTable">
                                        @foreach ($direcciones as $carrera)
                                            <tr class="animate__animated animate__fadeInDown animate__repeat-2 "
                                                id='aiuda'>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $carrera->name }}</td>
                                                <td>{{ $carrera->email }}</td>
                                                <td>
                                                    <a href="{{ route('direcciones.show', $carrera->id) }}"
                                                        class="btn btn-facebook">
                                                        <i class="mdi mdi-eye btn-icon-prepend"></i>
                                                    </a>
                                                    @if (Auth::user()->rol_id === 1 || Auth::user()->rol_id === 4)
                                                        <button class="btn btn-danger" data-bs-toggle="modal"
                                                            data-bs-target="#exampleModal1"
                                                            onclick="deleteDireccion({{ $carrera->id }})">
                                                            <i class="mdi mdi-delete btn-icon-prepend"></i>
                                                        </button>
                                                        <a href="{{ route('direcciones.edit', $carrera->id) }}"
                                                            class="btn btn-twitter">
                                                            <i class="mdi mdi-account-edit btn-icon-prepend"></i>
                                                        </a>
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
                                        direccion Temporalmente</h5>
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
                                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Direccion Temporalmente</h5>
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
    <script type="application/javascript">
        // hace una peticion ajax para obtener la informacion de la carrera
        function deleteDireccion(id) {

            let form = document.getElementById('deleteForm')
            form.action = '/direcciones/' + id + '/delete'
            $.ajax({
                url: '/direcciones/' + id + '/json',
                type: 'GET',
                success: function (response) {
                    $('#banner').html('¿Estas seguro de eliminar este registro? ' + response.nombre);
                }
            })
        }

        // Filtrar direcciones
        document.getElementById('search').addEventListener('keyup', function() {
            let value = this.value.toLowerCase();
            let rows = document.querySelectorAll('#direccionTable tr');
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
