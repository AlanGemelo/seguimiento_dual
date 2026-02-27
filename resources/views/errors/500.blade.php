@extends('errors.layout')

@section('title', 'Error interno del servidor')
@section('code', '500')

@section('message', '¡Ups! Algo salió mal en nuestro servidor.')

@section('description')
    <p>Estamos trabajando para solucionar este problema. Por favor, intenta nuevamente más tarde.</p>
@endsection

@section('action')
      <a href="javascript:history.go(-1)" class="btn-home">Volver atrás</a>
@endsection

{{-- Sección de la imagen --}}
@section('image', asset('assets/images/errors/error-505-cuervo.webp'))