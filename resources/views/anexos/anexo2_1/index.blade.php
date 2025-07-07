@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/listas.css') }}">

    <body class="body">
<div class="container">
    <div class="card">
        <div class="card-header-adjusted">
            
                <h6 class="card-title">Anexo 2.1 - Evaluación de la UE</h6>
                <div class="float-end">
                    <a href="{{ route('anexo2_1.create') }}" class="btn btn-add" title="Crear Nuevo">
                        <i class="mdi mdi-plus-circle-outline"></i>
                    </a>
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
                            <th>ID</th>
                            <th>Unidad Económica</th>
                            <th>Periodo</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="anexoTable">
                        @foreach($anexos as $anexo)
                            <tr>
                                <td>{{ $anexo->id }}</td>
                                <td>{{ $anexo->unidad_economica }}</td>
                                <td>{{ $anexo->periodo }}</td>
                                <td>{{ $anexo->fecha }}</td>
                                <td>
                                    <a href="{{ route('anexo2_1.edit', $anexo->id) }}" class="btn btn-warning">Editar</a>
                                    <form action="{{ route('anexo2_1.destroy', $anexo->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Está seguro de eliminar este registro?')">Eliminar</button>
                                    </form>
                                    <a href="{{ route('anexo2_1.generatePdf', $anexo->id) }}" class="btn btn-info">PDF</a>
                                    <a href="{{ route('anexo2_1.generateWord', $anexo->id) }}" class="btn btn-info">Word</a>
                                    <a href="{{ route('empresas.create', ['anexo2_1_id' => $anexo->id]) }}" class="btn btn-success">Convertir a UE Interesada</a>
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
    let rows = document.querySelectorAll('#anexoTable tr');
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
</body>