<header class="topbar">

    <div class="topbar-left">
        <button id="openSidebar" class="btn-toggle">
            <i class="mdi mdi-menu"></i>
        </button>
    </div>
    <div class="topbar-center">
        <img src="{{ asset('assets/images/Logo-utvt.png') }}" class="logo">

        <a href="{{ route('dashboard') }}" class="d-flex align-items-center text-decoration-none">
            <span class="system-name fw-bold text-dark">
                Sistema de Educación Dual
            </span>
        </a>
    </div>

    <div class="topbar-right">
        <!-- Notificaciones -->
        {{-- <button class="topbar-icon">
            <i class="mdi mdi-bell-outline"></i>
        </button> --}}

        <!-- Usuario -->
        <div class="dropdown">
            <img src="{{ asset('assets/images/logo-utvt-new.png') }}" class="avatar dropdown-toggle"
                data-bs-toggle="dropdown" alt="Usuario">
            <i class="mdi mdi-menu-down"></i> <!-- Icono de flecha -->

            <ul class="dropdown-menu dropdown-menu-end">
                <li class="dropdown-header text-center py-2">
                    <div style="font-size: 0.65rem; color:#6c757d;">
                        {{ Auth::user()->titulo }}
                    </div>

                    <div class="fw-semibold" style="font-size: 0.9rem; line-height: 1.2;">
                        {{ Auth::user()->name }}
                    </div>

                    <div style="font-size: 0.8rem; color:#6c757d;">
                        {{ Auth::user()->apellidoP }} {{ Auth::user()->apellidoM }}
                    </div>

                    <div class="mt-1" style="font-size: 0.75rem; color:#adb5bd;">
                        {{ Auth::user()->email }}
                    </div>
                </li>
                <hr>
                <li>
                    <a class="dropdown-item" href="{{ route('profile.index') }}">
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
