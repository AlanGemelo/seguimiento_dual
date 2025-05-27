<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar col-2">
            <div class="sliderbar-header" style="text-align: center;">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" style="width: 40%;">
            </div>
            <div class="silderbar-content">
                <a href="#">Inicio</a>
                <a href="#">Usuarios</a>
                <a href="#">Configuración</a>
                <a href="#">Cerrar sesión</a>
            </div>
        </div>

        <!-- Main content -->
        <div class="col-10 p-0">
            <!-- Navbar -->
            <nav class="navbar navbar-expand navbar-light bg-light navbar-custom" style="padding-left:1rem ">
                <span class="navbar-header">Dashboard</span>
                <div class="ms-auto">
                    <span>Bienvenido, {{ Auth::user()->name }}</span>
                </div>
                <div class="profile">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="perfil" style="width: 25%; margin-left:15px">
                </div>
            </nav>
            <!-- Content -->
            <main class="p-4">
                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>
