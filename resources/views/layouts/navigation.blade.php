<nav class="navbar navbar-expand-lg navbar-light bg-slate-600 fixed-top shadow-black">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <img src="{{ asset('assets/images/Logo-utvt.png')}}" alt="Logo UTVT" width="70px">
        </a>
        <div>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 d-sm-block d-lg-none">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('assets/images/logo-utvt-new.png') }}" alt="Profile image" class="rounded-circle" width="30">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end text-center" aria-labelledby="userDropdown">
                        <li class="dropdown-header text-center">
                            <img src="{{ asset('assets/images/logo-utvt-removebg-preview.png') }}" alt="Profile image" class="rounded-circle" width="50">
                            <p class="mb-1 mt-3 font-weight-semibold">{{ Auth::user()->name }}</p>
                            <p class="fw-light text-muted mb-0">{{ Auth::user()->email }}</p>
                        </li>
                        <li><a class="dropdown-item {{ request()->routeIs('profile.*') ? 'active' : '' }}" href="{{ route('profile.edit') }}"><i class="mdi mdi-account-circle"></i> Mi Perfil</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item"><i class="mdi mdi-logout"></i> Cerrar Sesión</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" aria-current="page" href="{{ route('dashboard') }}"><i class="mdi mdi-home"></i> Inicio</a>
                </li>
                @isset(session()->get("direccion")->id)
                    @if ((Auth::user()->rol_id === 1 && session("direccion")) || Auth::user()->rol_id !== 3)
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('estudiantes.*') ? 'active' : '' }}" href="{{ route("estudiantes.index") }}"><i class="mdi mdi-school"></i> Estudiantes</a>
                        </li>
                    @endif
                @endisset
                @if ((Auth::user()->rol_id === 1 && session("direccion")) || Auth::user()->rol_id === 4)
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('academicos.*') ? 'active' : '' }}" href="{{ route("academicos.index") }}"><i class="mdi mdi-teach"></i> Mentores Académicos</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('empresas.*') || request()->routeIs('mentores.*') ? 'active' : '' }}" href="#" id="empresasDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-factory"></i> Empresas
                        </a>
                        <ul class="dropdown-menu text-center" aria-labelledby="empresasDropdown">
                            <li><a class="dropdown-item {{ request()->routeIs('empresas.*') ? 'active' : '' }}" href="{{ route("empresas.index") }}"><i class="mdi mdi-domain"></i> Empresa</a></li>
                            <li><a class="dropdown-item {{ request()->routeIs('mentores.*') ? 'active' : '' }}" href="{{ route("mentores.index") }}"><i class="mdi mdi-account-tie"></i> Mentor Industrial</a></li>
                        </ul>
                    </li>
                    @if (Auth::user()->rol_id === 1 || Auth::user()->rol_id === 4)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ request()->routeIs('direcciones.*') || request()->routeIs('directores.*') || request()->routeIs('carreras.*') ? 'active' : '' }}" href="#" id="direccionDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-map-marker"></i> Dirección de Carrera
                            </a>
                            <ul class="dropdown-menu text-center" aria-labelledby="direccionDropdown">
                                @if (Auth::user()->rol_id === 1)
                                    <li><a class="dropdown-item {{ request()->routeIs('direcciones.*') ? 'active' : '' }}" href="{{ route("direcciones.index") }}"><i class="mdi mdi-map"></i> Dirección Carrera</a></li>
                                    <li><a class="dropdown-item {{ request()->routeIs('directores.*') ? 'active' : '' }}" href="{{ route("directores.index") }}"><i class="mdi mdi-account-star"></i> Director de Carrera</a></li>
                                @endif
                                <li><a class="dropdown-item {{ request()->routeIs('carreras.*') ? 'active' : '' }}" href="{{ route("carreras.index") }}"><i class="mdi mdi-book-open"></i> Programa Educativo</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('estadisticas.*') ? 'active' : '' }}" href="{{ route("estadisticas.index") }}"><i class="mdi mdi-chart-bar"></i> Estadísticas</a>
                        </li>
                    @endif
                @endif
                <!-- Nuevo apartado de Anexos -->
                @if ((Auth::user()->rol_id === 1 && session("direccion")) || Auth::user()->rol_id === 4)
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('anexo1_1.*') || request()->routeIs('anexo1_2.*') || request()->routeIs('anexo1_3.*') || request()->routeIs('anexo2_1.*') ? 'active' : '' }}" href="#" id="anexosDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-file-document"></i> Anexos
                        </a>
                        <ul class="dropdown-menu text-center" aria-labelledby="anexosDropdown">
                            <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle" href="#">Anexo 1</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item {{ request()->routeIs('anexo1_1.*') ? 'active' : '' }}" href="{{ route('anexo1_1.index') }}">Anexo 1.1: Planeación y Difusión de la ED</a></li>
                                    <li><a class="dropdown-item {{ request()->routeIs('anexo1_2.*') ? 'active' : '' }}" href="{{ route('anexo1_2.index') }}">Anexo 1.2: Programa de Difusión de la ED</a></li>
                                    <li><a class="dropdown-item {{ request()->routeIs('anexo1_3.*') ? 'active' : '' }}" href="{{ route('anexo1_3.index') }}">Anexo 1.3: Formato de Registro de Interesados</a></li>
                                    <li class="dropdown-submenu">
                                        <a class="dropdown-item dropdown-toggle" href="#">Anexo 2</a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item {{ request()->routeIs('anexo2_1.*') ? 'active' : '' }}" href="{{ route('anexo2_1.index') }}">Anexo 2.1: Evaluación y Selección de la UE</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 d-sm-none d-lg-block">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('assets/images/logo-utvt-new.png') }}" alt="Profile image" class="rounded-circle" width="30">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end text-center" aria-labelledby="userDropdown">
                        <li class="dropdown-header text-center">
                            <img src="{{ asset('assets/images/logo-utvt-removebg-preview.png') }}" alt="Profile image" class="rounded-circle" width="50">
                            <p class="mb-1 mt-3 font-weight-semibold">{{ Auth::user()->name }}</p>
                            <p class="fw-light text-muted mb-0">{{ Auth::user()->email }}</p>
                        </li>
                        <li><a class="dropdown-item {{ request()->routeIs('profile.*') ? 'active' : '' }}" href="{{ route('profile.edit') }}"><i class="mdi mdi-account-circle"></i> Mi Perfil</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item"><i class="mdi mdi-logout"></i> Cerrar Sesión</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
    .navbar {
        backdrop-filter: blur(10px);
        height: 50px; /* Ajusta la altura del navbar */
    }

    .navbar-brand img {
        height: 40px; /* Ajusta la altura del logo */
    }

    .dropdown-menu {
        background-color: #f8f9fa; /* Color más claro */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Difuminado debajo de las opciones */
        transition: all 0.3s ease;
        position: absolute;
        z-index: 1000; /* Asegura que el dropdown esté por encima de todo */
    }

    .nav-item.dropdown:hover .dropdown-menu,
    .dropdown-item.active {
        display: block;
        transform: scale(1.05);
        background-color: #e9efed; /* Color más claro al hacer hover */
        color: black;
    }

    .dropdown-item:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Sombra negra */
    }

    .dropdown-menu-end {
        right: 0;
        left: auto;
    }

    @media (max-width: 991.98px) {
        .navbar-nav {
            text-align: center;
            width: 100%;
        }

        .nav-item {
            width: 100%;
        }

        .dropdown-menu {
            width: 100%;
        }

        #navbarNav {
            justify-content: center; /* Centrar el contenido en pantallas pequeñas */
        }

        #navbar-collapse {
            background-color: rgba(0, 0, 0, 0.7); /* Fondo oscuro con difuminado */
            backdrop-filter: blur(10px); /* Difuminado */
        }
    }

    /* Nuevas reglas para el efecto de escala en enlaces y botones */
    .navbar-nav .nav-link:hover,
    .navbar-nav .dropdown-item:hover,
    .navbar-nav .dropdown-toggle:hover,
    .navbar-nav .btn:hover {
        transform: scale(1.05);
        transition: transform 0.3s ease;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var dropdowns = document.querySelectorAll('.nav-item.dropdown');

    dropdowns.forEach(function(dropdown) {
        dropdown.addEventListener('click', function(event) {
            event.stopPropagation();
            var menu = this.querySelector('.dropdown-menu');
            var isOpen = menu.classList.contains('show');
            closeAllDropdowns();
            if (!isOpen) {
                menu.classList.add('show');
            }
        });
    });

    document.addEventListener('click', function() {
        closeAllDropdowns();
    });

    function closeAllDropdowns() {
        var menus = document.querySelectorAll('.dropdown-menu');
        menus.forEach(function(menu) {
            menu.classList.remove('show');
        });
    }
});
</script>

