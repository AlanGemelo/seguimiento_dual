@extends('errors.layout')

@section('title', __('Page Expired'))
@section('code', '419')
@section('message', __('¡Tiempo Agotado!'))

@section('description')
    <p>¡OPSS! Por seguridad, esta ventana ha caducado. Simplemente vuelve a intentar la acción.</p>
@endsection


@section('action')
    <a href="{{ url('/') }}" class=" btn-home">Ir al Inicio</a>
    <a href="javascript:location.reload()" class="btn-home-secondary">Recargar Página</a>
@endsection


{{-- Sección de la imagen --}}
@section('image', asset('images/errors/404.png'))
