@extends('layouts.app')
@section('title', 'Perfil')

@section('content')
    <div class="row">
        <div class="col-12 grid-margin">
            @if (session('status'))
                <div class="alert alert-success alert-dismissible text-dark" role="alert">
                    <span class="text-sm"> <a href="javascript:" class="alert-link text-dark">Excelente</a>.
                        {{ session('status') }}.</span>
                    <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Mi Perfil</h4>
                            <p class="card-description">Actualiza la información de tu perfil</p>
                            <span class="text-danger">* Campos requeridos</span>
                            <div class="dropdown-divider"></div>
                            <form method="post" action="{{ route('profile.update') }}" class="forms-sample">
                                @csrf
                                @method('patch')
                                <div class="form-group">
                                    <input type="text" name="id" value="{{ old('id', $user->id) }}"
                                        class="form-control" id="id" hidden>
                                </div>
                                <div class="form-group">
                                    <label for="name">Nombre (s)</label>
                                    <input type="text" data-tipo="text" name="name"
                                        value="{{ old('name', $user->name) }}" class="form-control" id="name">
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="apellidoP">Apellido Paterno</label>
                                    <input type="text" data-tipo="text" name="apellidoP"
                                        value="{{ old('apellidoP', $user->apellidoP) }}" class="form-control"
                                        id="apellidoP">
                                    @error('apellidoP')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="apellidoM">Apellido Materno</label>
                                    <input type="text" data-tipo="text" name="apellidoM"
                                        value="{{ old('apellidoM', $user->apellidoM) }}" class="form-control"
                                        id="apellidoM">
                                    @error('apellidoM')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Correo Electrónico</label>
                                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                        class="form-control" id="email">
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="d-flex justify-content-between">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="mdi mdi-content-save mdi-16px align-middle"></i>
                                        Actualizar Información
                                    </button>
                                    <a href="{{ route('dashboard') }}" class="btn btn-outline-danger">
                                        <i class="mdi mdi-close-circle-outline mdi-16px align-middle"></i>
                                        Cancelar
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Actualizar Contraseña</h4>
                            <p class="card-description">Actualiza tu contraseña</p>
                            <div class="dropdown-divider"></div>
                            @if ($errors->getBag('updatePassword')->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->getBag('updatePassword')->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form method="post" action="{{ route('password.update') }}" class="forms-sample">
                                @csrf
                                @method('put')
                                <div class="form-group">
                                    <label for="current_password">Contraseña Actual</label>
                                    <input type="password" name="current_password" id="current_password"
                                        class="form-control">
                                    @error('current_password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password">Nueva Contraseña</label>
                                    <input type="password" name="password" id="password" class="form-control">
                                    @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">Confirmar Nueva Contraseña</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        class="form-control">
                                    @error('password_confirmation')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="d-flex justify-content-between">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="mdi mdi-lock-outline mdi-16px align-middle"></i>
                                        Actualizar Contraseña
                                    </button>
                                    <a href="{{ route('dashboard') }}" class="btn btn-outline-danger">
                                        <i class="mdi mdi-close-circle-outline mdi-16px align-middle"></i>
                                        Cancelar
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
