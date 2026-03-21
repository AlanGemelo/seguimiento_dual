@extends ('errors.layout')

@section ('title', 'Método no permitido')
@section ('code', '405')

@section ('message', '¡Ups! Este método no está permitido para esta página.')

@section ('description')
    <p>Es posible que quieras volver atrás o contactar al administrador.</p>
@endsection

@section ('action')
    <a href="javascript:history.go(-1)" class="btn-home">Volver atrás</a>
@endsection

@section ('image', content: asset('assets/images/errors/error-405.webp'))
