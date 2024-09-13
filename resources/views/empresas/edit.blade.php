@extends('layouts.app')
@section('title', 'Editar Estudiante')

@section('content')
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Editar Empresa</h4>
                            <span class="text-danger">* Son campos requeridos</span>
                            <div class="dropdown-divider"></div>
                            <form class="pt-3" action="{{ route('empresas.update', $empresa->id) }}" method="post">
                                @csrf
                                @method('PATCH')
                                <div class="form-group">
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
                                    <label for="convenioMA">Convenio Marco-Empresa <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control form-control-lg" id="convenioMA"
                                           placeholder="convenioMA" name="convenioMA" value="{{ old('convenioMA') }}">
                                    @error('convenioMA')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inicio_conv">Inicio Convenio <span class="text-danger">*</span></label>
                                    <div id="datepicker-popup" class="input-group date datepicker navbar-date-picker">
                                        <span class="input-group-addon input-group-prepend border-right">
                                            <span class="icon-calendar input-group-text calendar-icon"></span>
                                        </span>
                                        <input type="text" class="form-control" name="inicio_conv" id="inicio_conv" value="{{ $empresa->inicio_conv, old('inicio_conv') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="fin_conv">Fin Convenio <span class="text-danger">*</span></label>
                                    <div id="datepicker-popup" class="input-group date datepicker navbar-date-picker">
                                        <span class="input-group-addon input-group-prepend border-right">
                                            <span class="icon-calendar input-group-text calendar-icon"></span>
                                        </span>
                                        <input type="date" class="form-control" name="fin_conv" id="fin_conv" value="{{ $empresa->fin_conv, old('fin_conv') }}">
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                                            type="submit">Editar
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
