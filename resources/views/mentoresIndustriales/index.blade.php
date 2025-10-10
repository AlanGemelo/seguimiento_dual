@extends('layouts.app')
@section('title', 'Mentores Industriales')

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
                                <h6 class="card-title">Lista De Mentores de Unidad Economica</h6>
                                @if (Auth::user()->rol_id === 1 || Auth::user()->rol_id === 4)
                                    <div class="float-end">
                                        {{-- Button del modal --}}
                                        <a href="{{ route('mentores.create') }}" class="btn btn-add"
                                            title="Agregar un nuevo Mentor Industrial">
                                            <i class="mdi mdi-plus-circle-outline"></i>
                                        </a>
                                    </div>
                                @endif
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <input class="form-control" id="search" type="text" placeholder="Buscar...">
                                    <br>
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nombre</th>
                                                <th>Puesto</th>
                                                <th>Empresa</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tableBody">
                                            @if ($mentores->isEmpty())
                                                <tr>
                                                    <td colspan="5" class="text-center">Aún no hay registros</td>
                                                </tr>
                                            @else
                                                @foreach ($mentores as $mentor)
                                                    <tr>
                                                        <td>{{ $loop->index + 1 }}</td>
                                                        <td>{{ $mentor->titulo }} .
                                                            {{ $mentor->name . ' ' . $mentor->apellidoP . ' ' . $mentor->apellidoM }}
                                                        </td>
                                                        <td>{{ $mentor->puesto }}</td>
                                                        <td>{{ $mentor->empresa->nombre }}</td>
                                                        <td>
                                                            <a href="{{ route('mentores.show', Vinkla\Hashids\Facades\Hashids::encode($mentor->id)) }}"
                                                                class="btn btn-facebook" style=" background-color: #00798c">
                                                                <i class="mdi mdi-eye btn-icon-prepend"
                                                                    style="font-size: 1.5em;"></i>
                                                            </a>
                                                            @if (Auth::user()->rol_id === 1 || Auth::user()->rol_id === 4)
                                                                <a href="{{ route('mentores.edit', Vinkla\Hashids\Facades\Hashids::encode($mentor->id)) }}"
                                                                    class="btn btn-twitter"
                                                                    style=" background-color: #ffa719">
                                                                    <i class="mdi mdi-account-edit btn-icon-prepend"
                                                                        style="font-size: 1.5em;"></i>
                                                                </a>
                                                                <button class="btn btn-danger"
                                                                    style=" background-color: #e63946"
                                                                    data-bs-toggle="modal" data-bs-target="#exampleModal1"
                                                                    onclick="deleteMentorIndustrial('{{ Hashids::encode($mentor->id) }}')">
                                                                    <i class="mdi mdi-delete btn-icon-prepend"
                                                                        style="font-size: 1.5em;"></i>
                                                                </button> -

                                                                {{--  <form
                                                                    action="{{ route('mentores.destroy', Vinkla\Hashids\Facades\Hashids::encode($mentor->id)) }}"
                                                                    method="POST" style="display:inline-block;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger"
                                                                        style="background-color: #e63946">
                                                                        <i class="mdi mdi-delete btn-icon-prepend"
                                                                            style="font-size: 1.5em;"></i>
                                                                    </button>
                                                                </form> --}}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>

                        {{-- Modal Eliminar Mentor Idustrial Temporalmente --}}
                        <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Eliminar Mentor Industrial</h5>
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

                        {{-- Modal Restaurar Mentor Idustrial --}}
                        <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Restaurar Mentor Industrial</h5>
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
                </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function deleteMentorIndustrial(hashedId) {
            let form = document.getElementById('deleteForm');

            // form.action = `${window.BASE_URL}/mentores/${id}/delete`;
            form.action = `${window.BASE_URL}/mentores/${hashedId}/delete`;

            console.log('El id es: ', hashedId);
            console.log('Form action:', form.action);
            // hace una peticion ajax para obtener la informacion de la asesor Industrial
            $.ajax({
                url: `${window.BASE_URL}/mentores/${hashedId}/json`,
                type: 'GET',
                success: function(response) {
                    $('#banner').text('¿Estas seguro de eliminar este registro: ' +
                        response.titulo + ' ' +
                        response.name + ' ' +
                        response.apellidoP + ' ' +
                        response.apellidoM + '?');
                },
                error: function(xhr, status, error) {
                    console.error("Error al obtener los datos del mentor:", error);
                }
            });
        }

        function restoreRegistro(hashedId) {
            let form = document.getElementById('restaurarForm');
            form.action = `${window.BASE_URL}/mentores/${hashedId}/restaurar`;

            $.ajax({
                url: `${window.BASE_URL}/mentores/${hashedId}/json`,
                type: 'GET',
                success: function(response) {
                    $('#bannerRestore').text(
                        '¿Estás seguro de restaurar este registro? ' +
                        response.titulo + ' ' +
                        response.name + ' ' +
                        response.apellidoP + ' ' +
                        response.apellidoM + '?'
                    );
                },
                error: function(xhr, status, error) {
                    console.error("Error al obtener los datos del mentor:", error);
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
    </script>
@endsection
</body>
