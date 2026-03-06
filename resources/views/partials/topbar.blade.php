<header class="topbar">

    <div class="topbar-left">
        <button id="openSidebar" class="btn-toggle">
            <i class="mdi mdi-menu"></i>
        </button>
    </div>
    <div class="topbar-center">
        <img src="{{ asset('assets/images/Logo-utvt.png') }}" class="logo">

        <span class="system-name">
            Sistema de Educación Dual
        </span>
    </div>

    <div class="topbar-right">
        <!-- Notificaciones -->
        {{-- <button class="topbar-icon">
            <i class="mdi mdi-bell-outline"></i>
        </button> --}}

        <!-- Usuario -->
        <!-- Usuario -->
        <div class="dropdown">
            <img src="{{ asset('assets/images/logo-utvt-new.png') }}" class="avatar dropdown-toggle"
                data-bs-toggle="dropdown" alt="Usuario">
            <i class="mdi mdi-menu-down"></i> <!-- Icono de flecha -->

            <ul class="dropdown-menu dropdown-menu-end">
                <li class="dropdown-header text-center">
                    <strong>{{ Auth::user()->name }}</strong><br>
                    <small>{{ Auth::user()->email }}</small>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                        <i class="mdi mdi-account-circle"></i> Mi Perfil
                    </a>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="dropdown-item">
                            <i class="mdi mdi-logout"></i> Cerrar Sesión
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</header>
