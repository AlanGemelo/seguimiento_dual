@extends('layouts.guest')
@section('title', 'Login')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

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

                    <div class="input-group">
                        <input type="password" class="form-control form-control-lg" id="password"
                            placeholder="*************" name="password">

                        <div class="input-group-append">
                            <span class="input-group-text" id="togglePassword" style="cursor: pointer; min-height: 100%">
                                <i class="mdi mdi-eye"></i>
                            </span>
                        </div>
                    </div>

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
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        const icon = togglePassword.querySelector('i');

        togglePassword.addEventListener('click', function() {
            const isPassword = password.getAttribute('type') === 'password';

            password.setAttribute('type', isPassword ? 'text' : 'password');

            icon.classList.toggle('mdi-eye');
            icon.classList.toggle('mdi-eye-off');
        });
    </script>
@endsection
