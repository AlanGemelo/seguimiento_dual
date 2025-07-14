@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <div class="row">
        <div class="col-12 grid-margin">
            @if (session('status'))
                <div class="alert alert-notification alert-notification--success" role="alert">
                    <span class="text-sm"> <a href="javascript:" class="alert-notification__link">Excelente</a>.
                        {{ session('status') }}.</span>

                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <strong>!Por favooor!!!</strong> Selecciona una direccion para continuar.

                </div>
            @endif

            <div class="container my-5">
                <div class="row">
                    @foreach ($direcciones as $direccion)
                        <div class="col-12 mb-4">
                            <a href="{{ route('direcciones.select', $direccion->id) }}" class="link-unstyled">
                                <div class="card shadow card-horizontal animate__animated animate__fadeIn">
                                        <!-- Ícono -->
                                        <div class="card-icon-container-horizontal">
                                             <img src="{{ asset('assets/images/logo-utvt-removebg-preview.png') }}" alt="Cuervo Logo" width="100">
                                        </div>
                                        <!-- Nombre de la dirección -->
                                        <div class="card-content-horizontal">
                                            <div class="card-text-container">
                                        <h3 class="card-title horizontal">{{ $direccion->name }}</h3>
                                        <!-- Programas educativos -->
                                        <p class="card-text horizontal">
                                            Programas educativos disponibles: {{ $direccion->programas->count() }}
                                            <!-- Ejemplo -->
                                        </p>
                                            </div>
                                        <!-- Botón interactivo -->
                                            <a href="{{ route('direcciones.select', $direccion->id) }}"
                                                class="btn btn-primary btn-horizontal">
                                                Ver Programas Educativos <i class="mdi mdi-arrow-right"></i>
                                            </a>
                                        </diV>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>


            {{-- <div class="bg-white shadow-lg rounded-lg p-8 max-w-md w-full">
                <div class="bg-gray-800 text-white py-4 px-6 rounded-t-lg text-center">
                    <h2 class="text-xl font-bold">Universidad XYZ</h2>
                </div>
                <div class="p-6">
                    <p class="text-gray-700 mb-4">Estimado(a) Profesor(a),</p>
                    <p class="text-gray-700 mb-4">
                        Le informamos que la documentación del alumno <strong>Alan Ortega</strong> está próxima a caducar.
                        Le solicitamos su colaboración para revisar y actualizar los documentos necesarios antes de la fecha
                        de vencimiento.
                    </p>
                    <p class="text-gray-700">Agradecemos su atención a este asunto.</p>
                </div>
              


            </div>
            <div class="bg-white shadow-lg rounded-lg p-8 max-w-md w-full">
                <div class="bg-gray-800 text-white py-4 px-6 rounded-t-lg text-center">
                    <h2 class="text-xl font-bold">Universidad XYZ</h2>
                </div>
                <div class="p-6">
                    <p class="text-gray-700 mb-4">
                        Lista de documentaciones próximas a vencer:
                    </p>
                    <ul class="list-disc list-inside space-y-2">
                        <li class="bg-gray-100 p-2 rounded-md">Alan Ortega - Certificado de Estudios - Vence: 15 de Septiembre</li>
                        <li class="bg-gray-100 p-2 rounded-md">Maria López - Acta de Nacimiento - Vence: 18 de Septiembre</li>
                        <li class="bg-gray-100 p-2 rounded-md">Carlos Pérez - Identificación Oficial - Vence: 20 de Septiembre</li>
                    </ul>
                </div>
                <div class="text-center mt-6">
                    <p class="text-sm text-gray-500">Atentamente,</p>
                    <p class="text-sm text-gray-500">Coordinación Administrativa, Universidad XYZ</p>
                </div>
            </div> --}}


        </div>
    </div>

@endsection
