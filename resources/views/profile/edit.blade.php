@extends('layouts.app')
@section('title', 'Perfil')

@section('content')
    <div class="row">

        <!-- Menu izquierdo -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Perfil</div>
                <div class="list-group list-group-flush">
                    <a href="{{ route('profile.index') }}" class="list-group-item active">Datos personales</a>
                    <a href="{{ route('profile.edit') }}" class="list-group-item">Cambiar contraseña</a>
                </div>
            </div>
        </div>

        <!-- Vista derecha -->
        <div class="col-md-8">

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
        </div>

    </div>
@endsection
