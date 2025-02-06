@extends('layouts.guest')
@section('title','Login')
@section('content')
    <div class="container-scroller d-flex align-items-center justify-content-center">
        <div class="background-image"></div>
        <div class="overlay"></div>
        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
            <div class="brand-logo text-center">
                <img src="{{ asset('assets/images/logo-utvt-removebg-preview.png')}}" alt="Cuervo Logo" width="100">
            </div>
            <h2 class="fw-light text-center">Inicia Sesión</h2>

            <form class="pt-3" action="{{ route('login') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="email">Correo Electronico</label>
                    <input type="email" class="form-control form-control-lg" id="email" placeholder="user@utvtol.edu.mx" name="email" value="{{ old('email') }}">
                    @error('email')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" class="form-control form-control-lg" id="password" placeholder="*************" name="password">
                    @error('password')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mt-3">
                    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit">Iniciar Sesión</button>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                        <label class="form-check-label text-muted">
                            <input type="checkbox" class="form-check-input">
                            Mantener Sesion Iniciada
                        </label>
                    </div>
                    <a href="{{ route('password.request') }}" class="auth-link text-black">Olvidaste tu contraseña?</a>
                </div>
            </form>
        </div>
    </div>

    <style>
        .container-scroller {
            height: 100vh;
            display: flex;
            position: relative;
        }

        .background-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('{{ asset('assets/images/rectoriajpg.jpg') }}') no-repeat center center;
            background-size: cover;
            z-index: -2;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: -1;
        }

        .auth-form-light {
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 1;
        }

        .brand-logo img {
            border-radius: 50%;
        }
    </style>
@endsection
