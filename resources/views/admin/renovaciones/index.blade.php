@extends('layouts.app')
@section('title', 'Gestión de Documentación')

@php
    $activeTab = request('tab', 'dual');
@endphp

@section('styles')
    <style>
        /* Tabs personalizadas */
        .nav-tabs {
            border-bottom: 1px solid #dee2e6;
        }

        .nav-tabs .nav-link {
            border: none;
            color: #6c757d;
            font-weight: 500;
            padding: 10px 15px;
        }

        .nav-tabs .nav-link.active {
            color: #006837;
            border-bottom: 3px solid #006837;
            background: transparent;
        }

        .nav-tabs .nav-link:hover {
            color: #006837;
        }

        /* Card más limpia */
        .card-custom {
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border-top: 3px solid #006837;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card card-custom">

                {{-- HEADER --}}
                <div class="card-header-adjusted d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-0 fw-semibold">
                            Gestión de Documentación
                        </h5>
                        <small class="text-muted">
                            Control de vencimientos y renovaciones
                        </small>
                    </div>
                </div>

                {{-- BODY --}}
                <div class="card-body">

                    {{-- ALERTAS --}}
                    <x-alerts.flash-messages />

                    {{-- TABS --}}
                    <ul class="nav nav-tabs mb-3" id="estudiantesTabs" role="tablist">

                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $activeTab === 'dual' ? 'active' : '' }}" data-bs-toggle="tab"
                                data-bs-target="#dual" type="button" role="tab">

                                <i class="mdi mdi-alert-circle-outline me-1"></i>
                                Estudiantes Dual
                            </button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $activeTab === 'empresas' ? 'active' : '' }}" data-bs-toggle="tab"
                                data-bs-target="#empresas" type="button" role="tab">

                                <i class="mdi mdi-office-building me-1"></i>
                                Empresas
                            </button>
                        </li>

                    </ul>

                    {{-- CONTENIDO --}}
                    <div class="tab-content pt-2">

                        {{-- TAB ESTUDIANTES --}}
                        <div class="tab-pane fade {{ $activeTab === 'dual' ? 'show active' : '' }}" id="dual"
                            role="tabpanel">

                            @include('admin.renovaciones.tabs.dual')
                        </div>

                        {{-- TAB EMPRESAS --}}
                        <div class="tab-pane fade {{ $activeTab === 'empresas' ? 'show active' : '' }}" id="empresas"
                            role="tabpanel">

                            @include('admin.renovaciones.tabs.empresas')
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

{{-- MODALS --}}
@section('modals')
@endsection

{{-- SCRIPTS --}}
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => {
                new bootstrap.Tooltip(el)
            });
        });
    </script>
@endpush
