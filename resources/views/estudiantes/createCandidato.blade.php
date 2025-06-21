@extends('layouts.app')
@section('title', 'Crear Candidato')

@section('content')
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <div class="row">
        <div class="col-12 grid-margin">
            @if (session('status'))
                <div class="alert alert-danger alert-dismissible text-dark" role="alert">
                    <span class="text-sm"> <a href="javascript:" class="alert-link text-dark">Excelente</a>.
                        {{ session('status') }}.</span>
                    <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Crear Candidato Dual</h4>
                            <span class="text-danger">* Son campos requeridos</span>
                            <div class="dropdown-divider"></div>
                            <form class="pt-3" action="{{ route('estudiantes.candidatos') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        {{-- matricula --}}
                                        <div class="form-group">
                                            <label for="matricula">Matricula <span class="text-danger">*</span></label>
                                            <input type="text" data-tipo="numbers" class="form-control form-control-lg"
                                                id="matricula" name="matricula" value="{{ old('matricula') }}">
                                            @error('matricula')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        {{-- Nombre del estudiante --}}
                                        <div class="form-group">
                                            <label for="name">Nombre(s) <span class="text-danger">*</span></label>
                                            <input type="text" data-tipo="text"
                                                class="form-control form-control-lg uppercase" id="name"
                                                placeholder="Ingrese su(s) nombre(s)" name="name"
                                                value="{{ old('name') }}">
                                            @error('name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="apellidoP">Apellido Paterno <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" data-tipo="text"
                                                class="form-control form-control-lg uppercase" id="apellidoP"
                                                placeholder="Ingrese su apellido paterno" name="apellidoP"
                                                value="{{ old('apellidoP') }}">
                                            @error('apellidoP')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="apellidoM">Apellido Materno <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" data-tipo="text"
                                                class="form-control form-control-lg uppercase" id="apellidoM"
                                                placeholder="Ingrese su apellido materno" name="apellidoM"
                                                value="{{ old('apellidoM') }}">
                                            @error('apellidoM')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        {{-- CURP --}}
                                        <div class="form-group">
                                            <label for="curp">CURP<span class="text-danger">*</span></label>
                                            <input type="text" data-tipo="curp"
                                                class="form-control form-control-lg uppercase" id="curp" name="curp"
                                                value="{{ old('curp') }}">
                                            @error('curp')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        {{-- Fecha de nacimiento --}}
                                        <div class="form-group">
                                            <label for="fecha_na">Fecha de Nacimiento <span
                                                    class="text-danger">*</span></label>
                                            <input type="date" class="form-control form-control-lg" name="fecha_na"
                                                id="fecha_na" value="{{ old('fecha_na') }}">
                                            @error('fecha_na')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        {{-- Cuatrimestre aplicable a Dual --}}
                                        <div class="form-group">
                                            <label for="cuatrimestre">Cuatrimestre <span
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
                                            </select>
                                            @error('cuatrimestre')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="direccion_id" class="form-label">Direccion de Carrera <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select" aria-label="Seleccionar Empresa"
                                                name="direccion_id" id="direccion_id">
                                                <option selected>Seleccione una opcion</option>
                                                @foreach ($direcciones as $direccion)
                                                    <option value="{{ $direccion->id }}">{{ $direccion->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('direccion_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        {{-- Seleccionar Carrera del estudiante --}}
                                        <div class="form-group" id="carrera_select" style="display: none;">
                                            <label for="carrera_id" class="form-label">Carrera <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select" aria-label="Seleccionar Empresa"
                                                name="carrera_id" id="carrera_id">
                                                <option selected>Seleccione una opcion</option>
                                                @foreach ($carreras as $carrera)
                                                    <option value="{{ $carrera->id }}"
                                                        data-direccion="{{  $carrera->direccion_id }}">
                                                        {{ $carrera->grado_academico . ' en ' . $carrera->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('carrera_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        {{-- Email Estudiante --}}

                                        <div class="form-group">
                                            <label for="email">Escribe tu dirección de correo <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"
                                                        style="color:black; height: 100%;">al</span>
                                                </div>
                                                <input type="text" data-tipo="numbers"
                                                    class="form-control form-control-lg" id="email" name="email"
                                                    placeholder="No. Matricula" value="{{ old('email') }}" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text"
                                                        style="color:black; height: 100%;">@utvtol.edu.mx</span>
                                                </div>
                                            </div>
                                            @error('email')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>


                                        {{-- Fecha de Ingreso --}}
                                        <div class="form-group">
                                            <label for="inicio">Fecha de Ingreso <span
                                                    class="text-danger">*</span></label>
                                            <input type="date" class="form-control form-control-lg" name="inicio"
                                                id="inicio" value="{{ old('inicio') }}">
                                            @error('inicio')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        {{-- Fecha de egreso --}}
                                        <div class="form-group">
                                            <label for="fin">Fecha de Egreso <span
                                                    class="text-danger">*</span></label>
                                            <input type=date class="form-control form-control-lg" name="fin"
                                                id="fin" value="{{ old('fin') }}">
                                            @error('fin')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- Estatus --}}
                                        <div class="form-group">
                                            <label for="status" class="form-label">Situacion Dual <span
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

                                        {{-- Cargar documento INE --}}
                                        <div class="form-group">
                                            <label for="ine">INE <span class="text-danger">*</span></label>
                                            <input type="file" class="form-control form-control-lg" id="ine"
                                                placeholder="INE" name="ine" value="{{ old('ine') }}">
                                            @error('ine')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- Cargar documento de Historial Academico --}}
                                       <p  class="h6 bg-green-700">(Opccional)</p>
                                        <div class="form-group">
                                            <label for="historial_academico">Historial Academico</label>
                                            <input type="file" class="form-control form-control-lg"
                                                id="historial_academico" placeholder="historial_academico"
                                                name="historial_academico" value="{{ old('historial_academico') }}">
                                            @error('historial_academico')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>



                                </div>
                                {{-- Boton par enviar el formulario --}}
                                <div class="mt-3">
                                    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                                        type="submit">Guardar
                                    </button>

                                    <x-back-button url="{{ route('estudiantes.index') }}"/>   
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script type="text/javascript">
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
                    url: '/mentores/' + mentorId + '/empresa',
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
    </script>
@endsection
