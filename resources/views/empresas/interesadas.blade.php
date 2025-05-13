@extends('layouts.app')
@section('title', 'Empresas Interesadas')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary rounded pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Unidades Económicas Interesadas (UEI)</h6>
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
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="empresaTable">
                            @foreach($empresas as $empresa)
                                <tr>
                                    <td>{{ $empresa->unidad_economica }}</td>
                                    <td>{{ $empresa->email }}</td>
                                    <td>{{ $empresa->telefono }}</td>
                                    <td>{{ $empresa->fecha_registro }}</td>
                                    <td>
                                        <a href="{{ route('empresas.darAlta', $empresa->id) }}" class="btn btn-success">Dar de Alta</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
    </script>
@endsection
