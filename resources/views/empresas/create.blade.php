@extends('layouts.app')
@section('title', 'Crear Empresa')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/listas.css') }}">
    <body class="body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow">
                        <x-section-header title="Registro de Unidad Económica"
                            description="Registro de nuevas Unidades Económicas interesadas en colaborar con la Universidad mediante el Modelo de Formación Dual, indicando las carreras con las que desean establecer vínculo académico." />

                        <div class="card-body">
                            <form enctype="multipart/form-data" action="{{ route('empresas.store') }}" method="post"
                                class="needs-validation" novalidate>
                                @csrf

                                <!-- Información Básica -->
                                <div class="mb-4">
                                    <h5 class="section-title">Información Básica</h5>
                                    <div class="dropdown-divider mb-4"></div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="nombre" class="form-label">Nombre de la empresa <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="nombre"
                                                placeholder="Razón social o nombre legal de la empresa" name="nombre"
                                                value="{{ old('nombre') }}" required>
                                            @error('nombre')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="email" class="form-label">Correo Electrónico <span
                                                    class="text-danger">*</span></label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="ejemplo@empresa.com" value="{{ old('email') }}" required>
                                            @error('email')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-8 mb-3">
                                            <label for="direccion" class="form-label">Dirección de la sede principal <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="direccion"
                                                placeholder="Calle, número, ciudad, provincia, país" name="direccion"
                                                value="{{ old('direccion') }}" required>
                                            @error('direccion')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="telefono" class="form-label">Teléfono de contacto <span
                                                    class="text-danger">*</span></label>
                                            <input type="telefono" class="form-control" id="telefono" name="telefono"
                                                placeholder="Ingrese el numero de contacto" tipo-data="number"
                                                value="{{ old('telefono') }}" required>
                                        </div>
                                        @error('telefono')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                        </div>

                        <!-- Direcciones de Carrera -->
                        <div class="mb-4 p-3">
                            <h5 class="section-title">Direcciones de Carrera <span class="text-danger">*</span></h5>
                            <small class="text-muted text-stone-950">
                                Seleccione las carreras con las que su empresa desea colaborar en el sistema de
                                formación dual.
                            </small>

                            <div class="dropdown-divider mb-4"></div>

                            {{-- Seleccionar Direccion Docencia --}}
                            <div class="form-group">
                                <select class="form-select" id="direcciones_ids" name="direcciones_ids[]" multiple
                                    aria-label="Seleccionar Direcciones de Carrera" size="8">
                                    @foreach ($direcciones as $direccion)
                                        @if ($direccion)
                                            <option value="{{ $direccion->id }}"
                                                @if (
                                                    (is_array(old('direcciones_ids')) && in_array($direccion->id, old('direcciones_ids'))) ||
                                                        (!old() && session()->has('direccion') && session('direccion')->id == $direccion->id)) selected @endif>
                                                {{ $direccion->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                <small class="form-text text-muted">
                                    Mantén presionada la tecla <span class="text-black"><strong>Ctrl
                                            (Windows)</strong></span> o
                                    <span class="text-black"><strong>Command (Mac)</strong></span> para seleccionar
                                    múltiples
                                    opciones
                                </small>
                                @error('direcciones_ids')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Documentos del Convenio -->
                            <div class="mb-4 p-3">
                                <h5 class="section-title">Documentos del Convenio</h5>
                                <div class="dropdown-divider mb-4"></div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="convenioA" class="form-label">Convenio Específico <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="file" class="form-control" id="convenioA" name="convenioA"
                                                required>
                                            <button class="btn btn-outline-secondary" type="button"
                                                data-bs-toggle="tooltip" title="Formato PDF, máximo 5MB">
                                                <i class="fas fa-info-circle"></i>
                                            </button>
                                        </div>
                                        @error('convenioA')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="convenioMA" class="form-label">Convenio Marco-Empresa <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="file" class="form-control" id="convenioMA" name="convenioMA"
                                                required>
                                            <button class="btn btn-outline-secondary" type="button"
                                                data-bs-toggle="tooltip" title="Formato PDF, máximo 5MB">
                                                <i class="fas fa-info-circle"></i>
                                            </button>
                                        </div>
                                        @error('convenioMA')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Vigencia del Convenio -->
                            <div class="mb-4 p-3">
                                <h5 class="section-title">Vigencia del Convenio</h5>

                                <div class="dropdown-divider mb-4"></div>
                                <div class="row">
                                    <!-- Fecha de Inicio -->
                                    <div class="col-md-4 mb-3">
                                        <label for="inicio_conv" class="form-label">Fecha de Inicio <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                            <input type="date" class="form-control" name="inicio_conv"
                                                id="inicio_conv" value="{{ old('inicio_conv') }}" required>
                                        </div>
                                        @error('inicio_conv')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 mb-3 ">
                                        <label for="anos_conv" class="form-label">Años de convenio <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="number" data-tipo="numbers" name="anos_conv" id="anos_conv"
                                                class="form-control">
                                            <button type="button" class="btn text-dark w-auto px-4 h-1"
                                                style="background-color: #f4b400;">Calcular</button>
                                        </div>
                                    </div>

                                    <!-- Fecha de Finalización -->
                                    <div class="col-md-4 mb-3">
                                        <label for="fin_conv" class="form-label">Fecha de Finalización <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                            <input disabled type="date" class="form-control" name="fin_conv"
                                                id="fin_conv" value="{{ old('fin_conv') }}" required>
                                        </div>
                                        @error('fin_conv')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            <!-- Botones de Acción -->
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                <x-cancel-button url="{{ route('empresas.index') }}" />
                                <button type="submit" class="btn" style="background-color: #006837; color: white;">
                                    <i class="fas fa-save me-1"></i> Guardar Empresa
                                </button>

                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function calcularFechaFinal() {
                const fechaInicio = document.getElementById('inicio_conv').value;
                const aniosASumar = parseInt(document.getElementById('anos_conv').value);

                if (!fechaInicio) {
                    alert('Por favor, seleccione una fecha de inicio.');
                    return;
                }

                if (isNaN(aniosASumar) || aniosASumar < 1) {
                    alert('Por favor, ingrese un número válido de años.');
                    return;
                }

                const [anio, mes, dia] = fechaInicio.split('-').map(Number);
                const nuevoAnio = anio + aniosASumar;

                // Verificar si la fecha original es 29 de febrero
                if (mes === 2 && dia === 29) {
                    // Verificar si el nuevo año es bisiesto
                    const esBisiesto = (nuevoAnio % 4 === 0 && (nuevoAnio % 100 !== 0 || nuevoAnio % 400 === 0));
                    const nuevaFecha = esBisiesto ? new Date(nuevoAnio, 1, 29) : new Date(nuevoAnio, 1, 28);
                    const fechaFinal = nuevaFecha.toISOString().split('T')[0];
                    document.getElementById('fin_conv').value = fechaFinal;
                } else {
                    const fecha = new Date(fechaInicio);
                    fecha.setFullYear(nuevoAnio);
                    const fechaFinal = fecha.toISOString().split('T')[0];
                    document.getElementById('fin_conv').value = fechaFinal;
                }
            }


            // Asociar evento al botón después de que el DOM esté cargado
            window.addEventListener('DOMContentLoaded', function() {
                const boton = document.querySelector('#anos_conv + .btn'); // o dale un id al botón y usa getElementById
                if (boton) {
                    boton.addEventListener('click', calcularFechaFinal);
                }
            });
        </script>
        <script src="{{ asset('js/multipleSelector.js') }}"></script>
    </body>
@endsection
