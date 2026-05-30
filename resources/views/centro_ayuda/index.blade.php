@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="card shadow-sm border-0">

        <div class="card-header bg-white">
            <h4 class="mb-0">
                <i class="mdi mdi-lifebuoy text-success"></i>
                Centro de Ayuda
            </h4>
        </div>

        <div class="card-body">

            {{-- Tabs --}}
            <ul class="nav nav-tabs mb-4" id="helpTabs" role="tablist">

                <li class="nav-item">
                    <button class="nav-link active"
                        data-bs-toggle="tab"
                        data-bs-target="#general">
                        General
                    </button>
                </li>

                <li class="nav-item">
                    <button class="nav-link"
                        data-bs-toggle="tab"
                        data-bs-target="#alumnos">
                        Estudiantes
                    </button>
                </li>
                @if (Auth::user()->rol_id === 1 || Auth::user()->rol_id === 4)
                <li class="nav-item">
                    <button class="nav-link"
                        data-bs-toggle="tab"
                        data-bs-target="#empresas">
                        Empresas
                    </button>
                </li>
                @endif

                <!-- <li class="nav-item">
                    <button class="nav-link"
                            data-bs-toggle="tab"
                            data-bs-target="#usuarios">
                        Usuarios
                    </button>
                </li> -->

            </ul>

            {{-- Contenido --}}
            <div class="tab-content">

                <div class="tab-pane fade show active" id="general">
                    @include('centro_ayuda.partials._general')
                </div>

                <div class="tab-pane fade" id="alumnos">
                    @include('centro_ayuda.partials._alumnos')
                </div>

                <div class="tab-pane fade" id="empresas">
                    @include('centro_ayuda.partials._empresas')
                </div>

                <div class="tab-pane fade" id="usuarios">
                    @include('centro_ayuda.partials._usuarios')
                </div>

            </div>

        </div>

    </div>

</div>

@endsection