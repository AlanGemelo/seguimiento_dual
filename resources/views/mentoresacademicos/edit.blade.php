@extends('layouts.app')
@section('title', 'Editar Mentor Academico')
@section('content')
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Editar Datos Mentor</h4>
                            <span class="text-danger">* Son campos requeridos</span>
                            <div class="dropdown-divider"></div>
                            <form class="pt-3" action="{{ route('academicos.update', $mentor->id) }}" method="post">
                                @csrf
                                @method('PATCH')
                                <div class="form-group">
                                    <label for="titulo">Titulo <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg" id="titulo" placeholder="Juan Perez Hermenegildo" name="titulo" value="{{ old('titulo', $mentor->titulo) }}">
                                    @error('titulo')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg" id="name" placeholder="Juan Perez Hermenegildo" name="name" value="{{ old('name', $mentor->name) }}">
                                    @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Correo Electronico <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control form-control-lg" id="email" placeholder="user@utvtol.edu.mx" name="email" value="{{ old('email', $mentor->email) }}">
                                    @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                       {{-- Seleccionar Docencia del estudiante --}}
                                       <div class="form-group">
                                        <label for="direccion_id" class="form-label">Direccion de Carrera <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select" aria-label="Seleccionar Carrera"
                                            name="direccion_id">
                                            @foreach ($direcciones as $direccion)
                                                @if ($mentor->direccion->id == $direccion->id)
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

