@extends('layouts.app')
@section('title', 'Administración')

@php
$activeTab = session('activeTab', 'usuarios');
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
        transition: background-color 0.2s, color 0.2s;
    }

    .github-sidebar .list-group-item.active {
        background-color: #f6f8fa;
        font-weight: 600;
        border-left: 3px solid #006837;
        color: #006837;
    }

    .github-sidebar .list-group-item:not(.active):hover {
        background-color: #eaecef;
        cursor: pointer;
        color: #006837;
    }

    .github-sidebar span {
        color: #006837;
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
</style>
@endsection

@section('content')

<div class="github-settings">

    <!-- ENCABEZADO -->
    <div class="mb-4">
        <h3 class="mb-0">
            Administración del Sistema
        </h3>

        <div class="text-muted small">
            Gestión de usuarios y copias de seguridad
        </div>

        <x-alerts.flash-messages />

        <hr>
    </div>

    <div class="row">

        <!-- SIDEBAR -->
        <div class="col-md-3">
            @include('administracion.partials.sidebar')
        </div>

        <!-- CONTENIDO -->
        <div class="col-md-9">

            <div class="tab-content">

                <!-- USUARIOS -->
                <div class="tab-pane fade {{ $activeTab == 'usuarios' ? 'show active' : '' }}"
                    id="usuarios"
                    role="tabpanel">

                    @include('administracion.forms.usuarios')

                </div>

                <!-- PASSWORD RESET -->
                <div class="tab-pane fade {{ $activeTab == 'password-reset' ? 'show active' : '' }}"
                    id="password-reset"
                    role="tabpanel">

                    @include('administracion.forms.password-reset')

                </div>

                <!-- BACKUPS -->
                <div class="tab-pane fade {{ $activeTab == 'backups' ? 'show active' : '' }}"
                    id="backups"
                    role="tabpanel">

                    @include('administracion.forms.backups')

                </div>

            </div>

        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    let searching = false;

    document.getElementById('btnBuscar').addEventListener('click', buscarUsuario);

    document.getElementById('search-email').addEventListener('keydown', (e) => {
        if (e.key === 'Enter') {
            e.preventDefault();
            buscarUsuario();
        }
    });

    async function buscarUsuario() {
        if (searching) return;

        const email = document.getElementById('search-email').value.trim();

        if (!email) {
            alert('Ingresa un correo');
            return;
        }

        searching = true;

        try {
            const res = await fetch(
                `/administracion/usuario/buscar?email=${encodeURIComponent(email)}`
            );

            const data = await res.json();

            if (!res.ok || !data.success) {
                alert(data.message || 'Usuario no encontrado');
                limpiarDatos();
                return;
            }

            document.getElementById('full-name').innerText = data.data.nombre;
            document.getElementById('role').innerText = data.data.rol;
            document.getElementById('user-email').innerText = data.data.email;

        } catch (error) {
            console.error(error);
            alert('Error de conexión');
        } finally {
            searching = false;
        }
    }

    function limpiarDatos() {
        document.getElementById('full-name').innerText = '-';
        document.getElementById('role').innerText = '-';
        document.getElementById('user-email').innerText = '-';
    }
</script>
@endsection