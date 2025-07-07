@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/listas.css') }}">

    <body class="body">
<div class="container">
    <div class="card">
        <div class="card-header-adjusted">
            
                <h6 class="card-title">Anexo 1.2 - Programa de Difusión de la ED</h6>
                <div class="float-end">
                    <a href="{{ route('anexo1_2.create') }}" class="btn btn-add" title="Crear Nuevo">
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
                            <th>Fecha de Creación</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="anexoTable">
                        @foreach($anexos as $anexo)
                            <tr>
                                <td>{{ $anexo->id }}</td>
                                <td>{{ $anexo->created_at }}</td>
                                <td>
                                    <a href="{{ route('anexo1_2.edit', $anexo->id) }}" class="btn btn-warning">Editar</a>
                                    <form action="{{ route('anexo1_2.destroy', $anexo->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Está seguro de eliminar este registro?')">Eliminar</button>
                                    </form>
                                    <a href="{{ route('anexo1_2.generatePdf', $anexo->id) }}" class="btn btn-info">PDF</a>
                                    <a href="{{ route('anexo1_2.generateWord', $anexo->id) }}" class="btn btn-info">Word</a>
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