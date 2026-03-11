@extends('errors.layout')

@section('title', __('Page Expired'))
@section('code', '419')
@section('message', __('¡Tiempo Agotado!'))

@section('description')
    <p>¡OPSS! Por seguridad, esta ventana ha caducado. Simplemente vuelve a intentar la acción.</p>
@endsection


@section('action')
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn-logout">
        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
    </a>
@endsection


{{-- Sección de la imagen --}}
@section('image', asset('images/errors/404.png'))
