@extends('errors.layout')

@section('title', 'Acceso denegado')
@section('code', '403')

@section('message', '¡Lo sentimos! No tienes permiso para acceder a esta página.')

@section('description')
    <p>Puede que no tengas autorización o tu sesión haya expirado.</p>
@endsection

@section('action')
    <a href="javascript:history.go(-1)" class="btn-home">Volver atrás</a>
@endsection

@section('image', asset('assets/images/errors/error-403-cuervo.webp'))