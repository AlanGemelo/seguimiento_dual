@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <section id="section-dashboard">
        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Excelente:</strong> {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>¡Por favor!</strong> Selecciona una dirección para continuar.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endif

        <div class="container my-4">
            <h2 class="mb-4 fw-bold text-success text-center">Explora las Direcciones disponibles</h2>
            <div class="row">
                @foreach ($direcciones as $direccion)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card shadow border-0 h-100 animate__animated animate__fadeInUp"
                            style="animation-delay: {{ $loop->index * 0.2 }}s;">
                            <div class="card-body d-flex flex-column text-center">
                                <div class="mb-3">
                                    <i class="mdi mdi-school" style="font-size: 2.5rem; color: #006837;"></i>
                                </div>
                                <h5 class="card-title fw-bold text-dark">{{ $direccion->name }}</h5>
                                <p class="card-text text-muted">
                                    Programas educativos disponibles: <strong>{{ $direccion->programas->count() }}</strong>
                                </p>
                                <div class="mt-auto">
                                    <a href="{{ route('direcciones.select', $direccion->id) }}"
                                        class="btn btn-outline-success w-100">
                                        Ver Programas
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
