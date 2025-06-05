@extends('layouts.app')
@section('title', 'Crear Empresa')

@section('content')
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Crear Empresa</h4>
                            <span class="text-danger">* Son campos requeridos</span>
                            <div class="dropdown-divider"></div>
                            <form enctype="multipart/form-data" class="pt-3" action="{{ route('empresas.store') }}"
                                method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="nombre">Nombre de la empresa <span class="text-danger">*</span></label>
                                    <input type="text"  class="form-control form-control-lg"
                                        id="nombre" placeholder="Ingrese la razón social o el nombre legal de la empresa"
                                        name="nombre" value="{{ old('nombre') }}">
                                    @error('nombre')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="direccion">Dirección de la sede principal <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg" id="direccion"
                                        placeholder="Ingrese la dirección completa (calle, ciudad, provincia, país)"
                                        name="direccion" value="{{ old('direccion') }}">

                                    @error('direccion')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="telefono">Teléfono de contacto <span class="text-danger">*</span></label>
                                    <input type="text" data-tipo="numbers" class="form-control form-control-lg"
                                        id="telefono" placeholder="Ingrese un número telefónico con código de área"
                                        name="telefono" value="{{ old('telefono') }}">
                                    @error('telefono')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Correo Electronico <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control form-control-lg" id="email" name="email"
                                        placeholder="Ingrese una dirección de correo electrónico válida"
                                        value="{{ old('email') }}">
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- Seleccionar Direccion Docencia --}}
                                <div class="form-group">
                                    <label for="direccion_id" class="form-label">Direccion de Carrera <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" aria-label="Seleccionar Direccion de Carrera"
                                        name="direccion_id">

                                        @foreach ($direcciones as $direccion)
                                            @if (session('direccion')->id == $direccion->id)
                                                <option value="{{ $direccion->id }}" selected>
                                                    {{ $direccion->name }}</option>
                                            @else
                                                <option value="{{ $direccion->id }}">{{ $direccion->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('direccion_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Cargar convenio academico --}}
                                <div class="form-group">
                                    <label for="convenioA">Convenio Especifico <span class="text-danger">*</span></label>
                                    <input autofocus type="file" class="form-control form-control-lg" id="convenioA"
                                        placeholder="convenioA" name="convenioA" value="{{ old('convenioA') }}">
                                    @error('convenioA')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- Cargar convenio marco-empresa --}}
                                <div class="form-group">
                                    <label for="convenioMA">Convenio Marco-Empresa <span
                                            class="text-danger">*</span></label>
                                    <input type="file" class="form-control form-control-lg" id="convenioMA"
                                        placeholder="convenioMA" name="convenioMA" value="{{ old('convenioMA') }}">
                                    @error('convenioMA')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="inicio_conv">Inicio convenio <span class="text-danger">*</span></label>
                                    <div class="input-group date navbar-date-picker">
                                        <span class="input-group-addon input-group-prepend border-right">
                                            <span class="icon-calendar input-group-text calendar-icon"></span>
                                        </span>
                                        <input type="date" class="form-control" name="inicio_conv" id="inicio_conv"
                                            value="{{ old('inicio_conv') }}">
                                        @error('inicio_conv')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="fin_conv">Fin convenio <span class="text-danger">*</span></label>
                                    <div class="input-group date navbar-date-picker">
                                        <span class="input-group-addon input-group-prepend border-right">
                                            <span class="icon-calendar input-group-text calendar-icon"></span>
                                        </span>
                                        <input type="date" class="form-control" name="fin_conv" id="fin_conv"
                                            value="{{ old('fin_conv') }}">
                                        @error('fin_conv')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>


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
