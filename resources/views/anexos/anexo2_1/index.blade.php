@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Anexo 2.1 - Evaluación de la UE</h3>
            <a href="{{ route('anexo2_1.create') }}" class="btn btn-primary">Crear Nuevo</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Unidad Económica</th>
                        <th>Periodo</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
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
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
