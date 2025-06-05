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
            <div class="sidebar__logo" style="text-align: center; height: 12%;">
                <a href="" style="padding: 0;">
                    <img src="{{ asset('assets/images/loo-blanco.png') }}" alt="Logo" style="width: 50%; padding:0">
                </a>
            </div>
            <div class="sidebar__user-info p-2" style="background-color: red;">
                <div class="row align-items-center">
                    <!-- Columna del ícono -->
                    <div class="col-auto">
                        <div class="icon-user rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                            style="width: 40px; height: 40px; font-weight: bold;">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    </div>

                    <!-- Columna de información -->
                    <div class="col">
                        <div class="info-user">
                            <p class="user-rol mb-0">{{ Auth::user()->rol_id }}</p>
                            <p class="user-name mb-0">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="sidebar__nav">
                <a href="#">Inicio</a>
                <a href="#">Perfil</a>
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
                    <img src="{{ asset('assets/images/logo.png') }}" alt="perfil"
                        style="width: 25%; margin-left:15px">
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
