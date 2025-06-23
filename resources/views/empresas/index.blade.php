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
<<<<<<< HEAD
                @endif
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <!-- <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary rounded pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Lista De Empresas</h6>
                                @if(Auth::user()->rol_id === 1 || Auth::user()->rol_id === 4)
                                    <div class="float-end">
                                        {{-- Button del modal --}}
                                        <a href="{{route('empresas.create')}}" class="btn btn-primary"
                                           title="Agregar una nueva Empresa">
                                            <i class="mdi mdi-plus-circle-outline"></i>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div> -->
                        <div class="card-header bg-gradient-primary shadow-primary" style="border-radius: 20px 20px 0px 0px;">
                            <div class="container row py-2">
                                <div class="col">
                                    <h4 class="text-capitalize text-white mt-3 ps-3">Lista De Empresas</h4>
                                </div>
                                <div class="col d-flex justify-content-end">
                                    {{-- Button del modal --}}
                                    <a href="{{route('empresas.create')}}" class="btn btn-primary btn-rounded" title="Agregar una nueva Empresa">
                                        <i class="mdi mdi-plus-circle-outline"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Empresa</th>
                                        <th>Descripcion</th>
                                        <th>Telefono</th>
                                        <th>Convenio</th>
                                        <th>Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($empresas as $empresa)
                                        <tr>
                                            <td class="text-center">{{ $loop->index + 1 }}</td>
                                            <td>{{ $empresa->nombre }}</td>
                                            <td>{{ $empresa->direccion }}</td>
                                            <td>{{ $empresa->telefono }}</td>
                                            <td>{{ $empresa->direcciones->name }}</td>
                                            <td>
                                                <a href="{{ route('empresas.show', Vinkla\Hashids\Facades\Hashids::encode($empresa->id)) }}"
                                                   class="btn btn-facebook btn-rounded">
                                                    <i class="mdi mdi-account-details btn-icon-prepend"></i>
                                                </a>
                                                @if(Auth::user()->rol_id === 1 || Auth::user()->rol_id === 4)
                                                    <a href="{{ route('empresas.edit', Vinkla\Hashids\Facades\Hashids::encode($empresa->id)) }}" class="btn btn-twitter">
                                                        <i class="mdi mdi-account-edit btn-icon-prepend"></i>
                                                    </a>
                                                    <button class="btn btn-danger btn-rounded" data-bs-toggle="modal"
                                                            data-bs-target="#exampleModal1"
                                                            onclick="deleteEstudiante({{ $empresa->id }})">
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
=======
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
                                    <td>{{ $empresa->fecha_registro }}</td>
                                    <td>{{ $empresa->inicio_conv }} - {{ $empresa->fin_conv }}</td>
                                    <td>
                                        <a href="{{ route('empresas.edit', $empresa->id) }}"
                                            class="btn btn-warning">Editar</a>
                                        <form action="{{ route('empresas.destroy', $empresa->id) }}" method="POST"
                                            style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('¿Está seguro de eliminar esta empresa?')">Eliminar</button>
                                        </form>
                                        <a href="{{ route('empresas.downloadPDF', $empresa->id) }}"
                                            class="btn btn-info">PDF</a>
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
>>>>>>> f57f20083a2decb167ed3140251ba15d87cdac3d
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
                                    <td>{{ $empresa->unidad_economica }}</td>
                                    <td>{{ $empresa->email }}</td>
                                    <td>{{ $empresa->telefono }}</td>
                                    <td>{{ $empresa->fecha_registro }}</td>
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
<<<<<<< HEAD
    <script type="application/javascript">
        // hace una peticion ajax para obtener la informacion de la moto
        function deleteEstudiante(id) {
            let form = document.getElementById('deleteForm')
            form.action = '/empresas/' + id + '/delete'
            $.ajax({
                url: '/empresas/' + id + '/json',
                type: 'GET',
                success: function (response) {
                    $('#banner').html('¿Estas seguro de eliminar este registro? <br>' + response.nombre);
                }
            })
        }
=======

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
>>>>>>> f57f20083a2decb167ed3140251ba15d87cdac3d
    </script>
@endsection
