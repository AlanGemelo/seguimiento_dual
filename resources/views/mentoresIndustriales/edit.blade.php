@extends('layouts.app')
@section('title', 'Editar Estudiante')

@section('content')
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Editar Mentor Industrial</h4>
                            <span class="text-danger">* Son campos requeridos</span>
                            <div class="dropdown-divider"></div>
                            <form class="pt-3" action="{{ route('mentores.update', $mentorIndustrial->id) }}" method="post">
                                @csrf
                                @method('PATCH')
                                <div class="form-group">
                                    <label for="titulo">Titulo <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg" id="titulo"
                                           placeholder="" name="titulo" value="{{ $mentorIndustrial->titulo, old('titulo') }}">
                                    @error('titulo')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg" id="name"
                                           placeholder="" name="name" value="{{ $mentorIndustrial->name, old('name') }}">
                                    @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="empresa_id" class="form-label">Empresa <span class="text-danger">*</span></label>
                                    <select class="form-select"
                                            aria-label="Seleccionar Empresa" name="empresa_id">
                                        <option selected>Seleccione una opcion</option>
                                        @foreach($empresas as $empresa)
                                            <option
                                                value="{{$empresa->id}}">{{$empresa->nombre}}</option>
                                        @endforeach
                                    </select>
                                    @error('empresa_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
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
