@extends('layouts.app')
@section('title', 'Estudiantes')

@section('content')
    <style>
        .xd:hover .btn-text {
            display: none;
        }
    </style>
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

            <div class="row xd">
                {{-- Estudiantes Lista --}}
                @if (Auth::user()->rol_id !== 1)
                    <div class="bg-gradient float-end mt-2 mb-2 text-center">
                        <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                            data-bs-target="#exampleModalCenter">
                            <i class="mdi mdi-download"></i>
                            <span class="btn-text">Descargar Anexos</span>
                        </button>
                    </div>
                @endif
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header justify-content-center">
                                <h5 class="modal-title " id="exampleModalLongTitle "> Plantillas de los Anexos</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Anexo 5.1
                                        <a href="/descargar/Anexo 5.1 Plan de Formación.docx" class="btn btn-info"
                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Descargar Plantilla Word">
                                            <i class="mdi mdi-file-word"></i>
                                        </a>
                                        <a href="/descargar/5.1 Plan de Formación.pdf" class="btn btn-danger"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Descargar en PDF">
                                            <i class="mdi mdi-file-pdf"></i>
                                        </a>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Anexo 5.4
                                        <a href="/descargar/Anexo 5.4 Reporte de Actividades.docx" class="btn btn-info">
                                            <i class="mdi mdi-file-word"></i>
                                        </a>
                                        <a href="/descargar/anexo 5.4 .pdf" class="btn btn-danger" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Descargar en PDF">
                                            <i class="mdi mdi-file-pdf"></i>
                                        </a>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Anexo 5.5
                                        <a href="/descargar/Anexo 5.5 Seguimiento y Evaluación.docx" class="btn btn-info">
                                            <i class="mdi mdi-file-word"></i>
                                        </a>
                                        <a href="/descargar/anexo 5.5.pdf" class="btn btn-danger" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Descargar en PDF">
                                            <i class="mdi mdi-file-pdf"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="modal-footer justify-content-center">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    
                        <div class="card-header-adjusted">
                            <h6 class="card-title">Lista De Estudiantes</h6>
                            @if (Auth::user()->rol_id === 1 || Auth::user()->rol_id === 2 || Auth::user()->rol_id === 4)
                                <div class="float-end">
                                    {{-- Button del modal --}}
                                    <a href="{{ route('estudiantes.create') }}" class="btn btn-add"
                                        title="Agregar una nueva estudiante">
                                        <i class="mdi mdi-plus-circle-outline"></i>
                                    </a>
                                </div>
                            @endif
                        </div>
                    
                    <div class="card-body">
                        <div class="table-responsive">
                            <form method="GET" action="{{ route('estudiantes.index') }}" class="mb-3">
                                <input type="text" class="form-control" name="search" value="{{ $search }}"
                                    placeholder="Buscar estudiantes..."
                                    onkeydown="if(event.key === 'Enter') this.form.submit()">
                            </form>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Estudiante</th>
                                        <th class="align-center">Carrera</th>
                                        <th>Cuatrimestre</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    @if ($estudiantes->count() === 0)
                                        <tr class="animate__animated animate__fadeInDown ">
                                            <td colspan="7">
                                                <div class="alert alert-danger" role="alert">
                                                    No hay registros de estudiantes
                                                </div>
                                            </td>
                                        </tr>
                                    @else
                                        @foreach ($estudiantes as $estudiante)
                                            <tr class="animate__animated animate__fadeInDown " id='aiuda'>

                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $estudiante->name . ' ' . $estudiante->apellidoP . ' ' . $estudiante->apellidoM }}
                                                </td>
                                                <td>{{ $estudiante->carrera->nombre }}</td>

                                                <td>{{ $estudiante->cuatrimestre }}</td>
                                                <td>
                                                    <a href="{{ route('estudiantes.show', Vinkla\Hashids\Facades\Hashids::encode($estudiante->matricula)) }}"
                                                        class="btn btn-facebook">
                                                        <i class="mdi mdi-eye btn-icon-prepend"></i>
                                                    </a>
                                                    <a href="{{ route('estudiantes.edit', Vinkla\Hashids\Facades\Hashids::encode($estudiante->matricula)) }}"
                                                        class="btn btn-twitter">
                                                        <i class="mdi mdi-account-edit btn-icon-prepend"></i>
                                                    </a>
                                                    @if (Auth::user()->rol_id === 1 || Auth::user()->rol_id === 4)
                                                        <button class="btn btn-danger" data-bs-toggle="modal"
                                                            data-bs-target="#exampleModal1"
                                                            onclick="deleteEstudiante({{ $estudiante->matricula }},5)">
                                                            <i class="mdi mdi-delete btn-icon-prepend"></i>
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center mt-4">
                                {{ $estudiantes->links() }}
                            </div>

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
                                                <p id="banner">¿Estás seguro de eliminar este registro?</p>
                                                <hr>
                                                <p id="warningMessage" style="color: red; display: none;">Por favor,
                                                    seleccione una razón para la baja.</p>
                                                <select class="form-select" id='selectMotivo'
                                                    aria-label="Seleccionar Motivo" name="status">
                                                    <option value="" selected>Seleccione razón de la baja</option>
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
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    
                        <div class="card-header-adjusted">
                            <h6 class="card-title">Lista De Candidatos a Dual</h6>
                            @if (Auth::user()->rol_id === 1 || Auth::user()->rol_id === 4)
                                <div class="float-end">
                                    {{-- Button del modal --}}
                                    <a href="{{ route('estudiantes.crearC') }}" class="btn btn-add"
                                        title="Agregar un nuevo candidato">
                                        <i class="mdi mdi-plus-circle-outline"></i>
                                    </a>
                                </div>
                            @endif
                        </div>
                    
                    <div class="card-body">
                        <div class="table-responsive">
                            <form method="GET" action="{{ route('estudiantes.index') }}" class="mb-3">
                                <input type="text" class="form-control" name="search_candidatos"
                                    value="{{ $search_candidatos ?? '' }}" placeholder="Buscar candidatos..."
                                    onkeydown="if(event.key === 'Enter') this.form.submit()">
                            </form>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Candidato</th>
                                        <th class="align-center">Carrera</th>
                                        <th>Email</th>
                                        <th>Cuatrimestre</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBodyCandidatos">
                                    @if ($candidatos->count() === 0)
                                        <tr>
                                            <td colspan="7">
                                                <div class="alert alert-danger" role="alert">
                                                    No hay registros de candidatos
                                                </div>
                                            </td>
                                        </tr>
                                    @else
                                        @foreach ($candidatos as $estudiante)
                                            <tr class="animate__animated animate__fadeInDown " id='aiuda'>

                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $estudiante->name . ' ' . $estudiante->apellidoP . ' ' . $estudiante->apellidoM }}
                                                </td>
                                                <td>{{ $estudiante->carrera->nombre }}</td>
                                                <td>{{ $estudiante->usuario?->email ?? 'Sin correo' }}</td>


                                                <td>{{ $estudiante->cuatrimestre }}</td>
                                                <td>
                                                    <a href="{{ route('estudiantes.showC', Vinkla\Hashids\Facades\Hashids::encode($estudiante->matricula)) }}"
                                                        class="btn btn-facebook">
                                                        <i class="mdi mdi-eye btn-icon-prepend"></i>
                                                    </a>
                                                    <a href="{{ route('estudiantes.edit', Vinkla\Hashids\Facades\Hashids::encode($estudiante->matricula)) }}"
                                                        class="btn btn-twitter">
                                                        <i class="mdi mdi-arrow-up btn-icon-prepend"></i>
                                                    </a>
                                                    @if (Auth::user()->rol_id === 1 || Auth::user()->rol_id === 4)
                                                        <button class="btn btn-danger" data-bs-toggle="modal"
                                                            data-bs-target="#exampleModal1"
                                                            onclick="deleteEstudiante({{ $estudiante->matricula }},5)">
                                                            <i class="mdi mdi-delete btn-icon-prepend"></i>
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center mt-4">
                                {{ $candidatos->links() }}
                            </div>
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
                                                <p id="banner">¿Estás seguro de eliminar este registro?</p>
                                                <hr>
                                                <p id="warningMessage" style="color: red; display: none;">Por favor,
                                                    seleccione una razón para la baja.</p>
                                                <select class="form-select" id='selectMotivo'
                                                    aria-label="Seleccionar Motivo" name="status">
                                                    <option value="" selected>Seleccione razón de la baja</option>
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
        {{-- Eliminados Lista --}}
        @if ($estudiantesDeleted->count() !== 0)
            @if (Auth::user()->rol_id === 1 || Auth::user()->rol_id === 4)
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary rounded pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Lista De Estudiantes Eliminados</h6>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <form method="GET" action="{{ route('estudiantes.index') }}" class="mb-3">
                                    <input type="text" id="searchInput" class="form-control" name="search_eliminados"
                                        value="{{ $search_eliminados ?? '' }}" placeholder="Buscar candidatos..."
                                        onkeydown="if(event.key === 'Enter') this.form.submit()">
                                </form>

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
                                    <tbody id="tableBodyEliminados">
                                        @foreach ($estudiantesDeleted as $estudianteDeleted)
                                            <tr class="animate__animated animate__fadeInDown " id='aiuda'>
                                                <td>{{ ($estudiantesDeleted->currentPage() - 1) * $estudiantesDeleted->perPage() + $loop->iteration }}
                                                </td>
                                                <td>{{ $estudianteDeleted->matricula }}</td>
                                                <td>{{ $estudianteDeleted->name . ' ' . $estudianteDeleted->apellidoP . ' ' . $estudianteDeleted->apellidoM }}
                                                </td>
                                                <td>{{ $estudianteDeleted->curp }}</td>
                                                <td>{{ $estudianteDeleted->fecha_na }}</td>
                                                <td>{{ $estudianteDeleted->cuatrimestre }}</td>
                                                <td>{{ $estudianteDeleted->status_text }}</td>
                                                <td>
                                                    <button
                                                        class="btn btn-rounded-success btn-sm align-content-md-center align-items-center align-self-center"
                                                        title="Restore" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal3" data-bs-placement="top"
                                                        onclick="restoreRegistro({{ $estudianteDeleted->matricula }})">
                                                        Reactivar &nbsp;&nbsp;
                                                        <i class="mdi mdi-backup-restore"></i>
                                                    </button>
                                                    <button
                                                        class="btn btn-danger btn-sm align-content-md-center align-items-center align-self-center"
                                                        data-bs-toggle="modal" data-bs-target="#exampleModal2"
                                                        data-bs-placement="top" title="Eliminar Permanentemente"
                                                        type="button"
                                                        onclick="destroyMentor({{ $estudianteDeleted->matricula }})">
                                                        Eliminar &nbsp;&nbsp;
                                                        <i class="mdi mdi-delete"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <div class="d-flex justify-content-center mt-4">
                                    {{ $estudiantesDeleted->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endif
    </div>
    </div>
    </div>
    </div>
    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <p id="bannerDelete">¿Estás seguro de eliminar este registro?</p>
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
    <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <p id="bannerRestore">¿Estás seguro de restaurar este registro?</p>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancelar
                                        </button>
                                        <button class="btn btn-rounded-check" type="submit">Restaurar</button>
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
    // Función para mostrar el motivo de baja en base al ID
    function mostrar(id) {
        switch (id) {
            case 0:
                return 'Reprobacion';
                break;
            case 1:
                return 'Termino de Convenio';
                break;
            case 2:
                return 'Ciclo de Renovacion Concluido';
                break;
            case 3:
                return 'Termino del PE';
                break;
            default:
                break;
        }
    }

    // Validación del formulario de eliminación
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

    // Petición AJAX para obtener la información del estudiante a eliminar
    function deleteEstudiante(matricula, motivo) {
        let form = document.getElementById('deleteForm');
        form.action = '/estudiantes/' + matricula + '/delete';
        $.ajax({
            url: '/estudiantes/' + matricula + '/json',
            type: 'GET',
            success: function(response) {
                $('#banner').html('¿Estás seguro de eliminar este registro? ' + response[0].name + ', Matricula: ' + response[0].matricula);
            }
        });
    }

    // Petición AJAX para restaurar un estudiante eliminado
    function restoreRegistro(id) {
        let form = document.getElementById('restaurarForm');
        form.action = '/estudiantes/' + id + '/restaurar';
        $.ajax({
            url: '/estudiantes/' + id + '/json',
            type: 'GET',
            success: function(response) {
                $('#bannerRestore').html('¿Estás seguro de restaurar este registro? ' + response[0].name + ', Matricula: ' + response[0].matricula);
            }
        });
    }

    // Petición AJAX para eliminar permanentemente un estudiante
    function destroyMentor(id) {
        let form = document.getElementById('permanentDelete');
        form.action = '/estudiantes/' + id + '/force';
        $.ajax({
            url: '/estudiantes/' + id + '/json',
            type: 'GET',
            success: function(response) {
                $('#bannerDelete').html('¿Estás seguro de restaurar este registro? ' + response[0].name + ', Matricula: ' + response[0].matricula);
            }
        });
    }


    // Filtrar tabla
    document.getElementById('searchInput').addEventListener('keyup', function() {
        let input = document.getElementById('searchInput');
        let filter = input.value.toLowerCase();
        let tableBody = document.getElementById('tableBody');
        let rows = tableBody.getElementsByTagName('tr');

        for (let i = 0; i < rows.length; i++) {
            let cells = rows[i].getElementsByTagName('td');
            let match = false;

            for (let j = 0; j < cells.length; j++) {
                if (cells[j].innerText.toLowerCase().indexOf(filter) > -1) {
                    match = true;
                    break;
                }
            }

            if (match) {
                rows[i].style.display = '';
            } else {
                rows[i].style.display = 'none';
            }
        }
    });

    function filterTable(inputId, tableBodyId) {
        let input = document.getElementById(inputId);
        let filter = input.value.toLowerCase();
        let tableBody = document.getElementById(tableBodyId);
        let rows = tableBody.getElementsByTagName('tr');

        for (let i = 0; i < rows.length; i++) {
            let cells = rows[i].getElementsByTagName('td');
            let match = false;

            for (let j = 0; j < cells.length; j++) {
                if (cells[j].innerText.toLowerCase().indexOf(filter) > -1) {
                    match = true;
                    break;
                }
            }

            if (match) {
                rows[i].style.display = '';
            } else {
                rows[i].style.display = 'none';
            }
        }
    }
</script>
@endsection
</body>