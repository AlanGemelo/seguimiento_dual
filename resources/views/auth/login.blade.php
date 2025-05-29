@extends('layouts.guest')
@section('title', 'Login')
@section('content')
    <div class="container-scroller d-flex align-items-center justify-content-center">
        <div class="background-image"></div>
        <div class="overlay"></div>
        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
            <div class="brand-logo text-center">
                <img src="{{ asset('assets/images/logo-utvt-removebg-preview.png') }}" alt="Cuervo Logo" width="100">
            </div>
            <div class="title-login">
                <h2 class="fw-light text-center">Iniciar sesión</h2>
            </div>

            <form class="pt-3" action="{{ route('login') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="email">Correo electrónico</label>
                    <input type="email" class="form-control form-control-lg" id="email"
                        placeholder="user@utvtol.edu.mx" name="email" value="{{ old('email') }}">
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" class="form-control form-control-lg" id="password" placeholder="*************"
                        name="password">
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mt-3 d-flex justify-content-center">
                    <button class="btn btn-primary btn-lg font-weight-medium auth-form-btn" type="submit">Iniciar
                        Sesión</button>
                </div>

                <div class="my-2 d-flex justify-content-between align-items-center">
                    <div class="form-check mb-0">
                        <label class="form-check-label text-muted d-flex align-items-center" style="font-size: 14px;">
                            <input type="checkbox" class="form-check-input me-2" style="width: 16px; height: 16px;">
                            Mantener la sesión iniciada
                        </label>
                    </div>
                    <div>
                        <a href="{{ route('password.request') }}" class="auth-link forgot-password-link ms-3"
                            style="font-size: 14px;">
                            ¿Olvidó su contraseña?
                        </a>
                    </div>
                </div>
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

        .title-login {
            margin-top: 5%;
        }

        .auth-form-light h2 {
            color: #006837;
            font-weight: 600 !important;
        }

        .form-control {
            border: 1px solid #ccc;
            border-radius: 8px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .form-control:focus {
            border-color: #004D40;
            box-shadow: 0 0 0 2px rgba(0, 109, 91, 0.2);
        }

        .btn-primary {
            background-color: #006837;
            border: none;
            color: white;
        }

        .btn-primary:hover {
            background-color: #66BB6A;
            color: white;
        }

        .auth-link {
            color: #F4B400;
        }

        .auth-link:hover {
            color: #004D40;
            text-decoration: underline;
        }

        .form-check-label {
            color: #2E2E2E;
        }

        .brand-logo img {
            border-radius: 50%;
            background-color: #FFFFFF;
            padding: 8px;
            border: 2px solid #006837;
        }

        .forgot-password-link {
            color: #2e2e2e;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .forgot-password-link:hover {
            color: #004D40;
            /* azul petróleo */
            text-decoration: underline;
        }
    </style>
@endsection
