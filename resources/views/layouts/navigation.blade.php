@push('styles')
    <style>
        .navbar {
            backdrop-filter: blur(10px);
            height: 100px;
            /* Ajusta la altura del navbar */
        }

        .navbar-brand img {
            height: 100px;
            /* Ajusta la altura del logo */
            width: 150px;
        }
    </style>
@endpush

<nav class="navbar navbar-expand-lg navbar-light bg-slate-600 fixed-top shadow-black">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <img src="{{ asset('assets/images/Logo-utvt.png') }}" alt="Logo UTVT">
        </a>
        <div>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 d-sm-block d-lg-none">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('assets/images/logo-utvt-new.png') }}" alt="Profile image"
                            class="rounded-circle" width="30">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end text-center" aria-labelledby="userDropdown">
                        <li class="dropdown-header text-center">
                            <img src="{{ asset('assets/images/logo-utvt-removebg-preview.png') }}" alt="Profile image"
                                class="rounded-circle" width="50">
                            <p class="mb-1 mt-3 font-weight-semibold">{{ Auth::user()->name }}</p>
                            <p class="fw-light text-muted mb-0">{{ Auth::user()->email }}</p>
                        </li>
                        <li><a class="dropdown-item {{ request()->routeIs('profile.*') ? 'active' : '' }}"
                                href="{{ route('profile.edit') }}"><i class="mdi mdi-account-circle"></i> Mi Perfil</a>
                        </li>
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
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item-custom">
                    <a class="nav-link-custom {{ request()->routeIs('dashboard') ? 'active' : '' }}" aria-current="page"
                        href="{{ route('dashboard') }}"><i class="mdi mdi-home"></i><span>Inicio</span></a>
                </li>
                @isset(session()->get('direccion')->id)
                    @if ((Auth::user()->rol_id === 1 && session('direccion')) || Auth::user()->rol_id !== 3)
                        <li class="nav-item-custom">
                            <a class="nav-link-custom {{ request()->routeIs('estudiantes.*') ? 'active' : '' }}"
                                href="{{ route('estudiantes.index') }}"><i
                                    class="mdi mdi-school"></i><span>Estudiantes</span></a>
                        </li>
                    @endif
                @endisset
                @if ((Auth::user()->rol_id === 1 && session('direccion')) || Auth::user()->rol_id === 4)
                    <li class="nav-item-custom">
                        <a class="nav-link-custom {{ request()->routeIs('academicos.*') ? 'active' : '' }}"
                            href="{{ route('academicos.index') }}"><i class="mdi mdi-teach"></i><span>Mentores
                                Académicos</span></a>
                    </li>
                    <li class="nav-item-custom dropdown">
                        <a class="nav-link-custom dropdown-toggle" href="#" id="empresasDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-factory"></i><span>Empresas</span>
                        </a>
                        <ul class="dropdown-menu text-center" aria-labelledby="empresasDropdown">
                            <li><a class="dropdown-item" href="{{ route('empresas.index') }}"><i
                                        class="mdi mdi-domain"></i> Empresas</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('mentores.index') }}"><i
                                        class="mdi mdi-account-tie"></i> Mentores
                                    Industriales</a></li>
                        </ul>
                    </li>
                    @if (Auth::user()->rol_id === 1 || Auth::user()->rol_id === 4)
                        <li class="nav-item-custom dropdown">
                            <a class="nav-link-custom dropdown-toggle" href="#" id="direccionDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-map-marker"></i><span>Direcciones de Carrera</span>
                            </a>
                            <ul class="dropdown-menu text-center" aria-labelledby="direccionDropdown">
                                @if (Auth::user()->rol_id === 1)
                                    <li><a class="dropdown-item" href="{{ route('direcciones.index') }}"><i
                                                class="mdi mdi-map"></i>
                                            Dirección Carrera</a></li>
                                    <li><a class="dropdown-item" href="{{ route('directores.index') }}"><i
                                                class="mdi mdi-account-star"></i>
                                            Director de Carrera</a></li>
                                @endif
                                <li><a class="dropdown-item" href="{{ route('carreras.index') }}"><i
                                            class="mdi mdi-book-open"></i> Programas
                                        Educativos</a></li>
                            </ul>
                        </li>
                        <li class="nav-item-custom">
                            <a class="nav-link-custom {{ request()->routeIs('estadisticas.*') ? 'active' : '' }}"
                                href="{{ route('estadisticas.index') }}"><i class="mdi mdi-chart-bar"></i>
                                <span>Estadísticas</span></a>
                        </li>
                    @endif
                @endif
                <!-- Nuevo apartado de Anexos -->
                @if ((Auth::user()->rol_id === 1 && session('direccion')) || Auth::user()->rol_id === 4)
                    <li class="nav-item-custom dropdown">
                        <a class="nav-link-custom dropdown-toggle" href="#" id="anexosDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-file-document"></i><span>Anexos</span>
                        </a>
                        <ul class="dropdown-menu text-center" aria-labelledby="anexosDropdown">
                            <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle" href="#" role="button">Anexo 1</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('anexo1_1.index') }}">Anexo 1.1:
                                            Planeación y Difusión de
                                            la ED</a></li>
                                    <li><a class="dropdown-item" href="{{ route('anexo1_2.index') }}">Anexo 1.2:
                                            Programa de Difusión de la
                                            ED</a></li>
                                    <li><a class="dropdown-item" href="{{ route('anexo1_3.index') }}">Anexo 1.3:
                                            Formato de Registro de
                                            Interesados</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle" href="#" role="button">Anexo 2</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('anexo2_1.index') }}">Anexo 2.1:
                                            Evaluación y
                                            Selección de la UE</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 d-sm-none d-lg-block">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('assets/images/logo-utvt-new.png') }}" alt="Profile image"
                            class="rounded-circle" style="height: 80px; width: 80px;">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end text-center" aria-labelledby="userDropdown">
                        <li class="dropdown-header text-center">
                            <img src="{{ asset('assets/images/logo-utvt-removebg-preview.png') }}"
                                alt="Profile image" class="rounded-circle" style="height: 120px; width: 120px;">
                            <p class="mb-1 mt-3 font-weight-semibold">{{ Auth::user()->name }}</p>
                            <p class="fw-light text-muted mb-0">{{ Auth::user()->email }}</p>
                        </li>
                        <li><a class="dropdown-item {{ request()->routeIs('profile.*') ? 'active' : '' }}"
                                href="{{ route('profile.edit') }}"><i class="mdi mdi-account-circle"></i> Mi
                                Perfil</a></li>
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

@push('scripts')
    <script src="{{ asset('js/navbar.js') }}"></script>
@endpush
