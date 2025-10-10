<nav class="navbar navbar-expand-lg navbar-white bg-white fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <img src="{{ asset('assets/images/Logo-utvt.png') }}" alt="Logo UTVT" width="70px">
        </a>
        <h1>hola</h1>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('dashboard') }}">Inicio</a>
                </li>
                @isset(session()->get('direccion')->id)
                    @if ((Auth::user()->rol_id === 1 && session('direccion')) || Auth::user()->rol_id !== 3)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('estudiantes.index') }}">Estudiantes</a>
                        </li>
                    @endif
                @endisset
                @if ((Auth::user()->rol_id === 1 && session('direccion')) || Auth::user()->rol_id === 4)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('academicos.index') }}">Mentores Académicos</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="empresasDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Empresas
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="empresasDropdown">
                            <li><a class="dropdown-item" href="{{ route('empresas.index') }}">Unidades Económicas</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('mentores.index') }}">Mentores Industriales</a>
                            </li>
                        </ul>
                    </li>
                    @if (Auth::user()->rol_id === 1 || Auth::user()->rol_id === 4)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="direccionDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Dirección de Carrera
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="direccionDropdown">
                                @if (Auth::user()->rol_id === 1)
                                    <li><a class="dropdown-item" href="{{ route('direcciones.index') }}">Direccines
                                            Carrera</a></li>
                                    <li><a class="dropdown-item" href="{{ route('directores.index') }}">Directores de
                                            Carrera</a></li>
                                @endif
                                <li><a class="dropdown-item" href="{{ route('carreras.index') }}">Programas
                                        Educativos</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('estadisticas.index') }}">Estadísticas</a>
                        </li>
                    @endif
                @endif
            </ul>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('assets/images/logo-utvt-new.png') }}" alt="Profile image"
                            class="rounded-circle" width="30">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li class="dropdown-header text-center">
                            <img src="{{ asset('assets/images/logo-utvt-removebg-preview.png') }}" alt="Profile image"
                                class="rounded-circle" width="50">
                            <p class="mb-1 mt-3 font-weight-semibold">{{ Auth::user()->name }}</p>
                            <p class="fw-light text-muted mb-0">{{ Auth::user()->email }}</p>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Mi Perfil</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item">Cerrar Sesión</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
