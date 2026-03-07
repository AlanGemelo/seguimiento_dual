@extends('layouts.app')
@section('title', 'Perfil')

@php
    $activeTab = session('activeTab', 'perfil'); // Perfil por defecto
@endphp

@section('styles')
    <style>
        .github-settings {
            background: #f6f8fa;
            padding: 30px;
        }

        .github-sidebar {
            background: white;
            border: 1px solid #d0d7de;
            border-radius: 6px;
            min-height: 100%;
        }

        .github-sidebar .list-group-item {
            border: none;
            padding: 10px 16px;
        }

        .github-sidebar .list-group-item.active {
            background: #f6f8fa;
            font-weight: 600;
            border-left: 3px solid #006837;
        }

        .github-sidebar span {
            color: #006837;
        }

        .profile-avatar {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 1px solid #d0d7de;
        }

        .settings-section {
            background: white;
            border: 1px solid #d0d7de;
            border-radius: 6px;
            padding: 24px;
        }

        .settings-title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .tab-content {
            padding: 0;
        }

        /* Mantener el estilo del item activo al hacer hover */
        .github-sidebar .list-group-item.active {
            background-color: #f6f8fa;
            /* color de fondo del activo */
            font-weight: 600;
            /* texto en negrita */
            border-left: 3px solid #006837;
            /* borde izquierdo */
            color: #006837;
            /* texto activo */
            pointer-events: auto;
            /* evitar que hover lo sobrescriba */
        }

        /* Hover solo en items que NO están activos */
        .github-sidebar .list-group-item:not(.active):hover {
            background-color: #eaecef;
            /* color de hover para items inactivos */
            cursor: pointer;
            /* puntero al pasar mouse */
            color: #006837;
            /* opcional, cambiar color texto al hover */
        }

        /* Opcional: suavizar la transición */
        .github-sidebar .list-group-item {
            transition: background-color 0.2s, color 0.2s;
        }
    </style>
@endsection

@section('content')
    <div class="github-settings">
        <!-- ENCABEZADO -->
        <div class="mb-4">
            <h3 class="mb-0">
                {{ auth()->user()->name }} {{ auth()->user()->apellidoP }} {{ auth()->user()->apellidoM }}
            </h3>
            <div class="text-muted small">{{ auth()->user()->email }}</div>
            <x-alerts.flash-messages />
            <hr>
        </div>

        <div class="row">
            <!-- SIDEBAR -->
            <div class="col-md-3">
                @include('profile.partials.sidebar')
            </div>

            <!-- CONTENIDO -->
            <div class="col-md-9">
                <div class="tab-content">
                    <!-- PERFIL -->
                    <div class="tab-pane fade {{ $activeTab == 'perfil' ? 'show active' : '' }}" id="perfil">
                        @include('profile.forms.perfil')
                    </div>

                    <!-- CONTRASEÑA -->
                    <div class="tab-pane fade {{ $activeTab == 'password' ? 'show active' : '' }}" id="password">
                        @include('profile.forms.password')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
