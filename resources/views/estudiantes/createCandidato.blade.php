@extends('layouts.app')
@section('title', 'Crear Candidato')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <!-- Encabezado -->
                <x-forms.section-header title="Registro de Estudiante Dual"
                    description="Formulario para registrar a estudiantes que participan en el Modelo de Formación Dual, incluyendo datos personales, académicos, vinculación con la empresa y documentación requerida." />


                <div class="card-body">
                    <!-- Información General -->
                    <form class="pt-3" action="{{ route('estudiantes.candidatos') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <h5 class="section-title fw-bold ">Identificación del Estudiante</h5>
                            <div class="dropdown-divider mb-4"></div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="matricula" class="form-label">Matrícula <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="matricula" name="matricula"
                                        value="{{ old('matricula') }}">
                                    @error('matricula')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="email" class="form-label blo">Correo electrónico institucional <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <span class="input-group-text" style="color:black; height: 100%;">al</span>
                                        </div>
                                        <input type="text" data-tipo="numbers" class="form-control form-control-lg"
                                            id="email" name="email" placeholder="No. Matricula"
                                            value="{{ old('email') }}" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text"
                                                style="color:black; height: 100%;">@utvtol.edu.mx</span>
                                        </div>
                                    </div>
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="name" class="form-label">Nombre(s) <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control uppercase" id="name"
                                            placeholder="Ingrese su(s) nombre(s)" name="name"
                                            value="{{ old('name') }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="apellidoP" class="form-label">Apellido Paterno <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control uppercase" id="apellidoP"
                                            placeholder="Ingrese su apellido paterno" name="apellidoP"
                                            value="{{ old('apellidoP') }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="apellidoM" class="form-label">Apellido Materno <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control uppercase" id="apellidoM"
                                            placeholder="Ingrese su apellido materno" name="apellidoM"
                                            value="{{ old('apellidoM') }}">
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="curp" class="form-label">CURP <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control uppercase" id="curp" name="curp"
                                        value="{{ old('curp') }}">
                                    @error('curp')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="fecha_na" class="form-label">Fecha de Nacimiento <span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control form-control-lg" name="fecha_na"
                                        id="fecha_na" value="{{ old('fecha_na') }}">
                                    @error('fecha_na')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <h5 class="section-title fw-bold ">Información Académica </h5>
                                <div class="dropdown-divider mb-4"></div>

                                <div class="col-md-6 mb-3">
                                    <label for="direccion_id" class="form-label">Dirección de carrera <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" aria-label="Seleccionar Dirección de carrera"
                                        name="direccion_id">
                                        <option selected>Seleccione una opcion</option>
                                        @foreach ($direcciones as $direccion)
                                            <option value="{{ $direccion->id }}" data-direccion="{{ $direccion->id }}">
                                                {{ $direccion->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('direccion_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="carrera_id" class="form-label">Carrera <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" aria-label="Seleccionar Empresa" name="carrera_id"
                                        id="carrera_id">
                                        <option selected>Seleccione una opcion</option>
                                        @foreach ($carreras as $carrera)
                                            <option value="{{ $carrera->id }}"
                                                data-direccion="{{ $carrera->direccion_id }}">
                                                {{ $carrera->grado_academico . ' En ' . $carrera->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('carrera_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="inicio" class="form-label">Fecha de Ingreso <span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control form-control-lg" name="inicio"
                                        id="inicio" value="{{ old('inicio') }}">
                                    @error('inicio')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="fin" class="form-label">Fecha de Egreso <span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control form-control-lg" name="fin"
                                        id="fin" value="{{ old('fin') }}">
                                    @error('fin')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="cuatrimestre" class="form-label">Cuatrimestre aplicable a Dual <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" aria-label="Seleccionar Cuatrimestre"
                                        name="cuatrimestre">
                                        <option selected>Seleccione una opcion</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                    </select>
                                    @error('cuatrimestre')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="status" class="form-label">Situación Dual <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" aria-label="Seleccionar Empresa" name="status">
                                        <option selected>Seleccione una opcion</option>
                                        @foreach ($situation as $carrera)
                                            <option value="{{ $carrera['id'] }}">
                                                {{ $carrera['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>



                            </div>
                            <div class="row">

                                <div class="row">
                                    <h5 class="section-title fw-bold  mt-4">Documentación </h5>
                                    <div class="dropdown-divider mb-4"></div>

                                    <div class="col-md-4 mb-3">
                                        <label for="ine">INE <span class="text-danger">*</span></label>
                                        <input type="file" accept="application/pdf, image/jpeg, image/png"
                                            class="form-control form-control-lg mt-1" id="ine" placeholder="INE"
                                            name="ine" value="{{ old('ine') }}">
                                        @error('ine')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="historial_academico">Historial Academico <span
                                                class="text-danger">(Opccional)</span></label>
                                        <input type="file" accept="application/pdf, image/jpeg, image/png"
                                            class="form-control form-control-lg mt-1" id="historial_academico"
                                            placeholder="historial_academico" name="historial_academico"
                                            value="{{ old('historial_academico') }}">
                                        @error('historial_academico')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3">
                                <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                                    type="submit">Guardar</button>

                                <x-buttons.cancel-button url="{{ route('estudiantes.index') }}" />

                            </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function mostrarInput() {
            var becaValue = document.getElementById('beca').value;
            var becitaInput = document.getElementById('tipoBeca');
            console.log(becaValue)
            if (becaValue == 0) { // Reemplaza 'el_valor_especifico' con el valor específico que deseas comparar
                becitaInput.style.display = 'block';
            } else {
                becitaInput.style.display = 'none';
            }
        }
        $(document).ready(function() {
            // Manejar el cambio en el campo academico_id
            $('#empresa_id').change(function() {
                var mentorId = $(this).val();


                // Realizar la petición AJAX
                $.ajax({
                    type: 'GET',
                    url: `${window.BASE_URL}/mentores/${mentorId}/empresa`,
                    success: function(data) {
                        // Limpiar y actualizar el select de empresas
                        var selectAsesorin = $('select[name="asesorin_id"]');
                        if (data.length > 0) {
                            selectAsesorin.empty();
                            selectAsesorin.append(
                                '<option value="" selected>Seleccione una opción</option>');

                            // Agregar las opciones recibidas en la respuesta AJAX al select
                            $.each(data, function(index, asesorin) {
                                selectAsesorin.append('<option value="' + asesorin.id +
                                    '">' + asesorin.name + '</option>');
                            });
                        } else {
                            selectAsesorin.empty();
                            selectAsesorin.append(
                                '<option value="" selected disabled>No hay asesores industriales disponibles</option>'
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });

        $(document).ready(function() {
            $('#direccion_id').change(function() {
                var direccionId = $(this).val();

                if (direccionId) {
                    // Mostrar los selects ocultos
                    $('#academico_select').show();
                    $('#carrera_select').show();

                    // Filtrar opciones de carreras
                    $('#carrera_id option').each(function() {
                        if ($(this).data('direccion') == direccionId || $(this).val() == "") {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    });

                    // Filtrar opciones de académicos
                    $('#academico_id option').each(function() {
                        if ($(this).data('direccion') == direccionId || $(this).val() == "") {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    });

                } else {
                    // Ocultar selects si no hay dirección seleccionada
                    $('#academico_select').hide();
                    $('#carrera_select').hide();
                }
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            const matriculaInput = document.getElementById("matricula");
            const emailInput = document.getElementById("email");

            matriculaInput.addEventListener("input", function() {
                emailInput.value = matriculaInput.value;
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            const curpInput = document.getElementById("curp");
            const fechaInput = document.getElementById("fecha_na");

            curpInput.addEventListener("input", function() {
                const curp = curpInput.value.toUpperCase();

                if (curp.length >= 10) {
                    const year = curp.substring(4, 6);
                    const month = curp.substring(6, 8);
                    const day = curp.substring(8, 10);

                    // Si el año es mayor a la fecha actual, se asume 1900s, si no 2000s
                    const currentYear = new Date().getFullYear() % 100;
                    const fullYear = parseInt(year) > currentYear ? `19${year}` : `20${year}`;

                    const fechaNacimiento = `${fullYear}-${month}-${day}`;
                    // Validamos si es una fecha real
                    const fechaValida = !isNaN(new Date(fechaNacimiento).getTime());

                    if (fechaValida) {
                        fechaInput.value = fechaNacimiento;
                    }
                }
            });
        });
    </script>
@endsection
