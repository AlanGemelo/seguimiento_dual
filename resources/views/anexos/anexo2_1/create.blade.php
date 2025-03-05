@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Anexo 2.1 - Evaluación y Selección de la UE</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('anexo2_1.store') }}" method="POST" id="anexo2_1_form">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="unidad_economica" class="form-label">Unidad Económica</label>
                        <input type="text" class="form-control" id="unidad_economica" name="unidad_economica" required>
                    </div>
                    <div class="col-md-6">
                        <label for="periodo" class="form-label">Periodo</label>
                        <select class="form-control" id="periodo" name="periodo" required>
                            <option value="Enero">Enero</option>
                            <option value="Febrero">Febrero</option>
                            <option value="Marzo">Marzo</option>
                            <option value="Abril">Abril</option>
                            <option value="Mayo">Mayo</option>
                            <option value="Junio">Junio</option>
                            <option value="Julio">Julio</option>
                            <option value="Agosto">Agosto</option>
                            <option value="Septiembre">Septiembre</option>
                            <option value="Octubre">Octubre</option>
                            <option value="Noviembre">Noviembre</option>
                            <option value="Diciembre">Diciembre</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="seccion_1" class="form-label">Sección 1</label>
                    <textarea class="form-control" id="seccion_1" name="seccion_1" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="seccion_2" class="form-label">Sección 2</label>
                    <textarea class="form-control" id="seccion_2" name="seccion_2" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="seccion_3" class="form-label">Sección 3</label>
                    <textarea class="form-control" id="seccion_3" name="seccion_3" required></textarea>
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
