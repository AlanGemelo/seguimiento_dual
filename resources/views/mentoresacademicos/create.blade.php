@extends('layouts.app')
@section('title', 'Crear Mentor Academico')
@section('content')
<<<<<<< HEAD
<div class="row">
    <div class="col-12 grid-margin">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title px-3 pt-3">Crear Mentor Academico</h4>
                        <div class="form-text text-danger ps-3">* Son campos requeridos</div>
                        <div class="dropdown-divider"></div>
                        <form class="pt-3" action="{{ route('academicos.store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="titulo">Titulo <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-lg" id="titulo" placeholder=" Ingeniero en sistemas" name="titulo" value="{{ old('titulo') }}">
                                        @error('titulo')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
=======
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Crear Mentor Academico</h4>
                            <span class="text-danger">* Son campos requeridos</span>
                            <div class="dropdown-divider"></div>
                            <form class="pt-3" action="{{ route('academicos.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="titulo">Grado académico <span class="text-danger">*</span></label>
                                    <input type="text" data-tipo="text" class="form-control form-control-lg"
                                        id="titulo" placeholder="Ej. Licenciado, Ingeniero, Doctor" name="titulo"
                                        value="{{ old('titulo') }}">
                                    @error('titulo')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name">Nombre(s) <span class="text-danger">*</span></label>
                                    <input type="text" data-tipo="text" class="form-control form-control-lg uppercase"
                                        id="name" placeholder="Ingrese su(s) nombre(s)" name="name"
                                        value="{{ old('name') }}">
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="apellidoP">Apellido Paterno <span class="text-danger">*</span></label>
                                    <input type="text" data-tipo="text" class="form-control form-control-lg uppercase"
                                        id="apellidoP" placeholder="Ingrese su apellido paterno" name="apellidoP"
                                        value="{{ old('apellidoP') }}">
                                    @error('apellidoP')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="apellidoM">Apellido Materno <span class="text-danger">*</span></label>
                                    <input type="text" data-tipo="text" class="form-control form-control-lg uppercase"
                                        id="apellidoM" placeholder="Ingrese su apellido materno" name="apellidoM"
                                        value="{{ old('apellidoM') }}">
                                    @error('apellidoM')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Correo Electronico <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-lg" id="email"
                                            placeholder="nombre_de_usuario" name="email" value="{{ old('email') }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text"
                                                style="color:black; height: 100%;">@utvtol.edu.mx</span>
                                        </div>
                                    </div>

                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- Seleccionar Docencia del estudiante --}}
                                <div class="form-group">
                                    <label for="direccion_id" class="form-label">Direccion de Carrera <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" aria-label="Seleccionar Empresa" name="direccion_id">
                                        <option selected>Seleccione una opcion</option>
                                        @foreach ($direcciones as $carrera)
                                            <option value="{{ $carrera->id }}"
                                                 data-direccion="{{  $carrera->direccion_id }}">
                                                {{ $carrera->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('direccion_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                                        type="submit">Guardar</button>
                                       <x-cancel-button url="{{ route('academicos.index') }}" />
                                            
>>>>>>> f57f20083a2decb167ed3140251ba15d87cdac3d
                                </div>
                                <div class="col-4">

                                    <div class="form-group">
                                        <label for="name">Nombre <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-lg" id="name" placeholder="Juan Perez Hermenegildo" name="name" value="{{ old('name') }}">
                                        @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="email">Correo Electronico <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control form-control-lg" id="email" placeholder="user@utvtol.edu.mx" name="email" value="{{ old('email') }}">
                                        @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="mt-3">
                                        <button class="btn btn-block btn-primary font-weight-medium auth-form-btn" type="submit">Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<<<<<<< HEAD
</div>
@endsection
=======
@endsection
>>>>>>> f57f20083a2decb167ed3140251ba15d87cdac3d
