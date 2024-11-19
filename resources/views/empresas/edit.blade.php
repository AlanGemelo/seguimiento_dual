@extends('layouts.app')
@section('title', 'Editar Estudiante')

@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title px-3 pt-3">Editar Empresa</h4>
                        <div class="form-text text-danger ps-3">* Son campos requeridos</div>
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
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection