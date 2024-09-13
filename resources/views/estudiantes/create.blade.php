@extends("layouts.app")
@section("title", "Crear Estudiante")

@section("content")
    <script src="{{ asset("assets/js/jquery.min.js") }}"></script>
    <div class="row">
        <div class="col-12 grid-margin">
            @if (session("status"))
                <div class="alert alert-danger alert-dismissible text-dark" role="alert">
                    <span class="text-sm"> <a href="javascript:" class="alert-link text-dark">Excelente</a>.
                        {{ session("status") }}.</span>
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
                            <h4 class="card-title">Crear Estudiante Dual</h4>
                            <span class="text-danger">* Son campos requeridos</span>
                            <div class="dropdown-divider"></div>
                            <form class="pt-3" action="{{ route("estudiantes.store") }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        {{-- matricula --}}
                                        <div class="form-group">
                                            <label for="matricula">Matricula <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control form-control-lg" id="matricula"
                                                name="matricula" value="{{ old("matricula") }}">
                                            @error("matricula")
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        {{-- Nombre del estudiante --}}
                                        <div class="form-group">
                                            <label for="name">Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-lg" id="name"
                                                placeholder="Juan Perez Hermenegildo" name="name"
                                                value="{{ old("name") }}">
                                            @error("name")
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        {{-- CURP --}}
                                        <div class="form-group">
                                            <label for="curp">CURP<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-lg" id="curp"
                                                name="curp" value="{{ old("curp") }}">
                                            @error("curp")
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        {{-- Fecha de nacimiento --}}
                                        <div class="form-group">
                                            <label for="fecha_na">Fecha de Nacimiento <span
                                                    class="text-danger">*</span></label>
                                            <input type="date" class="form-control form-control-lg" name="fecha_na"
                                                id="fecha_na" value="{{ old("fecha_na") }}">
                                            @error("fecha_na")
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
                                            </select>
                                            @error("cuatrimestre")
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        {{-- Proyecto Dual --}}
                                        <div class="form-group">
                                            <label for="nombre_proyecto">Nombre del Proyecto <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-lg" id="nombre_proyecto"
                                                placeholder="Integrador" name="nombre_proyecto"
                                                value="{{ old("nombre_proyecto") }}">
                                            @error("nombre_proyecto")
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        {{-- Seleccionar empresa --}}
                                        <div class="form-group">
                                            <label for="empresa_id" class="form-label">Empresa <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select" aria-label="Seleccionar Empresa" name="empresa_id"
                                                id="empresa_id">
                                                <option value="NULL" selected>Seleccione una opcion</option>
                                                @foreach ($empresas as $empresa)
                                                    <option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
                                                @endforeach
                                            </select>
                                            @error("empresa_id")
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        {{-- Seleccionar Acesor industrial --}}
                                        <div class="form-group">
                                            <label for="asesorin_id" class="form-label">Acesor Indutrial <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select" aria-label="Seleccionar Empresa"
                                                name="asesorin_id" id="asesorin_id">
                                                <option selected>Seleccione una opcion</option>
                                            </select>
                                            @error("asesorin_id")
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
                                            @error("direccion_id")
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- Seleccionar Mentor academico --}}
                                        <div class="form-group" id="academico_select" style="display: none;">
                                            <label for="academico_id" class="form-label">Mentor Academico <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select" aria-label="Seleccionar Empresa"
                                                name="academico_id" id="academico_id">
                                                <option selected>Seleccione una opcion</option>
                                                @foreach ($academico as $mentor)
                                                    <option value="{{ $mentor->id }}"
                                                        data-direccion="{{ $mentor->direccion_id }}">
                                                        {{ $mentor->titulo }} {{ $mentor->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error("cid")
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
                                                        data-direccion="{{ $carrera->direccion_id }}">
                                                        {{ $carrera->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error("carrera_id")
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{--  Crgar documento de Formart A --}}
                                        <div class="form-group">
                                            <label for="formato51">Formato 5.1<span class="text-danger">*</span></label>
                                            <input type="file" class="form-control form-control-lg" id="formato51"
                                                placeholder="formato51" name="formato51" value="{{ old("formato51") }}">
                                            @error("formato51")
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="formato54">Formato 5.4<span class="text-danger">*</span></label>
                                            <input type="file" class="form-control form-control-lg" id="formato54"
                                                placeholder="formato54" name="formato54" value="{{ old("formato54") }}">
                                            @error("formato54")
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        {{--  Crgar documento de Formart A --}}
                                        <div class="form-group">
                                            <label for="formato55">Formato 5.5<span class="text-danger">*</span></label>
                                            <input type="file" class="form-control form-control-lg" id="formato55"
                                                placeholder="formato55" name="formato55" value="{{ old("formato55") }}">
                                            @error("formato55")
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        {{-- Seleccionar Docencia del estudiante --}}

                                        {{-- Inicio Dual --}}
                                        <div class="form-group">
                                            <label for="inicio_dual">Inicio Dual <span
                                                    class="text-danger">*</span></label>
                                            <input type="date" class="form-control form-control-lg" name="inicio_dual"
                                                id="inicio_dual" value="{{ old("inicio_dual") }}">
                                            @error("inicio_dual")
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        {{-- Final Dual --}}
                                        <div class="form-group">
                                            <label for="fin_dual">Fin Dual <span class="text-danger">*</span></label>
                                            <input type=date class="form-control form-control-lg" name="fin_dual"
                                                id="fin_dual" value="{{ old("fin_dual") }}">
                                            @error("fin_dual")
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        {{-- Fecha de Ingreso --}}
                                        <div class="form-group">
                                            <label for="inicio">Fecha de Ingreso <span
                                                    class="text-danger">*</span></label>
                                            <input type="date" class="form-control form-control-lg" name="inicio"
                                                id="inicio" value="{{ old("inicio") }}">
                                            @error("inicio")
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        {{-- Fecha de egreso --}}
                                        <div class="form-group">
                                            <label for="fin">Fecha de Egreso <span
                                                    class="text-danger">*</span></label>
                                            <input type=date class="form-control form-control-lg" name="fin"
                                                id="fin" value="{{ old("fin") }}">
                                            @error("fin")
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
                                                    <option value="{{ $carrera["id"] }}">
                                                        {{ $carrera["name"] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error("status")
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- Cargar documento INE --}}
                                        <div class="form-group">
                                            <label for="ine">INE <span class="text-danger">*</span></label>
                                            <input type="file" class="form-control form-control-lg" id="ine"
                                                placeholder="INE" name="ine" value="{{ old("ine") }}">
                                            @error("ine")
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- Cargar documento de Historial Academico --}}
                                        <div class="form-group">
                                            <label for="historial_academico">Historial Academico<span
                                                    class="text-danger">*</span></label>
                                            <input type="file" class="form-control form-control-lg"
                                                id="historial_academico" placeholder="historial_academico"
                                                name="historial_academico" value="{{ old("historial_academico") }}">
                                            @error("historial_academico")
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        {{--  Cargar documento de Formart A --}}
                                        <div class="form-group">
                                            <label for="formatoA">Formato A<span class="text-danger">*</span></label>
                                            <input type="file" class="form-control form-control-lg" id="formatoA"
                                                placeholder="formatoA" name="formatoA" value="{{ old("formatoA") }}">
                                            @error("formatoA")
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{--  Cargar documento de documento de Formart B --}}
                                        <div class="form-group">
                                            <label for="formatoB">Formato B<span class="text-danger">*</span></label>
                                            <input type="file" class="form-control form-control-lg" id="formatoB"
                                                placeholder="formatoB" name="formatoB" value="{{ old("formatoB") }}">
                                            @error("formatoB")
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        {{--  Cargar documento de documento de Formart C --}}
                                        <div class="form-group">
                                            <label for="formatoC">Formato C<span class="text-danger">*</span></label>
                                            <input type="file" class="form-control form-control-lg" id="formatoC"
                                                placeholder="formatoC" name="formatoC" value="{{ old("formatoC") }}">
                                            @error("formatoC")
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{--  Crgar documento de Perfil de Ingles --}}
                                        <div class="form-group">
                                            <label for="perfil_ingles">Perfil de Ingles<span
                                                    class="text-danger">*</span></label>
                                            <input type="file" class="form-control form-control-lg" id="perfil_ingles"
                                                placeholder="perfil_ingles" name="perfil_ingles"
                                                value="{{ old("perfil_ingles") }}">
                                            @error("perfil_ingles")
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="beca" class="form-label">Beca Dual <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select" aria-label="Seleccionar Carrera" id="beca"
                                                onchange="mostrarInput()" name="beca">
                                                <option value="nada" selected> Seleccione una opcion</option>
                                                @foreach ($becas as $carrera)
                                                    <option value="{{ $carrera["id"] }}">
                                                        {{ $carrera["name"] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error("beca")
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group" id="tipoBeca" style="display: none">
                                            <label for="tipoBeca" class="form-label">Apoyo Economico <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select" aria-label="Seleccionar Carrera" name="tipoBeca">

                                                @foreach ($tipoBeca as $carrera)
                                                    <option value="{{ $carrera["id"] }}">{{ $carrera["name"] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error("tipoBeca")
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
