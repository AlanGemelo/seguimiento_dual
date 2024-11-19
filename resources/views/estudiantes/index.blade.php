@extends("layouts.app")
@section("title", "Estudiantes")

@section("content")
    <div class="row">
    
        <div class="col-12 grid-margin">
            @if (session("status"))
                <div class="alert alert-success alert-dismissible text-dark" role="alert">
                    <span class="text-sm"> <a href="javascript:" class="alert-link text-dark">Excelente</a>.
                        {{ session("status") }}.</span>
                    <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
         
            <div  class="row">
                {{-- Estudiantes Lista --}}
                <div 
                    class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header bg-gradient-primary shadow-primary" style="border-radius: 20px 20px 0px 0px;">
                            <div class="container row py-3">
                                <div class="col">
                                    <h4 class="text-capitalize text-white mt-3 ps-3">Lista De Estudiantes</h4>
                                </div>
                                <div class="col d-flex justify-content-end">
                                    {{-- Button del modal --}}
                                    <a href="{{route('estudiantes.create')}}" class="btn btn-primary btn-rounded" title="Agregar una nueva Moto">
                                        <i class="mdi mdi-plus-circle-outline"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table  class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Matricula</th>
                                        <th>Estudiante</th>
                                        <th>CURP</th>
                                        <th>Fecha de Nacimiento</th>
                                        <th>Cuatrimestre</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($estudiantes as $estudiante)
                                        <tr>
                                            <td class="text-center">{{ $loop->index + 1 }}</td>
                                            <td>{{ $estudiante->matricula }}</td>
                                            <td>{{ $estudiante->name }}</td>
                                            <td>{{ $estudiante->curp }}</td>
                                            <td class="text-center">{{ $estudiante->fecha_na }}</td>
                                            <td class="text-center">{{ $estudiante->cuatrimestre }}</td>
                                            <td>
                                                <a href="{{ route('estudiantes.show', Vinkla\Hashids\Facades\Hashids::encode($estudiante->matricula)) }}"
                                                   class="btn btn-icon btn-facebook btn-rounded">
                                                    <i class="mdi mdi-account-details btn-icon-prepend"></i>
                                                </a>
                                            @if(Auth::user()->rol_id === 1)
                                                <a href="{{ route('estudiantes.edit', Vinkla\Hashids\Facades\Hashids::encode($estudiante->matricula)) }}" class="btn btn-rounded btn-icon btn-twitter">
                                                    <i class="mdi mdi-account-edit btn-icon-prepend"></i>
                                                </a>
                                                <button class="btn btn-danger btn-rounded btn-icon" data-bs-toggle="modal"
                                                                data-bs-target="#exampleModal1"
                                                                onclick="deleteEstudiante({{ $estudiante->matricula }})">
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
                                                    @method("DELETE")
                                                    <p id="banner">¿Estás seguro de eliminar este registro?</p>
                                                    <hr>
                                                    <p id="warningMessage" style="color: red; display: none;">Por favor,
                                                        seleccione una razón para la baja.</p>
                                                    <select class="form-select" id='selectMotivo'
                                                        aria-label="Seleccionar Motivo" name="status">
                                                        <option value="" selected>Seleccione razón de la baja</option>
                                                        @foreach ($situation as $carrera)
                                                            <option value="{{ $carrera["id"] }}">
                                                                {{ $carrera["name"] }}
                                                            </option>
                                                        @endforeach
                                                    </select>
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
                {{-- Candidatos Lista --}}
                <dyz class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <!-- <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary rounded pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Lista De Estudiantes Eliminados</h6>
                            </div>
                        </div> -->
                        <div class="card-header bg-gradient-primary shadow-primary" style="border-radius: 20px 20px 0px 0px;">
                            <div class="container row py-3">
                                <div class="col">
                                    <h4 class="text-capitalize text-white mt-3 ps-3">Lista De Estudiantes Eliminados</h4>
                                </div>
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
                                            <th class="text-center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($estudiantesDeleted as $estudianteDeleted)
                                        <tr>
                                            <td class="text-center">{{ $loop->index + 1 }}</td>
                                            <td>{{ $estudianteDeleted->matricula }}</td>
                                            <td>{{ $estudianteDeleted->name }}</td>
                                            <td>{{ $estudianteDeleted->curp }}</td>
                                            <td class="text-center">{{ $estudianteDeleted->fecha_na }}</td>
                                            <td class="text-center">{{ $estudianteDeleted->cuatrimestre }}</td>
                                            <td>
                                                <button
                                                    class="btn btn-rounded btn-secondary btn-sm"
                                                    title="Restore"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal3"
                                                    data-bs-placement="top"
                                                    onclick="restoreRegistro({{$estudianteDeleted->matricula}})"
                                                >
                                                    Reactivar
                                                    <i class="mdi mdi-backup-restore float-right"></i>
                                                </button>

                                                <button
                                                    class="btn btn-danger btn-sm align-content-md-center align-items-center align-self-center"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal2"
                                                    data-bs-placement="top"
                                                    title="Eliminar Permanentemente"
                                                    type="button"
                                                    onclick="destroyMentor({{$estudianteDeleted->matricula}})"
                                                >
                                                    Eliminar
                                                    <i class="mdi mdi-delete  "></i>
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
                        <h5 class="modal-title" id="exampleModalLabel">Eliminar Mentor Academico Permanentemente</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
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
        <div class="modal fade" id="exampleModal3" tabindex="-1"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Restaurar Mentor Academico</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
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
                                            <button class="btn btn-success btn-rounded-check" type="submit">Restaurar
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
        function deleteEstudiante(matricula) {
            let form = document.getElementById('deleteForm')
            form.action = '/estudiantes/' + matricula + '/delete'
            $.ajax({
                url: '/estudiantes/' + matricula + '/json',
                type: 'GET',
                success: function (response) {
                    $('#banner').html('¿Estas seguro de eliminar este registro? <br> Matricula: ' + response[0].matricula + '<br>' + response[0].name);
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
                    $('#bannerRestore').html('¿Estas seguro de restaurar este registro? <br> Matricula: ' + response[0].matricula + '<br>' + response[0].name);
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
                    $('#bannerDelete').html('¿Estas seguro de restaurar este registro? <br> Matricula: ' + response[0].matricula + '<br>' + response[0].name);
                }
            })
        }
    </script>
@endsection
