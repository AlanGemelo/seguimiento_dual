@extends('errors.layout')

@section('title', 'Mantenimiento en curso')
@section('code', '503')

@section('message', 'Estamos realizando mantenimiento 😌')

@section('description')
    <p>Estamos mejorando el sitio para ti. Vuelve pronto.</p>
@endsection

@section('action')
    <a href="{{ url('/') }}" class="btn-home">Volver al inicio</a>
@endsection

{{-- Sección de la imagen 
@section('image', asset('assets/images/errors/maintenance.webp')) --}}
