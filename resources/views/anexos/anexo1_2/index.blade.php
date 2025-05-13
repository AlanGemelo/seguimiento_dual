@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-primary shadow-primary rounded pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Anexo 1.2 - Programa de Difusión de la ED</h6>
                <div class="float-end">
                    <a href="{{ route('anexo1_2.create') }}" class="btn btn-primary" title="Crear Nuevo">
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
