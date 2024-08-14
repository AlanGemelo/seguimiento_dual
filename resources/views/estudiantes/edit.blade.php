@extends('layouts.app')
@section('title', 'Editar Estudiante')

@section('content')
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Editar Estudiante Dual</h4>
                            <span class="text-danger">* Son campos requeridos</span>
                            <div class="dropdown-divider"></div>
                            <form class="pt-3"
                                action="{{ route('estudiantes.update', Vinkla\Hashids\Facades\Hashids::encode($estudiante->matricula)) }}"
                                method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="matricula">Matricula <span class="text-danger">*</span></label>
                                            <input disabled type="number" class="form-control form-control-lg" id="matricula"
                                                name="matricula" value="{{ old('matricula', $estudiante->matricula) }}">
                                            @error('matricula')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Name <span class="text-danger">*</span></label>
                                            <input disabled type="text" class="form-control form-control-lg" id="name"
                                                placeholder="Juan Perez Hermenegildo" name="name"
                                                value="{{ old('name', $estudiante->name) }}">
                                            @error('name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="curp">CURP <span class="text-danger">*</span></label>
                                            <input disabled type="text" class="form-control form-control-lg" id="curp"
                                                name="curp" value="{{ old('curp', $estudiante->curp) }}">
                                            @error('curp')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="fecha_na">Fecha de Nacimiento <span
                                                    class="text-danger">*</span></label>
                                            <input disabled type="date" class="form-control form-control-lg" name="fecha_na"
                                                id="fecha_na" value="{{ old('fecha_na', $estudiante->fecha_na) }}">
                                            @error('fecha_na')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cuatrimestre">Cuatrimestre <span
                                                    class="text-danger">*</span></label>
                                            <select  disabled class="form-select" aria-label="Seleccionar Cuatrimestre"
                                                name="cuatrimestre">
                                                <option selected>Seleccionar Cuatrimestre</option>
                                                @foreach ($cuatrimestres as $cuatrimestre)
                                                    @if ($estudiante->cuatrimestre == $cuatrimestre)
                                                        <option value="{{ $estudiante->cuatrimestre }}" selected>
                                                            {{ $estudiante->cuatrimestre }}</option>
                                                    @else
                                                        <option value="{{ $cuatrimestre }}">{{ $cuatrimestre }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('cuatrimestre')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="nombre_proyecto">Nombre del Proyecto <span
                                                    class="text-danger">*</span></label>
                                            <input disabled type="text" class="form-control form-control-lg" id="nombre_proyecto"
                                                placeholder="Integrador" name="nombre_proyecto"
                                                value="{{ $estudiante->nombre_proyecto, old('nombre_proyecto') }}">
                                            @error('nombre_proyecto')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="empresa_id" class="form-label">Empresa <span
                                                    class="text-danger">*</span></label>
                                            <select  disabled class="form-select" aria-label="Seleccionar Empresa" name="empresa_id">

                                                @foreach ($empresas as $empresa)
                                                    <option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
                                                @endforeach
                                            </select>
                                            @error('empresa_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        {{-- Seleccionar Mentor academico --}}
                                        <div class="form-group">
                                            <label for="academico_id" class="form-label">Mentor Academico <span
                                                    class="text-danger">*</span></label>
                                            <select  disabled class="form-select" aria-label="Seleccionar Mentor Academico"
                                                name="academico_id">

                                                @foreach ($academicos as $academico)
                                                    @if ($estudiante->academico_id == $academico->id)
                                                        <option value="{{ $academico->id }}" selected>
                                                            {{ $academico->name }}</option>
                                                    @else
                                                        <option value="{{ $academico->id }}">{{ $academico->name }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('academico_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        {{-- Seleccionar Acesor industrial --}}
                                        <div class="form-group">
                                            <label for="asesorin_id" class="form-label">Acesor Indutrial <span
                                                    class="text-danger">*</span></label>
                                            <select  disabled class="form-select" aria-label="Seleccionar Asesor Industrial"
                                                name="asesorin_id">

                                                @foreach ($industrials as $industrial)
                                                    @if ($estudiante->asesorin_id == $industrial->id)
                                                        <option value="{{ $industrial->id }}" selected>
                                                            {{ $industrial->name }}</option>
                                                    @else
                                                        <option value="{{ $industrial->id }}">{{ $industrial->name }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('asesorin_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        {{-- Seleccionar Carrera del estudiante --}}
                                        <div class="form-group">
                                            <label for="carrera_id" class="form-label">Carrera <span
                                                    class="text-danger">*</span></label>
                                            <select  disabled class="form-select" aria-label="Seleccionar Carrera"
                                                name="carrera_id">
                                                @foreach ($carreras as $carrera)
                                                    @if ($estudiante->carrera_id == $carrera->id)
                                                        <option value="{{ $carrera->id }}" selected>
                                                            {{ $carrera->nombre }}</option>
                                                    @else
                                                        <option value="{{ $carrera->id }}">{{ $carrera->nombre }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('carrera_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        {{-- Selecciona Beca --}}

                                        <div class="form-group">
                                            <label for="beca" class="form-label">Beca Dual <span
                                                    class="text-danger">*</span></label>
                                            <select  disabled class="form-select" aria-label="Seleccionar Carrera" name="beca">

                                                @foreach ($becas as $carrera)
                                                    @if ($estudiante->beca == $carrera['id'])
                                                        <option value="{{ $carrera['id'] }}" selected>
                                                            {{ $carrera['name'] }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $carrera['id'] }}">
                                                            {{ $carrera['name'] }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('beca')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">

                                        {{-- Cargar documento INE --}}
                                        <div class="form-group ">
                                            <label for="ine">INE <span class="text-danger">*</span></label>

                                            <div style=" display: flex; justify-content: space-between;align-items: center; gap: 4px">
                                                <input  hidden type="file" class="form-control form-control-lg"
                                                    id="ine" placeholder="INE" name="ine"
                                                    value="{{ old('ine') }}">
                                                @error('ine')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                                <a id='ine_' href="{{ Storage::url($estudiante->ine) }}"
                                                    class=" form-control form-control-lg btn-primary" target="_blank">Ver
                                                    INE <span class="mdi mdi-file-pdf-box"></span></a>
                                                <button class="btn btn-secondary w-50  " id='ineC'
                                                    onclick="ocultar('ine_','ine','ineC')" type="button">Cambiar
                                                    Documento</button>
                                            </div>
                                        </div>



                                        {{-- Cargar documento de Aceptación --}}
                                        <div class="form-group">
                                            <label for="carta_acp">Carta de Aceptación <span
                                                    class="text-danger">*</span></label>
                                            <div
                                                style=" display: flex; justify-content: space-between;align-items: center; gap: 4px">
                                                <input hidden type="file" class="form-control form-control-lg "
                                                    id="carta_acp" name="carta_acp" ">
                                                                  
                                                                        @error('carta_acp')
        <div class="text-danger">{{ $message }}</div>
    @enderror
                                                                        <a id='carta_acp_' href="{{ Storage::url($estudiante->carta_acp) }}"
                                                                            class=" form-control form-control-lg btn-primary" target="_blank">Ver
                                                                            Carta de Aceptacion
                                                                            <span class="mdi mdi-file-pdf-box"></span>
                                                                        </a>
                                                                        <button class="btn btn-secondary w-50  " id='carta_acpC'
                                                                        onclick="ocultar('carta_acp_','carta_acp','carta_acpC')" type="button">Cambiar Documento</button>
                                                               
                                                                    </div>
                                                                    </div>
                                                                    {{-- Cargar documento Minutas --}}
                                                                    <div class="form-group">
                                                                        <label for="minutas">Minutas <span class="text-danger">*</span></label>
                                                                        <div  style=" display: flex; justify-content: space-between;align-items: center; gap: 4px">

                                                                        <input hidden type="file" class="form-control form-control-lg" id="minutas"
                                                                            placeholder="minutas" name="minutas" value="{{ old('minutas') }}">
                                                                        @error('minutas')
        <div class="text-danger">{{ $message }}</div>
    @enderror
                                                                        <a id='minutas_' href="{{ Storage::url($estudiante->minutas) }}"
                                                                            class=" form-control form-control-lg btn-primary" target="_blank">Ver
                                                                            Minutas
                                                                            <span class="mdi mdi-file-pdf-box"></span>
                                                                        </a>
                                                                        <button class="btn btn-secondary w-50  " id='minutasC'
                                                                        onclick="ocultar('minutas_','minutas','minutasC')" type="button">Cambiar Documento</button>
                                                               
                                                                    </div>
                                                                    </div>

                                                                    {{-- Cargar documento de Plan-Form --}}
                                                                    <div class="form-group">
                                                                        <label for="plan_form">Plan Formacion<span
                                                                                class="text-danger">*</span></label>
                                                                                <div  style=" display: flex; justify-content: space-between;align-items: center; gap: 4px">
                                                                                    <input hidden type="file" class="form-control form-control-lg" id="plan_form"
                                                                            placeholder="plan_form" name="plan_form" value="{{ old('plan_form') }}">
                                                                        @error('plan_form')
        <div class="text-danger">{{ $message }}</div>
    @enderror
                                                                        <a id='plan_form_' href="{{ Storage::url($estudiante->plan_form) }}"
                                                                            class=" form-control form-control-lg btn-primary" target="_blank">Ver
                                                                            Plan de Formacion
                                                                            <span class="mdi mdi-file-pdf-box"></span>
                                                                        </a>
                                                                        <button class="btn btn-secondary w-50  " id='plan_formC'
                                                                        onclick="ocultar('plan_form_','plan_form','plan_formC')" type="button">Cambiar Documento</button>
                                                               
                                                                    </div>
                                                                    </div>
                                                                    {{-- Cargar documento de Historial Academico --}}
                                                                    <div class="form-group">
                                                                        <label for="historial_academico">Historial Academico<span
                                                                                class="text-danger">*</span></label>
                                                                                <div  style=" display: flex; justify-content: space-between;align-items: center; gap: 4px">
                                                                                    <input hidden type="file" class="form-control form-control-lg"
                                                                            id="historial_academico" placeholder="historial_academico"
                                                                            name="historial_academico" value="{{ old('historial_academico') }}">
                                                                        @error('historial_academico')
        <div class="text-danger">{{ $message }}</div>
    @enderror
                                                                        <a id='historial_academico_' href="{{ Storage::url($estudiante->historial_academico) }}"
                                                                            class=" form-control form-control-lg btn-primary" target="_blank">Ver
                                                                            HIstorial Academico
                                                                            <span class="mdi mdi-file-pdf-box"></span>
                                                                        </a>
                                                                        <button class="btn btn-secondary w-50  " id='historial_academicoC'
                                                                        onclick="ocultar('historial_academico_','historial_academico','historial_academicoC')" type="button">Cambiar Documento</button>
                                                               
                                                                    </div>
                                                                    </div>
                                                                    {{--  Crgar documento de Perfil de Ingles --}}
                                                                    <div class="form-group">
                                                                        <label for="perfil_ingles">Perfil de inglés<span
                                                                                class="text-danger">*</span></label>
                                                                                <div  style=" display: flex; justify-content: space-between;align-items: center; gap: 4px">
                                                                                    <input hidden type="file" class="form-control form-control-lg" id="perfil_ingles"
                                                                            placeholder="perfil_ingles" name="perfil_ingles"
                                                                            value="{{ old('perfil_ingles') }}">
                                                                        @error('perfil_ingles')
        <div class="text-danger">{{ $message }}</div>
    @enderror
                                                                        <a id='perfil_ingles_' href="{{ Storage::url($estudiante->perfil_ingles) }}"
                                                                            class=" form-control form-control-lg btn-primary" target="_blank">Ver
                                                                            Perfil de Ingles
                                                                            <span class="mdi mdi-file-pdf-box"></span>
                                                                        </a>
                                                                        <button class="btn btn-secondary w-50  " id='perfil_inglesC'
                                                                        onclick="ocultar('perfil_ingles_','perfil_ingles','perfil_inglesC')" type="button">Cambiar Documento</button>
                                                               
                                                                    </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="evaluacion_form">Evaluación de Formación<span
                                                                                class="text-danger">*</span></label>
                                                                                <div  style=" display: flex; justify-content: space-between;align-items: center; gap: 4px">
                                                                                    <input hidden type="file" class="form-control form-control-lg"
                                                                            id="evaluacion_form" placeholder="evaluacion_form" name="evaluacion_form"
                                                                            value="{{ old('evaluacion_form') }}">
                                                                        @error('evaluacion_form')     <div class="text-danger">{{ $message }}</div> @enderror
                                                                        <a id='evaluacion_form_' href="{{ Storage::url($estudiante->evaluacion_form) }}"
                                                                            class=" form-control form-control-lg btn-primary" target="_blank">Ver
                                                                            evaluacion_form
                                                                            <span class="mdi mdi-file-pdf-box"></span>
                                                                        </a>
                                                                        <button class="btn btn-secondary w-50  " id='evaluacion_formC'
                                                                        onclick="ocultar('evaluacion_form_','evaluacion_form','evaluacion_formC')" type="button">Cambiar Documento</button>
                                                               
                                                                    </div>
                                                                    </div>
                                                                    {{-- Inicio Dual --}}
                                                                    <div class="form-group">
                                                                        <label for="inicio_dual">Inicio Dual <span
                                                                                class="text-danger">*</span></label>
                                                                        <input  type="date" class="form-control form-control-lg" name="inicio_dual"
                                                                            id="inicio_dual"
                                                                            value="{{ $estudiante->inicio_dual, old('inicio_dual') }}">
                                                                        @error('inicio_dual')
        <div class="text-danger">{{ $message }}</div>
    @enderror
                                                                    </div>
                                                                    {{-- Fin Dual --}}
                                                                    <div class="form-group">
                                                                        <label for="fin_dual">Fin Dual <span
                                                                                class="text-danger">*</span></label>
                                                                        <input  type="date" class="form-control form-control-lg" name="fin_dual"
                                                                            id="fin_dual"
                                                                            value="{{ $estudiante->fin_dual, old('fin_dual') }}">
                                                                        @error('fin_dual')
        <div class="text-danger">{{ $message }}</div>
    @enderror
                                                                    </div>

                                                                </div>
                                                                
                                                                </div>
                                                                <div class="mt-3">
                                                                    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                                                                        type="submit">Editar
                                                                    </button>
                                                                </div>
                                                            </div>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
@endsection

<script>
    function ocultar(id, id2, text) {
        const elemento = document.getElementById(`${id}`);
        elemento.hidden = !elemento.hidden;
        document.getElementById(`${text}`).textContent = elemento.hidden ? 'Ver Documento' :
            'Cambiar Documento'; // Habilita el botón para cambiar el archivo
        if (!elemento.hidden) {
            document.getElementById(id2).value = '';


        }
        const elemento1 = document.getElementById(`${id2}`);
        elemento1.hidden = !elemento1.hidden; // Habilita el botón para cambiar el archivo
    }

    // Función para cambiar el archivo
    function changeFile() {
        // Restablece el campo de entrada de archivos seleccionado
        document.getElementById('carta_acp').value = '';
    }
</script>
