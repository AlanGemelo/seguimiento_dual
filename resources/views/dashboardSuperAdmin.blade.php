@extends('layouts.app')
@section('title', 'Dashboard')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection

@section('content')

    <div class="container-fluid py-4">

        {{-- ALERTAS --}}
        @if (session('status'))
            <div class="alert alert-success shadow-sm">
                <strong>Excelente:</strong> {{ session('status') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-warning shadow-sm">
                <strong>Atención:</strong> Selecciona una dirección para continuar.
            </div>
        @endif


        {{-- HEADER --}}
        <div class="mb-4">
            <h3 class="fw-bold">Panel Administrativo</h3>
            <p class="text-muted">
                Sistema de Gestión de Educación Dual
            </p>
        </div>


        {{-- ESTADISTICAS --}}
        <div class="row mb-4">

            <div class="col-md-4">
                <div class="card shadow-sm border-0 stat-card">
                    <div class="card-body text-center">
                        <i class="mdi mdi-office-building mdi-36px text-success mb-2"></i>
                        <h3 class="fw-bold">{{ $direcciones->count() }}</h3>
                        <p class="text-muted mb-0">Direcciones Académicas</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm border-0 stat-card">
                    <div class="card-body text-center">
                        <i class="mdi mdi-school mdi-36px text-primary mb-2"></i>
                        <h3 class="fw-bold">
                            {{ $direcciones->sum(fn($d) => $d->programas->count()) }}
                        </h3>
                        <p class="text-muted mb-0">Programas Educativos</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm border-0 stat-card">
                    <div class="card-body text-center">
                        <i class="mdi mdi-account-group mdi-36px text-warning mb-2"></i>
                        <h3 class="fw-bold">--</h3>
                        <p class="text-muted mb-0">Estudiantes Activos</p>
                    </div>
                </div>
            </div>

        </div>



        {{-- DIRECCIONES --}}
        <div class="row">

            <div class="col-12 mb-3">
                <h5 class="fw-bold">Direcciones Académicas</h5>
                <p class="text-muted small">
                    Selecciona una dirección para administrar sus programas educativos
                </p>
            </div>

            @foreach ($direcciones as $direccion)
                <div class="col-md-6 col-xl-4 mb-4">

                    <div class="card shadow-sm h-100 dashboard-card border-0">

                        <div class="card-body text-center">

                            <img src="{{ asset('assets/images/logo-utvt-removebg-preview.png') }}" width="70"
                                class="mb-3">

                            <h5 class="fw-bold">
                                {{ $direccion->name }}
                            </h5>

                            <p class="text-muted mb-3">
                                {{ $direccion->programas->count() }} Programas Educativos
                            </p>

                            <a href="{{ route('direcciones.select', $direccion->id) }}" class="btn btn-success btn-sm px-4">

                                Acceder
                                <i class="mdi mdi-arrow-right"></i>

                            </a>

                        </div>

                    </div>

                </div>
            @endforeach

        </div>

    </div>

@endsection
