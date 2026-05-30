@extends("layouts.guest")
@section("title", "Recuperar Cuenta")
@section('styles')
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
        background: url('{{ asset(' assets/images/rectoriajpg.jpg') }}') center center / cover no-repeat;
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
@section("content")
<div class="container-scroller d-flex align-items-center justify-content-center">
    <div class="background-image"></div>
    <div class="overlay"></div>
    <div class="auth-form-light text-left py-5 px-4 px-sm-5">
        <div class="brand-logo text-center">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Cuervo Logo" width="100">
        </div>
        <h2 class="fw-light text-center">Recuperar Cuenta</h2>

        <div class="alert alert-warning mt-4">
            La recuperación automática de cuentas no está disponible.
            Por favor contacte al administrador del sistema para solicitar el restablecimiento de su acceso.
        </div>

        <div class="text-center mt-3">
            <a href="{{ route('login') }}" class="btn btn-primary">
                Volver al inicio de sesión
            </a>
        </div>
    </div>
</div>
@endsection