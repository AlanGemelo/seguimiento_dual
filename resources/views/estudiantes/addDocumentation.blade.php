@extends('layouts.app')
@section('title', 'Editar Estudiante')

@section('content')
    <script src="{{ asset('assets/js/jquery.min.js')}}"></script>
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
                            <h4 class="card-title">Documentacion del Estudiante Dual</h4>
                            <span class="text-danger">* Son campos requeridos</span>
                            <div class="dropdown-divider"></div>
                            <form class="pt-3" action="{{ route('estudiantes.updateForm') }}" method="PATCH"
                                 enctype="multipart/form-data" >
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        {{-- Proyecto Dual --}}
                                        <div class="form-group">
                                            <label for="nombre_proyecto">Nombre del Proyecto <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-lg" id="nombre_proyecto"
                                                   placeholder="Integrador" name="nombre_proyecto"
                                                   value="{{ old('nombre_proyecto') }}">
                                            @error('nombre_proyecto')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        {{-- Seleccionar empresa --}}
                                        <div class="form-group">
                                            <label for="empresa_id" class="form-label">Empresa <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select" aria-label="Seleccionar Empresa"
                                                    name="empresa_id" id="empresa_id">
                                                <option selected>Seleccione una opcion</option>
                                                @foreach ($empresas as $empresa)
                                                    <option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
                                                @endforeach
                                            </select>
                                            @error('empresa_id')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        {{-- Seleccionar Acesor industrial--}}
                                        <div class="form-group">
                                            <label for="asesorin_id" class="form-label">Acesor Indutrial <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select" aria-label="Seleccionar Empresa"
                                                    name="asesorin_id" id="asesorin_id">
                                                <option selected>Seleccione una opcion</option>
                                            </select>
                                            @error('asesorin_id')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        {{-- Seleccionar Mentor academico--}}
                                        <div class="form-group">
                                            <label for="academico_id" class="form-label">Mentor Academico <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select" aria-label="Seleccionar Empresa"
                                                    name="academico_id">
                                                <option selected>Seleccione una opcion</option>
                                                @foreach ($academico as $user)
                                                    <option
                                                        value="{{ $user->id }}">{{ $user->titulo }} {{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('academico_id')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                       
                                    <div class="col-md-6">
                                        {{-- Inicio Dual --}}
                                        <div class="form-group">
                                            <label for="inicio_dual">Inicio Dual <span
                                                    class="text-danger">*</span></label>
                                            <input type="date" class="form-control form-control-lg" name="inicio_dual" id="inicio_dual"
                                                   value="{{ old('inicio_dual') }}">
                                            @error('inicio_dual')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        {{-- Final Dual --}}
                                        <div class="form-group">
                                            <label for="fin_dual">Fin Dual <span class="text-danger">*</span></label>
                                            <input type=date class="form-control form-control-lg" name="fin_dual" id="fin_dual"
                                                   value="{{ old('fin_dual') }}">
                                            @error('fin_dual')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        {{-- Cargar documento de Aceptación --}}
                                        <div class="form-group">
                                            <label for="carta_acp">Carta de Aceptación <span
                                                    class="text-danger">*</span></label>
                                            <input type="file" class="form-control form-control-lg" id="carta_acp"
                                                   placeholder="carta_acp" name="carta_acp"
                                                   value="{{ old('carta_acp') }}">
                                            @error('carta_acp')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                         {{-- Cargar documento Minutas --}}
                                        <div class="form-group">
                                            <label for="minutas">Minutas <span class="text-danger">*</span></label>
                                            <input type="file" class="form-control form-control-lg" id="minutas"
                                                   placeholder="minutas" name="minutas" value="{{ old('minutas') }}">
                                            @error('minutas')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                       
                                        {{-- Cargar documento de Plan-Form --}}
                                        <div class="form-group">
                                            <label for="plan_form">Plan Formacion<span class="text-danger">*</span></label>
                                            <input type="file" class="form-control form-control-lg" id="plan_form"
                                                   placeholder="plan_form" name="plan_form"
                                                   value="{{ old('plan_form') }}">
                                            @error('plan_form')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        {{-- Cargar documento de Historial Academico --}}
                                        <div class="form-group">
                                            <label for="historial_academico">Reporte Dual<span
                                                    class="text-danger">*</span></label>
                                            <input type="file" class="form-control form-control-lg"
                                                   id="historial_academico"
                                                   placeholder="historial_academico" name="historial_academico"
                                                   value="{{ old('historial_academico') }}">
                                            @error('historial_academico')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        {{--  Crgar documento de Perfil de Ingles --}}
                                        <div class="form-group">
                                            <label for="perfil_ingles">Perfil de inglés<span
                                                    class="text-danger">*</span></label>
                                            <input type="file" class="form-control form-control-lg" id="perfil_ingles"
                                                   placeholder="perfil_ingles" name="perfil_ingles"
                                                   value="{{ old('perfil_ingles') }}">
                                            @error('perfil_ingles')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="evaluacion_form">Evaluación de Formación<span
                                                    class="text-danger">*</span></label>
                                            <input type="file" class="form-control form-control-lg" id="evaluacion_form"
                                                   placeholder="evaluacion_form" name="evaluacion_form"
                                                   value="{{ old('evaluacion_form') }}">
                                            @error('evaluacion_form')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- Boton par enviar el formulario --}}
                                    <div class="mt-3">
                                        <button
                                            class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
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
    <script type="text/javascript">
        $(document).ready(function () {
            // Manejar el cambio en el campo academico_id
            $('#empresa_id').change(function () {
                var mentorId = $(this).val();


                // Realizar la petición AJAX
                $.ajax({
                    type: 'GET',
                    url: 'http://162.240.99.108/~dualticedu/mentores/' + mentorId + '/empresa',
                    success: function (data) {
                        // Limpiar y actualizar el select de empresas
                            var selectAsesorin = $('select[name="asesorin_id"]');
                        if (data.length > 0) {
                            selectAsesorin.empty();
                            selectAsesorin.append('<option value="" selected>Seleccione una opción</option>');

                            // Agregar las opciones recibidas en la respuesta AJAX al select
                            $.each(data, function (index, asesorin) {
                                selectAsesorin.append('<option value="' + asesorin.id + '">' + asesorin.name + '</option>');
                            });
                        }
                        else {
                            selectAsesorin.empty();
                            selectAsesorin.append('<option value="" selected disabled>No hay asesores industriales disponibles</option>');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endsection
