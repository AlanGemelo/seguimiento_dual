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
                            <form enctype="multipart/form-data" class="pt-3" action="{{ route('empresas.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="nombre">Nombre  <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg" id="nombre"
                                           placeholder="" name="nombre" value="{{ old('nombre') }}">
                                    @error('nombre')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="direccion">Direccion <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg" id="direccion"
                                           name="direccion"
                                           value="{{ old('direccion') }}">
                                    @error('direccion')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- Cargar convenio academico --}}
                                <div class="form-group">
                                    <label for="convenioA">Convenio Academico <span class="text-danger">*</span></label>
                                    <input autofocus type="file" class="form-control form-control-lg" id="convenioA"
                                           placeholder="convenioA" name="convenioA" value="{{ old('convenioA') }}">
                                    @error('convenioA')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- Cargar convenio marco-empresa --}}
                                <div class="form-group">
                                    <label for="convenioMA">Convenio Marco-Empresa <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control form-control-lg" id="convenioMA"
                                           placeholder="convenioMA" name="convenioMA" value="{{ old('convenioMA') }}">
                                    @error('convenioMA')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inicio_conv">Inicio convenio <span class="text-danger">*</span></label>
                                    <div id="datepicker-popup" class="input-group date datepicker navbar-date-picker">
                                        <span class="input-group-addon input-group-prepend border-right">
                                            <span class="icon-calendar input-group-text calendar-icon"></span>
                                        </span>
                                        <input type="text" class="form-control" name="inicio_conv" id="inicio_conv" value="{{ old('inicio_conv') }}">
                                        @error('inicio_conv')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="fin_conv">Fin convenio <span class="text-danger">*</span></label>
                                    <div id="datepicker-popup" class="input-group date datepicker navbar-date-picker">
                                        <span class="input-group-addon input-group-prepend border-right">
                                            <span class="icon-calendar input-group-text calendar-icon"></span>
                                        </span>
                                        <input type="date" class="form-control" name="fin_conv" id="fin_conv" value="{{ old('fin_conv') }}">
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
