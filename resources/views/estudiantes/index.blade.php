@extends('layouts.app')
@section('title', 'Estudiantes')

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
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary rounded pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Lista De Estudiantes</h6>
                                @if (Auth::user()->rol_id === 1)
                                    <div class="float-end">
                                        {{-- Button del modal --}}
                                        <a href="{{ route('estudiantes.create') }}" class="btn btn-primary"
                                            title="Agregar una nueva Moto">
                                            <i class="mdi mdi-plus-circle-outline"></i>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Matricula</th>
                                            <th>Estudiante</th>
                                            <th>CURP</th>
                                            <th>Fecha de Nacimiento</th>
                                            <th>Cuatrimestre</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($estudiantes as $estudiante)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $estudiante->matricula }}</td>
                                                <td>{{ $estudiante->name }}</td>
                                                <td>{{ $estudiante->curp }}</td>
                                                <td>{{ $estudiante->fecha_na }}</td>
                                                <td>{{ $estudiante->cuatrimestre }}</td>
                                                <td>
                                                    <a href="{{ route('estudiantes.show', Vinkla\Hashids\Facades\Hashids::encode($estudiante->matricula)) }}"
                                                        class="btn btn-facebook">
                                                        <i class="mdi mdi-account-details btn-icon-prepend"></i>
                                                    </a>
                                                    <a href="{{ route('estudiantes.edit', Vinkla\Hashids\Facades\Hashids::encode($estudiante->matricula)) }}"
                                                        class="btn btn-twitter">
                                                        <i class="mdi mdi-account-edit btn-icon-prepend"></i>
                                                    </a>
                                                    @if (Auth::user()->rol_id === 1)
                                                        <button class="btn btn-danger" data-bs-toggle="modal"
                                                            data-bs-target="#exampleModal1"
                                                            onclick="deleteEstudiante({{ $estudiante->matricula }},5)">
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
                                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Estudiante Temporalmente</h5>
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
                                                    <hr>
                                                    <p id="warningMessage" style="color: red; display: none;">Por favor,
                                                        seleccione una razón para la baja.</p>
                                                    <select class="form-select" id='selectMotivo'
                                                        aria-label="Seleccionar Motivo" name="status">
                                                        <option value="" selected>Seleccione razon de la baja</option>
                                                        @foreach ($situation as $carrera)
                                                            <option value="{{ $carrera['id'] }}">
                                                                {{ $carrera['name'] }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button"
                                                            data-bs-dismiss="modal">Cancelar
                                                        </button>
                                                        <button class="btn btn-danger" type="submit" ">Eliminar</button>

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
                  @if ($estudiantesDeleted->count() !== 0)
                                                            @if (Auth::user()->rol_id === 1)
                                                                <div class="col-lg-12 grid-margin stretch-card">
                                                                    <div class="card">
                                                                        <div
                                                                            class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                                                            <div
                                                                                class="bg-gradient-primary shadow-primary rounded pt-4 pb-3">
                                                                                <h6 class="text-white text-capitalize ps-3">
                                                                                    Lista De Estudiantes Eliminados</h6>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            <div class="table-responsive">
                                                                                <table class="table table-hover">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>#</th>
                                                                                            <th>Matricula</th>
                                                                                            <th>Estudiante</th>
                                                                                            <th>CURP</th>
                                                                                            <th>Fecha de Nacimiento</th>
                                                                                            <th>Cuatrimestre</th>
                                                                                            <th>Motivo</th>
                                                                                            <th>Acciones</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>

                                                                                        @foreach ($estudiantesDeleted as $estudianteDeleted)
                                                                                            <tr>
                                                                                                <td>{{ $loop->index + 1 }}
                                                                                                </td>
                                                                                                <td>{{ $estudianteDeleted->matricula }}
                                                                                                </td>
                                                                                                <td>{{ $estudianteDeleted->name }}
                                                                                                </td>
                                                                                                <td>{{ $estudianteDeleted->curp }}
                                                                                                </td>
                                                                                                <td>{{ $estudianteDeleted->fecha_na }}
                                                                                                </td>
                                                                                                <td>{{ $estudianteDeleted->cuatrimestre }}
                                                                                                </td>
                                                                                                <td>{{ $estudiante->status_text }}
                                                                                                </td>        

                                                                                                <td>
                                                                                                    <button
                                                                                                        class="btn btn-rounded-success btn-sm align-content-md-center align-items-center align-self-center"
                                                                                                        title="Restore"
                                                                                                        data-bs-toggle="modal"
                                                                                                        data-bs-target="#exampleModal3"
                                                                                                        data-bs-placement="top"
                                                                                                        onclick="restoreRegistro({{ $estudianteDeleted->matricula }})">
                                                                                                        Reactivar
                                                                                                        &nbsp;&nbsp;
                                                                                                        <i
                                                                                                            class="mdi mdi-backup-restore"></i>
                                                                                                    </button>

                                                                                                    <button
                                                                                                        class="btn btn-danger btn-sm align-content-md-center align-items-center align-self-center"
                                                                                                        data-bs-toggle="modal"
                                                                                                        data-bs-target="#exampleModal2"
                                                                                                        data-bs-placement="top"
                                                                                                        title="Eliminar Permanentemente"
                                                                                                        type="button"
                                                                                                        onclick="destroyMentor({{ $estudianteDeleted->matricula }})">
                                                                                                        Eliminar
                                                                                                        &nbsp;&nbsp;
                                                                                                        <i
                                                                                                            class="mdi mdi-delete"></i>
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

                                                            <div class="modal fade" id="exampleModal2" tabindex="-1"
                                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="exampleModalLabel">Eliminar Mentor
                                                                                Academico Permanentemente</h5>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="container">
                                                                                <div class="row justify-content-center">
                                                                                    <div class="col-md-12">
                                                                                        <form action=""
                                                                                            id="permanentDelete"
                                                                                            method="POST">
                                                                                            @csrf
                                                                                            @method('DELETE')
                                                                                            <p id="bannerDelete">¿Estas
                                                                                                seguro de eliminar este
                                                                                                registro?</p>
                                                                                            <div class="modal-footer">
                                                                                                <button
                                                                                                    class="btn btn-secondary"
                                                                                                    type="button"
                                                                                                    data-bs-dismiss="modal">Cancelar
                                                                                                </button>
                                                                                                <button
                                                                                                    class="btn btn-danger"
                                                                                                    type="submit">Eliminar</button>
                                                                                            </div>
                                                                                        </form>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal fade" id="exampleModal3" tabindex="-1"
                                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="exampleModalLabel">Restaurar Mentor
                                                                                Academico</h5>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="container">
                                                                                <div class="row justify-content-center">
                                                                                    <div class="col-md-12">
                                                                                        <form action=""
                                                                                            id="restaurarForm"
                                                                                            method="POST">
                                                                                            @csrf
                                                                                            @method('PATCH')
                                                                                            <p id="bannerRestore">¿Estas
                                                                                                seguro de restaurar este
                                                                                                registro?</p>
                                                                                            <div class="modal-footer">
                                                                                                <button
                                                                                                    class="btn btn-secondary"
                                                                                                    type="button"
                                                                                                    data-bs-dismiss="modal">Cancelar
                                                                                                </button>
                                                                                                <button
                                                                                                    class="btn btn-rounded-check"
                                                                                                    type="submit">Restaurar
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
    function mostrar(id) {
switch (id) {
    case 0:
        return 'Reprobacion'
        
        break;
    case 1:
        return 'Termino de COnvenio'
        
        break;
    case 2:
        return 'Ciclo de Renovacion Concluido'
        
        break;
    case 3:
        return 'Termino del PE'
        
        break;

    default:
        break;
}
    }

            document.getElementById('deleteForm').addEventListener('submit', function(event) {
        let selectMotivo = document.getElementById('selectMotivo');
        let warningMessage = document.getElementById('warningMessage');
        if (selectMotivo.value === "") {
            event.preventDefault(); // Evita el envío del formulario
            warningMessage.style.display = 'block'; // Muestra el mensaje de advertencia
        } else {
            warningMessage.style.display = 'none'; // Oculta el mensaje de advertencia si la selección es válida
        }
    });
        // hace una peticion ajax para obtener la informacion de la moto
        function deleteEstudiante(matricula,motivo) {
            let form = document.getElementById('deleteForm')
            form.action = '/estudiantes/' + matricula + '/delete'
            $.ajax({
                url: '/estudiantes/' + matricula + '/json',
                type: 'GET',
                success: function (response) {
                    $('#banner').html('¿Estas seguro de eliminar este registro? ' + response[0].name + ', Matricula: ' + response[0].matricula);
                }
            })
        }

        

        function restoreRegistro(id) {
            let form = document.getElementById('restaurarForm')

            form.action = '/estudiantes/' + id + '/restaurar'
            $.ajax({
                url: '/estudiantes/' + id  + '/json',
                type: 'GET',
                success: function (response) {
                    //console.log(response.name)
                    $('#bannerRestore').html('¿Estas seguro de restaurar este registro? ' + response[0].name + ', Matricula: ' + response[0].matricula);
                }
            })
        }

        function destroyMentor(id) {
            let form = document.getElementById('permanentDelete')
            form.action = '/estudiantes/' + id + '/force'
            $.ajax({
                url: '/estudiantes/' + id + '/json',
                type: 'GET',
                success: function (response) {
                    //console.log(response.name)
                    $('#bannerDelete').html('¿Estas seguro de restaurar este registro? ' + response[0].name + ', Matricula: ' + response[0].matricula);
                }
            })
        }
    </script>
                                                @endsection
