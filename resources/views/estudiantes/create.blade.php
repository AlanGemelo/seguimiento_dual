@extends('layouts.app')
@section('title', 'Crear Estudiante')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <!-- Encabezado -->
                <x-forms.section-header title="Registro de Estudiante Dual"
                    description="Formulario para registrar a estudiantes que participan en el Modelo de Formación Dual, incluyendo datos personales, académicos, vinculación con la empresa y documentación requerida." />


                <div class="card-body">
                    <!-- Información General -->
                    <form class="pt-3" action="{{ route('estudiantes.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <h5 class="section-title fw-bold ">Identificación del Estudiante</h5>
                            <div class="dropdown-divider mb-4"></div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="matricula" class="form-label">Matrícula <span
                                            class="text-danger">*</span></label>
                                    <input type="text" data-tipo="numbers" class="form-control" id="matricula"
                                        name="matricula" value="{{ old('matricula') }}">
                                    @error('matricula')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- 
                                    <div class="col-md-4 mb-3">
                                        <label for="email" class="form-label blo">Correo electrónico institucional <span class="text-danger">*</span></label>

                                    </div> --}}

                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="name" class="form-label">Nombre(s) <span
                                                class="text-danger">*</span></label>
                                        <input type="text" data-tipo="text" class="form-control uppercase" id="name"
                                            placeholder="Ingrese su(s) nombre(s)" name="name"
                                            value="{{ old('name') }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="apellidoP" class="form-label">Apellido Paterno <span
                                                class="text-danger">*</span></label>
                                        <input type="text" data-tipo="text" class="form-control uppercase" id="apellidoP"
                                            placeholder="Ingrese su apellido paterno" name="apellidoP"
                                            value="{{ old('apellidoP') }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="apellidoM" class="form-label">Apellido Materno <span
                                                class="text-danger">*</span></label>
                                        <input type="text" data-tipo="text" class="form-control uppercase" id="apellidoM"
                                            placeholder="Ingrese su apellido materno" name="apellidoM"
                                            value="{{ old('apellidoM') }}">
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="curp" class="form-label">CURP <span class="text-danger">*</span></label>
                                    <input type="text" data-tipo="curp" class="form-control uppercase" id="curp"
                                        name="curp" value="{{ old('curp') }}">
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
                                    <label for="carrera_id" class="form-label">Programa Educativo <span
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
                                    <label for="cuatrimestre" class="form-label">Cuatrimestre aplicable a Dual
                                        <span class="text-danger">*</span></label>
                                    <select class="form-select" aria-label="Seleccionar Cuatrimestre"
                                        name="cuatrimestre">
                                        <option selected>Seleccione una opcion</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
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

                                <div class="col-md-6 mb-3">
                                    <label for="nombre_proyecto" class="form-label">Nombre del Proyecto <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg" id="nombre_proyecto"
                                        placeholder="Integrador" name="nombre_proyecto"
                                        value="{{ old('nombre_proyecto') }}">
                                    @error('nombre_proyecto')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="academico_id" class="form-label">Mentor Academico <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" aria-label="Seleccionar Empresa" name="academico_id"
                                        id="academico_id">
                                        <option selected>Seleccione una opcion</option>
                                        @foreach ($academicos as $mentor)
                                            <option value="{{ $mentor->id }}"
                                                data-direccion="{{ $mentor->direccion_id }}">
                                                {{ $mentor->titulo }}
                                                {{ $mentor->name . ' ' . $mentor->apellidoP . ' ' . $mentor->apellidoM }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('cid')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                            <div class="row">
                                <h5 class="section-title fw-bold  mt-4">Datos de la unidad económica </h5>
                                <div class="droCdown-divider mb-4"></div>


                                <div class="col-md-6 mb-3">
                                    <label for="empresa_id" class="form-label">Empresa aplicable a Dual <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" aria-label="Seleccionar Empresa" name="empresa_id"
                                        id="empresa_id">
                                        <option value="NULL" selected>Seleccione una opcion</option>
                                        @foreach ($empresas as $empresa)
                                            <option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
                                        @endforeach
                                    </select>
                                    @error('empresa_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="asesorin_id" class="form-label">Asesor Industrial <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" aria-label="Seleccionar Empresa" name="asesorin_id"
                                        id="asesorin_id">
                                        <option selected>Seleccione una opcion</option>

                                    </select>
                                    @error('asesorin_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="inicio_dual" class="form-label">Inicio Dual <span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control form-control-lg" name="inicio_dual"
                                        id="inicio_dual" value="{{ old('inicio_dual') }}">
                                    @error('inicio_dual')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="fin_dual" class="form-label">Fin Dual <span
                                            class="text-danger">*</span></label>
                                    <input type=date class="form-control form-control-lg" name="fin" id="fin_dual"
                                        value="{{ old('fin_dual') }}">
                                    @error('fin_dual')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="row">
                                    <h5 class="section-title fw-bold  mt-4">Beneficios </h5>
                                    <div class="dropdown-divider mb-4"></div>
                                    <div class="col-md-6 mb-3">

                                        <label for="beca" class="form-label">Beca Dual <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select" aria-label="Seleccionar Carrera" id="beca"
                                            onchange="mostrarInput()" name="beca">
                                            <option value="nada" selected> Seleccione una opcion</option>
                                            @foreach ($becas as $carrera)
                                                <option value="{{ $carrera['id'] }}">
                                                    {{ $carrera['name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('beca')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3" id="tipoBeca" style="display: none">
                                        <label for="tipoBeca" class="form-label">Apoyo Economico <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select" aria-label="Seleccionar Carrera" name="tipoBeca"
                                            id="selectTipoBeca">
                                            <option value="" selected disabled>Seleccione una opción</option>
                                            @foreach ($tipoBeca as $carrera)
                                                <option value="{{ $carrera['id'] }}">{{ $carrera['name'] }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('tipoBeca')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <h5 class="section-title fw-bold  mt-4">Documentación </h5>
                                <div class="dropdown-divider mb-4"></div>

                                <div class="col-12">
                                    <h6 class="section-subtitle">Documentos Personales</h6>
                                    <div class="dropdown-divider mb-3"></div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="ine">INE <span class="text-danger">*</span></label>
                                    <input type="file" accept="application/pdf"
                                        class="form-control form-control-lg mt-1" id="ine" placeholder="INE"
                                        name="ine" value="{{ old('ine') }}">
                                    @error('ine')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="historial_academico">
                                        Historial Académico
                                        <small class="text-muted text-danger"
                                            style="color: #dc3545 !important; ">(Opcional)</small>
                                    </label>
                                    <input type="file" accept="application/pdf"
                                        class="form-control form-control-lg mt-1" id="historial_academico"
                                        placeholder="historial_academico" name="historial_academico"
                                        value="{{ old('historial_academico') }}">
                                    @error('historial_academico')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="perfil_ingles">Perfil de Inglés
                                        <small class="text-muted text-danger"
                                            style="color: #dc3545 !important; ">(Opcional)</small>
                                    </label>
                                    <input type="file" accept="application/pdf"
                                        class="form-control form-control-lg mt-1" id="perfil_ingles"
                                        placeholder="perfil_ingles" name="perfil_ingles"
                                        value="{{ old('perfil_ingles') }}">
                                    @error('perfil_ingles')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="col-12">
                                    <h6 class="section-subtitle mt-1">Formatos Institucionales</h6>
                                    <div class="dropdown-divider mb-3"></div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="formato51">Formato 5.1 <span class="text-danger">*</span></label>
                                            <input type="file" accept="application/pdf"
                                                class="form-control form-control-lg mt-1" id="formato51" name="formato51"
                                                value="{{ old('formato51') }}">
                                            @error('formato51')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="formato54">Formato 5.4 <span class="text-danger">*</span></label>
                                            <input type="file" accept="application/pdf"
                                                class="form-control form-control-lg mt-1" id="formato54" name="formato54"
                                                value="{{ old('formato54') }}">
                                            @error('formato54')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="formato55">Formato 5.5 <span class="text-danger">*</span></label>
                                            <input type="file" accept="application/pdf"
                                                class="form-control form-control-lg mt-1" id="formato55" name="formato55"
                                                value="{{ old('formato55') }}">
                                            @error('formato55')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12" id="formatosBeca" style="display: none">
                                    <h6 class="section-subtitle mt-1">
                                        Formatos de Beca
                                        <small class="text-muted text-danger" style="color: #dc3545 !important;">
                                            (Solo en caso de aplicar a una beca)
                                        </small>
                                    </h6>
                                    <div class="dropdown-divider mb-3"></div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="formatoA">Formato A <span class="text-danger">*</span></label>
                                            <input type="file" accept="application/pdf"
                                                class="form-control form-control-lg mt-1" id="formatoA" name="formatoA"
                                                value="{{ old('formatoA') }}">
                                            @error('formatoA')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="formatoB">Formato B <span class="text-danger">*</span></label>
                                            <input type="file" accept="application/pdf"
                                                class="form-control form-control-lg mt-1" id="formatoB" name="formatoB"
                                                value="{{ old('formatoB') }}">
                                            @error('formatoB')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="formatoC">Formato C <span class="text-danger">*</span></label>
                                            <input type="file" accept="application/pdf"
                                                class="form-control form-control-lg mt-1" id="formatoC" name="formatoC"
                                                value="{{ old('formatoC') }}">
                                            @error('formatoC')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
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
            var tipoBecaDiv = document.getElementById('tipoBeca');
            var tipoBecaSelect = document.getElementById('selectTipoBeca');
            var formatosDiv = document.getElementById('formatosBeca');

            // Mostrar tipo de beca solo si se selecciona "Si" (valor 0)
            if (becaValue == 0) {
                tipoBecaDiv.style.display = 'block';
                formatosDiv.style.display = 'block';
            } else {
                tipoBecaDiv.style.display = 'none';
                tipoBecaSelect.value = ''; // Limpia el valor si se oculta
                formatosDiv.style.display = 'none';
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
                        console.log('Datos recibidos del servidor:',
                            data); // <- Aquí ves la respuesta completa

                        var selectAsesorin = $('select[name="asesorin_id"]');
                        if (data.length > 0) {
                            selectAsesorin.empty();
                            selectAsesorin.append(
                                '<option value="" selected>Seleccione algo</option>');

                            $.each(data, function(index, asesorin) {
                                selectAsesorin.append(
                                    '<option value="' + asesorin.id + '">' +
                                    asesorin.name + ' ' + asesorin.apellidoP + ' ' +
                                    asesorin.apellidoM +
                                    '</option>'
                                );
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
