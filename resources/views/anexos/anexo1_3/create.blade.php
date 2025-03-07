@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Anexo 1.3 -  Formato de Registro de Interesados de UE y Estudiantes ED</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('anexo1_3.store') }}" method="POST" id="anexo1_3_form">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="fecha_realizacion" class="form-label">Fecha de Realización</label>
                        <input type="date" class="form-control @error('fecha_realizacion') is-invalid @enderror" id="fecha_realizacion" name="fecha_realizacion" required value="{{ old('fecha_realizacion') }}">
                        @error('fecha_realizacion')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="lugar" class="form-label">Lugar</label>
                        <input type="text" class="form-control @error('lugar') is-invalid @enderror" id="lugar" name="lugar" required value="{{ old('lugar') }}">
                        @error('lugar')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="razon_social" class="form-label">Razón Social</label>
                        <input type="text" class="form-control @error('razon_social') is-invalid @enderror" id="razon_social" name="razon_social" required value="{{ old('razon_social') }}">
                        @error('razon_social')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="rfc" class="form-label">RFC</label>
                        <input type="text" class="form-control @error('rfc') is-invalid @enderror" id="rfc" name="rfc" required pattern="[A-Z0-9]{13}" value="{{ old('rfc') }}">
                        @error('rfc')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="domicilio" class="form-label">Domicilio</label>
                        <input type="text" class="form-control @error('domicilio') is-invalid @enderror" id="domicilio" name="domicilio" required value="{{ old('domicilio') }}">
                        @error('domicilio')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="nombre_representante" class="form-label">Nombre del Representante</label>
                        <input type="text" class="form-control @error('nombre_representante') is-invalid @enderror" id="nombre_representante" name="nombre_representante" required value="{{ old('nombre_representante') }}">
                        @error('nombre_representante')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="cargo_representante" class="form-label">Cargo del Representante</label>
                        <input type="text" class="form-control @error('cargo_representante') is-invalid @enderror" id="cargo_representante" name="cargo_representante" required value="{{ old('cargo_representante') }}">
                        @error('cargo_representante')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" class="form-control @error('telefono') is-invalid @enderror" id="telefono" name="telefono" required pattern="\d{10}" value="{{ old('telefono') }}">
                        @error('telefono')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="correo_electronico" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control @error('correo_electronico') is-invalid @enderror" id="correo_electronico" name="correo_electronico" required value="{{ old('correo_electronico') }}">
                        @error('correo_electronico')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="actividad_economica" class="form-label">Actividad Económica</label>
                        <input type="text" class="form-control @error('actividad_economica') is-invalid @enderror" id="actividad_economica" name="actividad_economica" required value="{{ old('actividad_economica') }}">
                        @error('actividad_economica')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="numero_empleados" class="form-label">Número de Empleados</label>
                        <input type="number" class="form-control @error('numero_empleados') is-invalid @enderror" id="numero_empleados" name="numero_empleados" required value="{{ old('numero_empleados') }}">
                        @error('numero_empleados')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="participacion_anterior" class="form-label">Participación Anterior</label>
                        <input type="hidden" name="participacion_anterior" value="0">
                        <input type="checkbox" class="form-check-input" id="participacion_anterior" name="participacion_anterior" value="1" {{ old('participacion_anterior') ? 'checked' : '' }}>
                    </div>
                </div>
                <div class="row mb-3" id="motivo_no_participacion_row" style="display: none;">
                    <div class="col-md-12">
                        <label for="motivo_no_participacion" class="form-label">Motivo de No Participación</label>
                        <textarea class="form-control @error('motivo_no_participacion') is-invalid @enderror" id="motivo_no_participacion" name="motivo_no_participacion">{{ old('motivo_no_participacion') }}</textarea>
                        @error('motivo_no_participacion')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="interes_participar" class="form-label">Interés en Participar</label>
                        <input type="hidden" name="interes_participar" value="0">
                        <input type="checkbox" class="form-check-input" id="interes_participar" name="interes_participar" value="1" {{ old('interes_participar') ? 'checked' : '' }}>
                    </div>
                    <div class="col-md-6" id="numero_estudiantes_row" style="display: none;">
                        <label for="numero_estudiantes" class="form-label">Número de Estudiantes</label>
                        <input type="number" class="form-control @error('numero_estudiantes') is-invalid @enderror" id="numero_estudiantes" name="numero_estudiantes" value="{{ old('numero_estudiantes') }}">
                        @error('numero_estudiantes')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3" id="motivo_no_interes_row" style="display: none;">
                    <div class="col-md-12">
                        <label for="motivo_no_interes" class="form-label">Motivo de No Interés</label>
                        <textarea class="form-control @error('motivo_no_interes') is-invalid @enderror" id="motivo_no_interes" name="motivo_no_interes">{{ old('motivo_no_interes') }}</textarea>
                        @error('motivo_no_interes')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="informacion_clara" class="form-label">Información Clara</label>
                        <input type="hidden" name="informacion_clara" value="0">
                        <input type="checkbox" class="form-check-input" id="informacion_clara" name="informacion_clara" value="1" required {{ old('informacion_clara') ? 'checked' : '' }}>
                    </div>
                    <div class="col-md-6">
                        <label for="comentarios_adicionales" class="form-label">Comentarios Adicionales</label>
                        <textarea class="form-control @error('comentarios_adicionales') is-invalid @enderror" id="comentarios_adicionales" name="comentarios_adicionales">{{ old('comentarios_adicionales') }}</textarea>
                        @error('comentarios_adicionales')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="quien_elaboro_id" class="form-label">Quien Elaboró</label>
                        <select class="form-control @error('quien_elaboro_id') is-invalid @enderror" id="quien_elaboro_id" name="quien_elaboro_id" required>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ auth()->user()->id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                        @error('quien_elaboro_id')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Guardar</button>
                <a href="{{ route('anexo1_3.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>

<!-- Botón de Ayuda -->
<button type="button" class="btn btn-help" onclick="openHelpModal()" style="position: fixed; bottom: 20px; right: 20px;">
    ¿Necesitas ayuda? 🔍
</button>

<!-- Modal de Ayuda -->
<div id="helpModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeHelpModal()">&times;</span>
        <h2>Guía de Referencias para el Anexo 1.3</h2>
        <ol>
            <li><strong>Referencia 1:</strong> Registrar en qué sitio se llevó a cabo la actividad (salón, auditorio, instalaciones externas, etc.).</li>
            <li><strong>Referencia 2:</strong> Registrar el folio consecutivo correspondiente.</li>
            <li><strong>Referencia 3:</strong> Colocar el nombre completo de quien realiza la actividad.</li>
            <!-- Continuar con las referencias 4 a 17 -->
        </ol>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('participacion_anterior').addEventListener('change', function () {
        document.getElementById('motivo_no_participacion_row').style.display = this.checked ? 'none' : 'block';
    });

    document.getElementById('interes_participar').addEventListener('change', function () {
        document.getElementById('numero_estudiantes_row').style.display = this.checked ? 'block' : 'none';
        document.getElementById('motivo_no_interes_row').style.display = this.checked ? 'none' : 'block';
    });

    document.getElementById('anexo1_3_form').addEventListener('submit', function (e) {
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

function openHelpModal() {
    document.getElementById('helpModal').style.display = 'block';
}

function closeHelpModal() {
    document.getElementById('helpModal').style.display = 'none';
}

// Cerrar modal al hacer clic fuera de él
window.onclick = function(event) {
    var modal = document.getElementById('helpModal');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}
</script>

<style>
    .is-invalid {
        border-color: red;
    }
    .invalid-feedback {
        color: red;
    }
    .modal-content {
        background-color: #fefefe;
        margin: 5% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        border-radius: 10px;
        animation: fadeIn 0.5s;
    }
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }
    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
    .btn-help {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 50px;
        font-size: 16px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    }
    .btn-help:hover {
        background-color: #0056b3;
    }
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
</style>
@endsection
