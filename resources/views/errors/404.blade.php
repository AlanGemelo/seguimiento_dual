@extends('errors.layout')

@section('title', 'Página no encontrada')
@section('code', '404')

@section('message', '¡Lo sentimos! No pudimos encontrar la página que estás buscando.')

@section('description')
    <p>Tal vez puedas econtrarla desde la pagina principal.</p>
@endsection

@section('action')
      <a href="javascript:history.go(-1)" class="btn-home">Volver atrás</a>
@endsection

{{-- Sección de la imagen --}}
@section('image', asset('assets/images/errors/error-404-cuervo.webp'))
