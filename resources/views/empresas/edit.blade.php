@extends('layouts.app')
@section('title', 'Editar Empresa')

@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
<<<<<<< HEAD
                        <h4 class="card-title px-3 pt-3">Editar Empresa</h4>
                        <div class="form-text text-danger ps-3">* Son campos requeridos</div>
=======
                        <h4 class="card-title">Editar Empresa</h4>
                        <span class="text-danger">* Son campos requeridos</span>
>>>>>>> f57f20083a2decb167ed3140251ba15d87cdac3d
                        <div class="dropdown-divider"></div>
                        <form class="pt-3" action="{{ route('empresas.update', $empresa->id) }}" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
<<<<<<< HEAD
                                <label for="nombre">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg" id="nombre"
                                    placeholder="" name="nombre" value="{{ $empresa->nombre, old('nombre') }}">

                            </div>
                            <div class="form-group">
                                <label for="direccion">Direccion <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg" id="direccion"
                                    name="direccion"
                                    value="{{ $empresa->direccion, old('direccion') }}">
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label for="inicio_conv" class="form-label">Inicio Convenio <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" name="inicio_conv" id="inicio_conv" value="{{ $empresa->inicio_conv, old('inicio_conv') }}">
                                            @error('inicio_conv')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label for="fin_conv" class="form-label">Fin Convenio <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" name="fin_conv" id="fin_conv" value="{{ $empresa->fin_conv, old('fin_conv') }}">
                                            @error('fin_conv')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                                    type="submit">Editar
                                </button>
=======
                                <label for="nombre">Nombre <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg" id="nombre" name="nombre" value="{{ old('nombre', $empresa->nombre) }}" required>
                                @error('nombre')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Correo Electrónico <span class="text-danger">*</span></label>
                                <input type="email" class="form-control form-control-lg" id="email" name="email" value="{{ old('email', $empresa->email) }}" required>
                                @error('email')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="direccion">Dirección <span class="text-danger">*</span></label>
                                <textarea class="form-control form-control-lg" id="direccion" name="direccion" required>{{ old('direccion', $empresa->direccion) }}</textarea>
                                @error('direccion')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="telefono">Teléfono <span class="text-danger">*</span></label>
                                <input type="text" data-tipo="numbers" class="form-control form-control-lg" id="telefono" name="telefono" value="{{ old('telefono', $empresa->telefono) }}" required maxlength="10">
                                @error('telefono')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="inicio_conv">Fecha de Inicio de Convenio <span class="text-danger">*</span></label>
                                <input type="date" class="form-control form-control-lg" id="inicio_conv" name="inicio_conv" value="{{ old('inicio_conv', $empresa->inicio_conv) }}" required>
                                @error('inicio_conv')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="fin_conv">Fecha de Fin de Convenio <span class="text-danger">*</span></label>
                                <input type="date" class="form-control form-control-lg" id="fin_conv" name="fin_conv" value="{{ old('fin_conv', $empresa->fin_conv) }}" required>
                                @error('fin_conv')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="ine">INE (opcional)</label>
                                <input type="file" class="form-control form-control-lg" id="ine" name="ine">
                                @error('ine')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="direccion_id">Dirección de Carrera <span class="text-danger">*</span></label>
                                <select class="form-control form-control-lg" id="direccion_id" name="direccion_id" required>
                                    @foreach($direcciones as $direccion)
                                        <option value="{{ $direccion->id }}" {{ old('direccion_id', $empresa->direccion_id) == $direccion->id ? 'selected' : '' }}>{{ $direccion->name }}</option>
                                    @endforeach
                                </select>
                                @error('direccion_id')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="convenioA">Convenio A (opcional)</label>
                                <input type="file" class="form-control form-control-lg" id="convenioA" name="convenioA">
                                @error('convenioA')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="convenioMA">Convenio MA (opcional)</label>
                                <input type="file" class="form-control form-control-lg" id="convenioMA" name="convenioMA">
                                @error('convenioMA')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Nuevos campos -->
                            <div class="form-group">
                                <label for="unidad_economica">Unidad Económica</label>
                                <input type="text" class="form-control form-control-lg" id="unidad_economica" name="unidad_economica" value="{{ old('unidad_economica', $empresa->unidad_economica) }}">
                                @error('unidad_economica')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="fecha_registro">Fecha de Registro</label>
                                <input type="date" class="form-control form-control-lg" id="fecha_registro" name="fecha_registro" value="{{ old('fecha_registro', $empresa->fecha_registro) }}">
                                @error('fecha_registro')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="razon_social">Razón Social</label>
                                <input type="text" class="form-control form-control-lg" id="razon_social" name="razon_social" value="{{ old('razon_social', $empresa->razon_social) }}">
                                @error('razon_social')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nombre_representante">Nombre del Representante</label>
                                <input type="text" class="form-control form-control-lg" id="nombre_representante" name="nombre_representante" value="{{ old('nombre_representante', $empresa->nombre_representante) }}">
                                @error('nombre_representante')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="cargo_representante">Cargo del Representante</label>
                                <input type="text" class="form-control form-control-lg" id="cargo_representante" name="cargo_representante" value="{{ old('cargo_representante', $empresa->cargo_representante) }}">
                                @error('cargo_representante')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="actividad_economica">Actividad Económica</label>
                                <input type="text" class="form-control form-control-lg" id="actividad_economica" name="actividad_economica" value="{{ old('actividad_economica', $empresa->actividad_economica) }}">
                                @error('actividad_economica')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="tamano_ue">Tamaño de la UE</label>
                                <input type="number" class="form-control form-control-lg" id="tamano_ue" name="tamano_ue" value="{{ old('tamano_ue', $empresa->tamano_ue) }}">
                                @error('tamano_ue')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="folio">Folio</label>
                                <input type="text" class="form-control form-control-lg" id="folio" name="folio" value="{{ old('folio', $empresa->folio) }}">
                                @error('folio')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit">Guardar</button>
>>>>>>> f57f20083a2decb167ed3140251ba15d87cdac3d
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<<<<<<< HEAD
@endsection
=======
@endsection
>>>>>>> f57f20083a2decb167ed3140251ba15d87cdac3d
