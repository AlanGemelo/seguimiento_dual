@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Editar Anexo 2.1 - Evaluación y Selección de la UE</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('anexo2_1.update', $anexo2_1->id) }}" method="POST" id="anexo2_1_form">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="unidad_economica" class="form-label">Unidad Económica</label>
                        <input type="text" class="form-control" id="unidad_economica" name="unidad_economica" value="{{ $anexo2_1->unidad_economica }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="periodo" class="form-label">Periodo</label>
                        <select class="form-control" id="periodo" name="periodo" required>
                            <option value="Enero" {{ $anexo2_1->periodo == 'Enero' ? 'selected' : '' }}>Enero</option>
                            <option value="Febrero" {{ $anexo2_1->periodo == 'Febrero' ? 'selected' : '' }}>Febrero</option>
                            <option value="Marzo" {{ $anexo2_1->periodo == 'Marzo' ? 'selected' : '' }}>Marzo</option>
                            <option value="Abril" {{ $anexo2_1->periodo == 'Abril' ? 'selected' : '' }}>Abril</option>
                            <option value="Mayo" {{ $anexo2_1->periodo == 'Mayo' ? 'selected' : '' }}>Mayo</option>
                            <option value="Junio" {{ $anexo2_1->periodo == 'Junio' ? 'selected' : '' }}>Junio</option>
                            <option value="Julio" {{ $anexo2_1->periodo == 'Julio' ? 'selected' : '' }}>Julio</option>
                            <option value="Agosto" {{ $anexo2_1->periodo == 'Agosto' ? 'selected' : '' }}>Agosto</option>
                            <option value="Septiembre" {{ $anexo2_1->periodo == 'Septiembre' ? 'selected' : '' }}>Septiembre</option>
                            <option value="Octubre" {{ $anexo2_1->periodo == 'Octubre' ? 'selected' : '' }}>Octubre</option>
                            <option value="Noviembre" {{ $anexo2_1->periodo == 'Noviembre' ? 'selected' : '' }}>Noviembre</option>
                            <option value="Diciembre" {{ $anexo2_1->periodo == 'Diciembre' ? 'selected' : '' }}>Diciembre</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" value="{{ $anexo2_1->fecha }}" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="seccion_1" class="form-label">Sección 1</label>
                    <textarea class="form-control" id="seccion_1" name="seccion_1" required>{{ $anexo2_1->seccion_1 }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="seccion_2" class="form-label">Sección 2</label>
                    <textarea class="form-control" id="seccion_2" name="seccion_2" required>{{ $anexo2_1->seccion_2 }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="seccion_3" class="form-label">Sección 3</label>
                    <textarea class="form-control" id="seccion_3" name="seccion_3" required>{{ $anexo2_1->seccion_3 }}</textarea>
                </div>
                <button type="submit" class="btn btn-success">Guardar</button>
                <a href="{{ route('anexo2_1.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('anexo2_1_form').addEventListener('submit', function (e) {
        let valid = true;
        this.querySelectorAll('input[required], select[required], textarea[required]').forEach(function (input) {
            if (!input.value) {
                valid = false;
                input.classList.add('is-invalid');
            } else {
                input.classList.remove('is-invalid');
            }
        });
        if (!valid) {
            e.preventDefault();
        }
    });
});
</script>
@endsection
