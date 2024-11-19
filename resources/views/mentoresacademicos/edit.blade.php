@extends('layouts.app')
@section('title', 'Editar Mentor Academico')
@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title px-3 pt-3">Editar Mentor Academico</h4>
                        <div class="form-text text-danger ps-3">* Son campos requeridos</div>
                        <div class="dropdown-divider"></div>
                        <form class="pt-3" action="{{ route('academicos.update', $mentor->id) }}" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="titulo">Título <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-lg" id="titulo" placeholder="Juan Perez Hermenegildo" name="titulo" value="{{ old('titulo', $mentor->titulo) }}">
                                        @error('titulo')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="name">Nombre <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-lg" id="name" placeholder="Juan Perez Hermenegildo" name="name" value="{{ old('name', $mentor->name) }}">
                                        @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="email">Correo Electrónico <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control form-control-lg" id="email" placeholder="user@utvtol.edu.mx" name="email" value="{{ old('email', $mentor->email) }}">
                                        @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit">Actualizar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection