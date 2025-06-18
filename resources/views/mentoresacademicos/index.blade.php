@extends('layouts.app')
@section('title', 'Mentores')

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

            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary rounded pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Lista De Mentores Academicos</h6>
                                @if (Auth::user()->rol_id === 1 || Auth::user()->rol_id === 4)
                                    <div class="float-end">
                                        {{-- Button del modal --}}
                                        <a href="{{ route('academicos.create') }}" class="btn btn-primary"
                                            title="Agregar una nuevo Mentor Academico">
                                            <i class="mdi mdi-plus-circle-outline"></i>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <input type="text" id="search" class="form-control"
                                        placeholder="Buscar mentor...">
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nombre</th>
                                            <th>Correo Electronico</th>
                                            <th>Direccion de Carrera</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="mentorTable">
                                        @foreach ($mentores as $mentor)
                                            <tr class="animate__animated animate__fadeInDown animate__repeat-2 "
                                                id='aiuda'>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $mentor->name . ' ' . $mentor->apellidoP . ' ' . $mentor->apellidoM }}
                                                </td>
                                                <td>{{ $mentor->email }}</td>
                                                <td>{{ $mentor->direccion->name }}</td>
                                                <td>
                                                    <a href="{{ route('academicos.show', Vinkla\Hashids\Facades\Hashids::encode($mentor->id)) }}"
                                                        class="btn btn-facebook">
                                                       <i class="mdi mdi-eye btn-icon-prepend"></i>
                                                    </a>
                                                    {{-- <a href="{{ route('academicos.showE', Vinkla\Hashids\Facades\Hashids::encode($mentor->id)) }}"
                                                   class="btn btn-facebook">
                                                    <i class="mdi mdi-account-details btn-icon-prepend"></i>
                                                </a> --}}
                                                    @if (Auth::user()->rol_id === 1 || Auth::user()->rol_id === 4)
                                                        <a href="{{ route('academicos.edit', Vinkla\Hashids\Facades\Hashids::encode($mentor->id)) }}"
                                                            class="btn btn-twitter">
                                                            <i class="mdi mdi-account-edit btn-icon-prepend"></i>
                                                        </a>
                                                        <button class="btn btn-danger" data-bs-toggle="modal"
                                                            data-bs-target="#exampleModal1"
                                                            onclick="deleteMentor({{ $mentor->id }})">
                                                            <i class="mdi mdi-delete btn-icon-prepend"></i>
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
                                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Mentor Academico
                                        Temporalmente</h5>
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
        @if ($mentoresDeleted->count() !== 0)
            @if (Auth::user()->rol_id === 1 || Auth::user()->rol_id === 4)
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary rounded pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Lista De Mentores Academicos Eliminados</h6>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Titulo</th>
                                            <th>Nombre</th>
                                            <th>Correo Electronico</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($mentoresDeleted as $mentorDeletd)
                                            <tr class="animate__animated animate__fadeInDown animate__repeat-2 "
                                                id='aiuda'>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $mentorDeletd->titulo }}</td>
                                                <td>{{ $mentorDeletd->name }}</td>
                                                <td>{{ $mentorDeletd->email }}</td>
                                                <td>
                                                    <button
                                                        class="btn btn-rounded-success btn-sm align-content-md-center align-items-center align-self-center"
                                                        title="Restore" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal3" data-bs-placement="top"
                                                        onclick="restoreRegistro({{ $mentorDeletd->id }})">
                                                        Reactivar
                                                        &nbsp;&nbsp;
                                                        <i class="mdi mdi-backup-restore"></i>
                                                    </button>

                                                    <button
                                                        class="btn btn-danger btn-sm align-content-md-center align-items-center align-self-center"
                                                        data-bs-toggle="modal" data-bs-target="#exampleModal2"
                                                        data-bs-placement="top" title="Eliminar Permanentemente"
                                                        type="button" onclick="destroyMentor({{ $mentorDeletd->id }})">
                                                        Eliminar
                                                        &nbsp;&nbsp;
                                                        <i class="mdi mdi-delete"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endif

        <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Eliminar Mentor Academico Permanentemente</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <form action="" id="permanentDelete" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <p id="bannerDelete">¿Estas seguro de eliminar este registro?</p>
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
        <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Restaurar Mentor Academico</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <form action="" id="restaurarForm" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <p id="bannerRestore">¿Estas seguro de restaurar este registro?</p>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button"
                                                data-bs-dismiss="modal">Cancelar
                                            </button>
                                            <button class="btn btn-rounded-check" type="submit">Restaurar
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
    </div>
    <script type="application/javascript">
        // hace una peticion ajax para obtener la informacion de la moto
        function deleteMentor(id) {
            let form = document.getElementById('deleteForm')
            form.action = '/academicos/' + id + '/delete'
            $.ajax({
                url: '/academicos/' + id + '/json',
                type: 'GET',
                success: function (response) {
                    $('#banner').html('¿Estas seguro de eliminar este registro? ' + response.titulo + ', ' + response.name);
                }
            })
        }

        function restoreRegistro(id) {
            let form = document.getElementById('restaurarForm')

            form.action = '/academicos/' + id + '/restaurar'
            $.ajax({
                url: '/academicos/' + id + '/json',
                type: 'GET',
                success: function (response) {
                    //console.log(response.name)
                    $('#bannerRestore').html('¿Estas seguro de restaurar este registro? ' + response.titulo + ' ' + response.name);
                }
            })
        }

        function destroyMentor(id) {
            let form = document.getElementById('permanentDelete')
            form.action = '/academicos/' + id + '/force'
            $.ajax({
                url: '/academicos/' + id + '/json',
                type: 'GET',
                success: function (response) {
                    //console.log(response.name)
                    $('#bannerDelete').html('¿Estas seguro de restaurar este registro? ' + response.titulo + ' ' + response.name);
                }
            })
        }
        // Filtrar mentores
        document.getElementById('search').addEventListener('keyup', function() {
            let value = this.value.toLowerCase();
            let rows = document.querySelectorAll('#mentorTable tr');
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
