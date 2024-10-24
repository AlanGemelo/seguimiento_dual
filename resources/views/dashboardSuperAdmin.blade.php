@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div class="row">
        <div class="col-12 grid-margin">
            @if (session('status'))
                <div class="alert alert-success alert-dismissible text-dark" role="alert">
                    <span class="text-sm"> <a href="javascript:" class="alert-link text-dark">Excelente</a>.
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
                    @foreach($direcciones as $direccion)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <a href="{{ route('direcciones.select', $direccion->id) }}" class="card-link" style="text-decoration: none">

                        <div class="card shadow card-hover animate__animated animate__flipInY" style="animation-delay: {{ $loop->index * 0.5 }}s; height: 100%;">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <!-- Ícono -->
                                <div class="d-flex justify-content-center mb-3">
                                    <i class="mdi mdi-school btn-icon-prepend" style="font-size: 2rem;"></i>
                                </div>
                                <!-- Nombre de la dirección -->
                                <h5 class="card-title text-center">{{ $direccion->name }}</h5>
                                <!-- Programas educativos -->
                                <p class="card-text text-muted text-center">
                                    Programas educativos disponibles: {{ $direccion->programas->count() }} <!-- Ejemplo -->
                                </p>
                                <!-- Botón interactivo -->
                                <div class="d-flex justify-content-center mt-auto">
                                    <a href="{{ route('carreras.index', $direccion->id) }}" class="btn btn-primary btn-gradient">
                                        Ver Programas
                                    </a>
                                </div>
                            </div>
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
    </div>
@endsection

