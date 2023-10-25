@extends('layouts.app')
@section('title', 'Crear Estudiante')

@section('content')
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
                            <h4 class="card-title">Crear Estudiante Dual</h4>
                            <span class="text-danger">* Son campos requeridos</span>
                            <div class="dropdown-divider"></div>
                            <form class="pt-3" action="{{ route('estudiantes.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                {{-- matricula --}}
                                <div class="form-group">
                                    <label for="matricula">Matricula <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control form-control-lg" id="matricula"
                                           name="matricula" value="{{ old('matricula') }}">
                                    @error('matricula')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- Nombre del estudiante --}}
                                <div class="form-group">
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg" id="name"
                                           placeholder="Juan Perez Hermenegildo" name="name" value="{{ old('name') }}">
                                    @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- CURP --}}
                                <div class="form-group">
                                    <label for="curp">CURP<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg" id="curp" name="curp"
                                           value="{{ old('curp') }}">
                                    @error('curp')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- Fecha de nacimiento --}}
                                <div class="form-group">
                                    <label for="fecha_na">Fecha de Nacimiento <span class="text-danger">*</span></label>
                                    <div id="datepicker-popup" class="input-group date datepicker navbar-date-picker">
                                        <span class="input-group-addon input-group-prepend border-right">
                                            <span class="icon-calendar input-group-text calendar-icon"></span>
                                        </span>
                                        <input type="text" class="form-control" name="fecha_na" id="fecha_na"
                                               value="{{ old('fecha_na') }}">
                                    </div>
                                </div>
                                {{-- Cuatrimestre aplicable a Dual --}}
                                <div class="form-group">
                                    <label for="cuatrimestre">Cuatrimestre <span class="text-danger">*</span></label>
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
                                {{-- Inicio Dual --}}
                                <div class="form-group">
                                    <label for="inicio_dual">Inicio Dual <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="inicio_dual" id="inicio_dual"
                                           value="{{ old('inicio_dual') }}">
                                </div>
                                {{-- Final Dual --}}
                                <div class="form-group">
                                    <label for="fin_dual">Fin Dual <span class="text-danger">*</span></label>
                                    <input type=date class="form-control" name="fin_dual" id="fin_dual"
                                           value="{{ old('fin_dual') }}">
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
                                {{-- Cargar documento Minutas --}}
                                <div class="form-group">
                                    <label for="minutas">Minutas <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control form-control-lg" id="minutas"
                                           placeholder="minutas" name="minutas" value="{{ old('minutas') }}">
                                    @error('minutas')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- Cargar documento de Aceptación --}}
                                <div class="form-group">
                                    <label for="carta_acp">Carta de Aceptación <span
                                            class="text-danger">*</span></label>
                                    <input type="file" class="form-control form-control-lg" id="carta_acp"
                                           placeholder="carta_acp" name="carta_acp" value="{{ old('carta_acp') }}">
                                    @error('carta_acp')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- Cargar documento de Plan-Form --}}
                                <div class="form-group">
                                    <label for="plan_form">Plan Form<span class="text-danger">*</span></label>
                                    <input type="file" class="form-control form-control-lg" id="plan_form"
                                           placeholder="plan_form" name="plan_form" value="{{ old('plan_form') }}">
                                    @error('plan_form')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- Cargar documento de Historial Academico --}}
                                <div class="form-group">
                                    <label for="historial_academico">Historial Academico<span
                                            class="text-danger">*</span></label>
                                    <input type="file" class="form-control form-control-lg" id="historial_academico"
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
                                {{-- Seleccionar empresa --}}
                                <div class="form-group">
                                    <label for="empresa_id" class="form-label">Empresa <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" aria-label="Seleccionar Empresa" name="empresa_id">
                                        <option selected>Seleccione una opcion</option>
                                        @foreach ($empresas as $empresa)
                                            <option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
                                        @endforeach
                                    </select>
                                    @error('empresa_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- Seleccionar Mentor academico--}}
                                <div class="form-group">
                                    <label for="academico_id" class="form-label">Mentor Academico <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" aria-label="Seleccionar Empresa" name="academico_id">
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
                                {{-- Seleccionar Acesor industrial--}}
                                <div class="form-group">
                                    <label for="asesorin_id" class="form-label">Acesor Indutrial <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" aria-label="Seleccionar Empresa" name="asesorin_id">
                                        <option selected>Seleccione una opcion</option>
                                        @foreach ($industrial as $mentorIndustrial)
                                            <option
                                                value="{{ $mentorIndustrial->id }}">{{ $mentorIndustrial->titulo }} {{ $mentorIndustrial->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('asesorin_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- Seleccionar Carrera del estudiante--}}
                                <div class="form-group">
                                    <label for="carrera_id" class="form-label">Carrera <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" aria-label="Seleccionar Empresa" name="carrera_id">
                                        <option selected>Seleccione una opcion</option>
                                        @foreach ($carreras as $carrera)
                                            <option value="{{ $carrera->id }}">{{ $carrera->nombre }}</option>
                                        @endforeach
                                    </select>
                                    @error('carrera_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- Boton par enviar el formulario --}}
                                <div class="mt-3">
                                    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                                            type="submit">Guardar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
