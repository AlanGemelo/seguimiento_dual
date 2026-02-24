@extends('layouts.app')
@section('title', 'Editar Estudiante')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <!-- Encabezado -->
                <x-forms.section-header title="Actualización de Estudiante Dual"
                    description="Formulario para modificar los datos de estudiantes participantes en el Modelo de Formación Dual, incluyendo información personal, académica, vinculación con empresa y documentación asociada." />

                <div class="card-body">
                    <!-- Información General -->
                    <form class="pt-3"
                        action="{{ route('estudiantes.update', Vinkla\Hashids\Facades\Hashids::encode($estudiante->matricula)) }}"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="mb-4">
                            <h5 class="section-title fw-bold ">Identificación del Estudiante</h5>
                            <div class="dropdown-divider mb-4"></div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="matricula" class="form-label">Matrícula <span
                                            class="text-danger">*</span></label>
                                    <input type="text" data-tipo="numbers" class="form-control" id="matricula"
                                        name="matricula" value="{{ old('matricula', $estudiante->matricula) }}">

                                    @error('matricula')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="email" class="form-label blo">Correo electrónico institucional <span
                                            class="text-danger">*</span></label>
                                    <input type="email" class="form-control"
                                        value="{{ $estudiante->user->email ?? 'al' . $estudiante->matricula . '@utvtol.edu.mx' }}"
                                        disabled>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="name" class="form-label">Nombre(s) <span
                                            class="text-danger">*</span></label>
                                    <input type="text" data-tipo="text" class="form-control uppercase" id="name"
                                        placeholder="Ingrese su(s) nombre(s)" name="name"
                                        value="{{ old('name', $estudiante->name) }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="apellidoP" class="form-label">Apellido Paterno <span
                                            class="text-danger">*</span></label>
                                    <input type="text" data-tipo="text" class="form-control uppercase" id="apellidoP"
                                        placeholder="Ingrese su apellido paterno" name="apellidoP"
                                        value="{{ old('apellidoP', $estudiante->apellidoP) }}">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="apellidoM" class="form-label">Apellido Materno <span
                                            class="text-danger">*</span></label>
                                    <input type="text" data-tipo="text" class="form-control uppercase" id="apellidoM"
                                        placeholder="Ingrese su apellido materno" name="apellidoM"
                                        value="{{ old('apellidoM', $estudiante->apellidoM) }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="curp" class="form-label">CURP <span class="text-danger">*</span></label>
                                    <input type="text" data-tipo="curp" class="form-control uppercase" id="curp"
                                        name="curp" value="{{ old('curp', $estudiante->curp) }}">
                                    @error('curp')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="fecha_na" class="form-label">Fecha de Nacimiento <span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="fecha_na" id="fecha_na"
                                        value="{{ old('fecha_na', $estudiante->fecha_na) }}">
                                    @error('fecha_na')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <h5 class="section-title fw-bold ">Información Académica </h5>
                            <div class="dropdown-divider mb-4"></div>

                            <div class="col-md-6 mb-3">
                                <label for="direccion_id" class="form-label">Dirección de carrera </label>
                                <select class="form-select" aria-label="Seleccionar Dirección de carrera"
                                    name="direccion_id">
                                    <option value="" disabled
                                        {{ old('direccion_id', $estudiante->direccion_id) ? '' : 'selected' }}>
                                        Seleccione una opción</option>
                                    @foreach ($direcciones as $direccion)
                                        <option value="{{ $direccion->id }}"
                                            {{ old('direccion_id', $estudiante->direccion_id) == $direccion->id ? 'selected' : '' }}>
                                            {{ $direccion->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('direccion_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="carrera_id" class="form-label">Programa Educativo </label>
                                <select class="form-select" aria-label="Seleccionar Programa Educativo" name="carrera_id"
                                    id="carrera_id">
                                    <option value="" disabled
                                        {{ old('carrera_id', $estudiante->carrera_id ?? '') ? '' : 'selected' }}>
                                        Seleccione una opción</option>
                                    @foreach ($carreras as $carrera)
                                        <option value="{{ $carrera->id }}"
                                            data-direccion="{{ $carrera->direccion_id }}"
                                            {{ old('carrera_id', $estudiante->carrera_id ?? '') == $carrera->id ? 'selected' : '' }}>
                                            {{ $carrera->grado_academico . ' En ' . $carrera->nombre }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('carrera_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="inicio" class="form-label">Fecha de Ingreso </label>
                                <input type="date" class="form-control" name="inicio" id="inicio"
                                    value="{{ old('inicio', $estudiante->inicio) }}">
                                @error('inicio')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="fin" class="form-label">Fecha de Egreso </label>
                                <input type="date" class="form-control" name="fin" id="fin"
                                    value="{{ old('fin', $estudiante->fin) }}">
                                @error('fin')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="cuatrimestre" class="form-label">Cuatrimestre aplicable a Dual
                                    <span class="text-danger">*</span></label>
                                <select class="form-select" aria-label="Seleccionar Cuatrimestre" name="cuatrimestre">
                                    <option value="" disabled
                                        {{ old('cuatrimestre', $estudiante->cuatrimestre ?? '') ? '' : 'selected' }}>
                                        Seleccione una opción</option>
                                    @foreach (['4', '5', '6', '7', '8', '9', '10', '11'] as $num)
                                        <option value="{{ $num }}"
                                            {{ old('cuatrimestre', $estudiante->cuatrimestre ?? '') == $num ? 'selected' : '' }}>
                                            {{ $num }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('cuatrimestre')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="status" class="form-label">Situación Dual </label>
                                <select class="form-select" aria-label="Seleccionar Situación Dual" name="status">
                                    <option value="" disabled
                                        {{ old('status', $estudiante->status ?? '') ? '' : 'selected' }}>
                                        Seleccione
                                        una opción</option>
                                    @foreach ($situation as $item)
                                        <option value="{{ $item['id'] }}"
                                            {{ old('status', $estudiante->status ?? '') == $item['id'] ? 'selected' : '' }}>
                                            {{ $item['name'] }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('status')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="nombre_proyecto" class="form-label">Nombre del Proyecto </label>
                                <input type="text" class="form-control form-control-lg" id="nombre_proyecto"
                                    placeholder="Nombre del Proyecto" name="nombre_proyecto"
                                    value="{{ old('nombre_proyecto', $estudiante->nombre_proyecto) }}">
                                @error('nombre_proyecto')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="academico_id" class="form-label">Mentor Academico </label>
                                <select class="form-select" aria-label="Seleccionar Mentor Académico" name="academico_id"
                                    id="academico_id">
                                    <option value="" disabled
                                        {{ old('academico_id', $estudiante->academico_id ?? '') ? '' : 'selected' }}>
                                        Seleccione una opción</option>
                                    @foreach ($academicos as $mentor)
                                        <option value="{{ $mentor->id }}" data-direccion="{{ $mentor->direccion_id }}"
                                            {{ old('academico_id', $estudiante->academico_id ?? '') == $mentor->id ? 'selected' : '' }}>
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
                                <label for="empresa_id" class="form-label">Empresa aplicable a Dual </label>

                                <select class="form-select" aria-label="Seleccionar Empresa" name="empresa_id"
                                    id="empresa_id">
                                    <option value="" disabled
                                        {{ old('empresa_id', $estudiante->empresa_id ?? '') ? '' : 'selected' }}>
                                        Seleccione una opción</option>
                                    @foreach ($empresas as $empresa)
                                        <option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
                                    @endforeach
                                </select>
                                @error('empresa_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="asesorin_id" class="form-label">Asesor Industrial </label>
                                <select class="form-select" aria-label="Seleccionar Empresa" name="asesorin_id"
                                    id="asesorin_id">
                                    <option value="" disabled
                                        {{ old('asesorin_id', $estudiante->asesorin_id ?? '') == '' ? 'selected' : '' }}>
                                        Seleccione una opción
                                    </option>
                                    @foreach ($industrials as $asesor)
                                        <option value="{{ $asesor->id }}"
                                            {{ old('asesorin_id', $estudiante->asesorin_id ?? '') == $asesor->id ? 'selected' : '' }}>
                                            {{ $asesor->titulo . ' ' . $asesor->name . ' ' . $asesor->apellidoP . ' ' . $asesor->apellidoM }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('asesorin_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="col-md-6 mb-3">
                                <label for="inicio_dual" class="form-label">Inicio Dual </label>
                                <input type="date" class="form-control form-control-lg" name="inicio_dual"
                                    id="inicio_dual" value="{{ old('inicio_dual', $estudiante->inicio_dual) }}">
                                @error('inicio_dual')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="fin_dual" class="form-label">Fin Dual </label>
                                <input type="date" class="form-control form-control-lg" name="fin_dual"
                                    id="fin_dual" value="{{ old('fin_dual', $estudiante->fin_dual) }}">
                                @error('fin_dual')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
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
                                            <option value="nada"
                                                {{ old('beca', $estudiante->beca ?? '') == 'nada' ? 'selected' : '' }}>
                                                Seleccione una opción</option>

                                            @foreach ($becas as $carrera)
                                                <option value="{{ $carrera['id'] }}"
                                                    {{ old('beca', $estudiante->beca ?? '') == $carrera['id'] ? 'selected' : '' }}>
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
                                        <select class="form-select" aria-label="Seleccionar el tipo de beca"
                                            name="tipoBeca" id="selectTipoBeca">
                                            <option value="" disabled
                                                {{ old('tipoBeca', $estudiante->tipoBeca ?? '') == '' ? 'selected' : '' }}>
                                                Seleccione una opción
                                            </option>
                                            @foreach ($tipoBeca as $carrera)
                                                <option value="{{ $carrera['id'] }}"
                                                    {{ old('tipoBeca', $estudiante->tipoBeca ?? '') == $carrera['id'] ? 'selected' : '' }}>
                                                    {{ $carrera['name'] }}
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
                                    <label for="ine" class="mb-1">INE <span class="text-danger">*</span></label>
                                    <div
                                        style="display: flex; justify-content: space-between;align-items: center; gap: 4px">
                                        <input hidden type="file" accept="application/pdf, image/jpeg, image/png"
                                            class="form-control form-control-lg" id="ine" placeholder="INE"
                                            name="ine" value="{{ old('ine') }}">
                                        @error('ine')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <a id='ine_' href="{{ url(Storage::url($estudiante->ine)) }}"
                                            class=" form-control form-control-lg btn-primary" target="_blank">Ver
                                            INE
                                            <span class="mdi mdi-file-pdf-box"></span>
                                        </a>
                                        <button class="btn btn-secondary w-50  " id='ineC'
                                            onclick="ocultar('ine_','ine','ineC')" type="button">Cambiar
                                            Documento</button>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="historial_academico" class="mb-1">Historial Academico</label>
                                    <div
                                        style=" display: flex; justify-content: space-between;align-items: center; gap: 4px">
                                        <input hidden type="file" accept="application/pdf, image/jpeg, image/png"
                                            class="form-control form-control-lg" id="historial_academico"
                                            placeholder="historial_academico" name="historial_academico"
                                            value="{{ old('historial_academico') }}">
                                        @error('historial_academico')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <a id='historial_academico_'
                                            href="{{ url(Storage::url($estudiante->historial_academico)) }}"
                                            class=" form-control form-control-lg btn-primary" target="_blank">Ver
                                            HIstorial Academico
                                            <span class="mdi mdi-file-pdf-box"></span>
                                        </a>
                                        <button class="btn btn-secondary w-50  " id='historial_academicoC'
                                            onclick="ocultar('historial_academico_','historial_academico','historial_academicoC')"
                                            type="button">Cambiar Documento</button>

                                    </div>
                                </div>


                                <div class="col-md-4 mb-3">
                                    <label for="perfil_ingles" class="mb-1">Perfil de Ingles</label>
                                    <div
                                        style=" display: flex; justify-content: space-between;align-items: center; gap: 4px">
                                        <input hidden type="file" accept="application/pdf, image/jpeg, image/png"
                                            class="form-control form-control-lg" id="perfil_ingles"
                                            placeholder="perfil_ingles" name="perfil_ingles"
                                            value="{{ old('perfil_ingles') }}">
                                        @error('perfil_ingles')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <a id='perfil_ingles_' href="{{ url(Storage::url($estudiante->perfil_ingles)) }}"
                                            class=" form-control form-control-lg btn-primary" target="_blank">Ver
                                            Perfil de Ingles
                                            <span class="mdi mdi-file-pdf-box"></span>
                                        </a>
                                        <button class="btn btn-secondary w-50  " id='perfil_inglesC'
                                            onclick="ocultar('perfil_ingles_','perfil_ingles','perfil_inglesC')"
                                            type="button">Cambiar Documento</button>

                                    </div>
                                </div>

                                <div class="col-12">
                                    <h6 class="section-subtitle mt-3">Formatos Institucionales</h6>
                                    <div class="dropdown-divider mb-3"></div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="formato51" class="mb-1">Formato 5.1</label>
                                            <div
                                                style=" display: flex; justify-content: space-between;align-items: center; gap: 4px">
                                                <input hidden type="file"
                                                    accept="application/pdf, image/jpeg, image/png"
                                                    class="form-control form-control-lg" id="formato51"
                                                    placeholder="formato51" name="formato51"
                                                    value="{{ old('formato51') }}">
                                                @error('formato51')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                                <a id='formato51_' href="{{ url(Storage::url($estudiante->formato51)) }}"
                                                    class=" form-control form-control-lg btn-primary" target="_blank">Ver
                                                    formato 5.1
                                                    <span class="mdi mdi-file-pdf-box"></span>
                                                </a>
                                                <button class="btn btn-secondary w-50  " id='formato51C'
                                                    onclick="ocultar('formato51_','formato51','formato51C')"
                                                    type="button">Cambiar Documento</button>

                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="formato54" class="mb-1">Formato 5.4 </label>
                                            <div style="display: flex; flex-direction: column; gap: 10px;">
                                                <!-- Input para nuevos archivos -->
                                                <input type="file" accept="application/pdf, image/jpeg, image/png"
                                                    class="form-control form-control-lg" id="formato54"
                                                    name="formato54[]" multiple>

                                                <!-- Lista de archivos existentes -->
                                                @if (!empty($estudiante->formato54))
                                                    @foreach (json_decode($estudiante->formato54) as $index => $file)
                                                        <div class="d-flex align-items-center gap-2">
                                                            <a href="{{ Storage::url($file) }}" class="btn btn-primary"
                                                                target="_blank">
                                                                Ver archivo {{ $loop->iteration }}
                                                            </a>
                                                            <button type="button" class="btn btn-danger btn-sm"
                                                                onclick="eliminarArchivo(this, '{{ $index }}')">
                                                                Eliminar
                                                            </button>
                                                        </div>
                                                    @endforeach
                                                @endif

                                                <!-- Campo oculto para archivos eliminados -->
                                                <input type="hidden" name="deleted_files" id="deleted_files"
                                                    value="">
                                            </div>
                                            @error('formato54')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="formato55" class="mb-1">Formato 5.5 </label>
                                            <div
                                                style=" display: flex; justify-content: space-between;align-items: center; gap: 4px">
                                                <input hidden type="file"
                                                    accept="application/pdf, image/jpeg, image/png"
                                                    class="form-control form-control-lg" id="formato55"
                                                    placeholder="formato55" name="formato55"
                                                    value="{{ old('formato55') }}">
                                                @error('formato55')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                                <a id='formato55_' href="{{ url(Storage::url($estudiante->formato55)) }}"
                                                    class=" form-control form-control-lg btn-primary" target="_blank">Ver
                                                    formato 5.5
                                                    <span class="mdi mdi-file-pdf-box"></span>
                                                </a>
                                                <button class="btn btn-secondary w-50  " id='formato55C'
                                                    onclick="ocultar('formato55_','formato55','formato55C')"
                                                    type="button">Cambiar Documento</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mt-2">
                                    <h6 class="section-subtitle mt-3">Documentos de Proceso Dual</h6>
                                    <div class="dropdown-divider mb-3"></div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="carta_acp" class="mb-1">Carta de Aceptación</label>
                                            <div
                                                style="display: flex; justify-content: space-between; align-items: center; gap: 4px">
                                                <!-- Input oculto para subir nuevo archivo -->
                                                <input hidden type="file"
                                                    accept="application/pdf, image/jpeg, image/png"
                                                    class="form-control form-control-lg" id="input_carta_acp"
                                                    name="carta_acp" value="{{ old('carta_acp') }}">

                                                @error('carta_acp')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror

                                                <!-- Enlace para ver documento actual -->
                                                <a id="link_carta_acp"
                                                    href="{{ url(Storage::url($estudiante->carta_acp)) }}"
                                                    class="form-control form-control-lg btn-primary" target="_blank">
                                                    Ver Carta de Aceptación <span class="mdi mdi-file-pdf-box"></span>
                                                </a>

                                                <!-- Botón para cambiar archivo -->
                                                <button class="btn btn-secondary w-50" id="btn_carta_acp"
                                                    onclick="ocultar('input_carta_acp','link_carta_acp','btn_carta_acp')"
                                                    type="button">
                                                    Cambiar Documento
                                                </button>
                                            </div>

                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="minutas" class="mb-1">Minutas </label>
                                            <div
                                                style=" display: flex; justify-content: space-between;align-items: center; gap: 4px">
                                                <input hidden type="file"
                                                    accept="application/pdf, image/jpeg, image/png"
                                                    class="form-control form-control-lg" id="minutas"
                                                    placeholder="minutas" name="minutas" value="{{ old('minutas') }}">
                                                @error('minutas')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                                <a id='minutas_' href="{{ url(Storage::url($estudiante->minutas)) }}"
                                                    class=" form-control form-control-lg btn-primary" target="_blank">Ver
                                                    Minutas
                                                    <span class="mdi mdi-file-pdf-box"></span>
                                                </a>
                                                <button class="btn btn-secondary w-50  " id='minutasC'
                                                    onclick="ocultar('minutas_','minutas','minutasC')"
                                                    type="button">Cambiar
                                                    Documento</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="plan_form" class="mb-1">Plan de Formacion </label>
                                            <div
                                                style=" display: flex; justify-content: space-between;align-items: center; gap: 4px">
                                                <input hidden type="file"
                                                    accept="application/pdf, image/jpeg, image/png"
                                                    class="form-control form-control-lg" id="plan_form"
                                                    placeholder="plan_form" name="plan_form"
                                                    value="{{ old('plan_form') }}">
                                                @error('plan_form')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                                <a id='plan_form_' href="{{ url(Storage::url($estudiante->plan_form)) }}"
                                                    class=" form-control form-control-lg btn-primary" target="_blank">Ver
                                                    Plan de Formacion
                                                    <span class="mdi mdi-file-pdf-box"></span>
                                                </a>
                                                <button class="btn btn-secondary w-50  " id='plan_formC'
                                                    onclick="ocultar('plan_form_','plan_form','plan_formC')"
                                                    type="button">Cambiar Documento</button>

                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="evaluacion_form" class="mb-1">Evaluación de
                                                Formación</label>
                                            <div
                                                style=" display: flex; justify-content: space-between;align-items: center; gap: 4px">
                                                <input hidden type="file"
                                                    accept="application/pdf, image/jpeg, image/png"
                                                    class="form-control form-control-lg" id="evaluacion_form"
                                                    placeholder="evaluacion_form" name="evaluacion_form"
                                                    value="{{ old('evaluacion_form') }}">
                                                @error('evaluacion_form')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                                <a id='evaluacion_form_'
                                                    href="{{ url(Storage::url($estudiante->evaluacion_form)) }}"
                                                    class=" form-control form-control-lg btn-primary" target="_blank">Ver
                                                    Evaluacion de Formacion
                                                    <span class="mdi mdi-file-pdf-box"></span>
                                                </a>
                                                <button class="btn btn-secondary w-50  " id='evaluacion_formC'
                                                    onclick="ocultar('evaluacion_form_','evaluacion_form','evaluacion_formC')"
                                                    type="button">Cambiar Documento</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mt-3" id="formatosBeca" style="display: none">
                                    <h6 class="section-subtitle mt-1">
                                        Formatos de Beca
                                        <small class="text-muted text-danger" style="color: #dc3545 !important;">
                                            (Solo en caso de aplicar a una beca)
                                        </small>
                                    </h6>
                                    <div class="dropdown-divider mb-3"></div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="formatoA" class="mb-1">Formato A </label>
                                            <div
                                                style=" display: flex; justify-content: space-between;align-items: center; gap: 4px">
                                                <input hidden type="file"
                                                    accept="application/pdf, image/jpeg, image/png"
                                                    class="form-control form-control-lg" id="formatoA"
                                                    placeholder="formatoA" name="formatoA"
                                                    value="{{ old('formatoA') }}">
                                                @error('formatoA')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                                <a id='formatoA_' href="{{ url(Storage::url($estudiante->formatoA)) }}"
                                                    class=" form-control form-control-lg btn-primary" target="_blank">Ver
                                                    Formato A
                                                    <span class="mdi mdi-file-pdf-box"></span>
                                                </a>
                                                <button class="btn btn-secondary w-50  " id='formatoAC'
                                                    onclick="ocultar('formatoA_','formatoA','formatoAC')"
                                                    type="button">Cambiar Documento</button>

                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="formatoB" class="mb-1">Formato B </label>
                                            <div
                                                style=" display: flex; justify-content: space-between;align-items: center; gap: 4px">
                                                <input hidden type="file"
                                                    accept="application/pdf, image/jpeg, image/png"
                                                    class="form-control form-control-lg" id="formatoB"
                                                    placeholder="formatoB" name="formatoB"
                                                    value="{{ old('formatoB') }}">
                                                @error('formatoB')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                                <a id='formatoB_' href="{{ url(Storage::url($estudiante->formatoB)) }}"
                                                    class=" form-control form-control-lg btn-primary" target="_blank">Ver
                                                    Formato B
                                                    <span class="mdi mdi-file-pdf-box"></span>
                                                </a>
                                                <button class="btn btn-secondary w-50  " id='formatoBC'
                                                    onclick="ocultar('formatoB_','formatoB','formatoBC')"
                                                    type="button">Cambiar Documento</button>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="formatoC" class="mb-1">Formato C </label>
                                            <div
                                                style=" display: flex; justify-content: space-between;align-items: center; gap: 4px">
                                                <input hidden type="file"
                                                    accept="application/pdf, image/jpeg, image/png"
                                                    class="form-control form-control-lg" id="formatoC"
                                                    placeholder="formatoC" name="formatoC"
                                                    value="{{ old('formatoC') }}">
                                                @error('formatoC')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                                <a id='formatoC_' href="{{ url(Storage::url($estudiante->formatoC)) }}"
                                                    class=" form-control form-control-lg btn-primary" target="_blank">Ver
                                                    formato C
                                                    <span class="mdi mdi-file-pdf-box"></span>
                                                </a>
                                                <button class="btn btn-secondary w-50  " id='formatoCC'
                                                    onclick="ocultar('formatoC_','formatoC','formatoCC')"
                                                    type="button">Cambiar Documento</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>

                            <div class=" d-flex justify-content-end mt-3 ">
                                <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn mr-4"
                                    type="submit" style="margin-right: 15px ">Actualizar
                                </button>
                                <x-buttons.cancel-button url="{{ route('estudiantes.index') }}" />
                            </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        const BASE_ULR = "";

        document.addEventListener('DOMContentLoaded', function() {
            mostrarInput();
        });

        $(document).ready(function() {
            $('#direccion_id').on('change', function() {
                let direccionId = $(this).val();

                if (direccionId) {
                    fetch(`${BASE_URL}/get-carreras-academicos/${direccionId}`)
                        .then(response => response.json())
                        .then(data => {
                            let carreraSelect = $('#carrera_id');
                            let academicoSelect = $('#academico_id');

                            carreraSelect.html('<option selected>Seleccione una opción</option>');
                            academicoSelect.html('<option selected>Seleccione una opción</option>');

                            data.carreras.forEach(carrera => {
                                carreraSelect.append(
                                    `<option value="${carrera.id}">${carrera.nombre}</option>`
                                );
                            });

                            data.academicos.forEach(academico => {
                                academicoSelect.append(
                                    `<option value="${academico.id}">${academico.titulo} ${academico.name}</option>`
                                );
                            });
                        })
                        .catch(error => console.error('Error fetching data:', error));
                }
            });
        });


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

        // Función para marcar archivos para eliminación
        function eliminarArchivo(button, index) {
            const deletedFilesInput = document.getElementById('deleted_files');
            const current = deletedFilesInput.value ? deletedFilesInput.value.split(',') : [];

            if (!current.includes(index.toString())) {
                current.push(index);
                deletedFilesInput.value = current.join(',');
            }

            // Elimina el bloque del archivo completamente
            const archivoDiv = button.closest('.d-flex');
            if (archivoDiv) {
                archivoDiv.remove();
            }
        }
        // Función para cambiar el archivo
        function changeFile() {
            // Restablece el campo de entrada de archivos seleccionado
            document.getElementById('carta_acp').value = '';
        }



        function mostrarInput() {
            var becaValue = document.getElementById('beca').value;
            var tipoBecaDiv = document.getElementById('tipoBeca');
            var tipoBecaSelect = document.getElementById('selectTipoBeca');
            var formatosDiv = document.getElementById('formatosBeca');

            // Mostrar solo si es una beca válida (no vacío, no 'nada', no '1')
            if (becaValue && becaValue !== 'nada' && becaValue !== '1') {
                tipoBecaDiv.style.display = 'block';
                tipoBecaSelect.disabled = false;
                tipoBecaSelect.required = true;
                formatosDiv.style.display = 'block';
            } else {
                tipoBecaDiv.style.display = 'none';
                tipoBecaSelect.value = '';
                tipoBecaSelect.disabled = true;
                tipoBecaSelect.required = false;
                formatosDiv.style.display = 'none';
            }
        }

        // Ejecutar al cargar la página para establecer estado inicial
        document.addEventListener('DOMContentLoaded', function() {
            mostrarInput();
        });


        $(document).ready(function() {
            // Manejar el cambio en el campo academico_id
            $('#empresa_id').change(function() {
                var mentorId = $(this).val();
                // Construye la URL base correctamente
                var baseUrl = window.location.origin + '/~dualticedu';
                var url = `${baseUrl}/mentores/${mentorId}/empresa`;
                // Realizar la petición AJAX

                $.ajax({
                    type: 'GET',
                    url: `${window.BASE_URL}/mentores/${mentorId}/empresa`,

                    success: function(data) {
                        console.log('Datos recibidos del servidor:',
                            data);

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
