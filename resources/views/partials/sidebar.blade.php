<aside class="sidebar" id="sidebar">
    <div class="header-sidebar">
        <img src="{{ asset('assets/images/Logo-utvt.png') }}" class="logo">

        <button id="closeSidebar" class="btn-toggle">
            <i class="mdi mdi-menu"></i>
        </button>

    </div>
    <nav class="sidebar-menu">
        @if (Auth::user()->rol_id == 1 && session()->has('direccion_id'))
            <li class="nav-item">
                <hr>
                <a href="{{ route('direcciones.reset') }}"
                    class="menu-item cambiar-carrera {{ request()->routeIs('direcciones.reset') ? 'active' : '' }}">
                    <i class="mdi mdi-swap-horizontal"></i>
                    <span>Cambiar Carrera</span>
                </a>
                <hr>
            </li>
        @endif
        @if (Auth::user()->rol_id == 1 && !session()->has('direccion_id'))

            <div class="sidebar-empty">
                <i class="mdi mdi-information-outline"></i>
                <p>Selecciona una dirección de carrera para comenzar.</p>


            </div>
        @else
            {{-- Seccion del Dashboard --}}
            <a href="{{ route('dashboard') }}" class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="mdi mdi-view-dashboard-outline"></i>
                <span>Dashboard</span>
            </a>

            @if ((Auth::user()->rol_id === 1 && session('direccion')) || Auth::user()->rol_id !== 3)
                {{-- Seccion de Estudiantes    --}}
                <a href="{{ route('estudiantes.index') }}"
                    class="menu-item {{ request()->routeIs('estudiantes.*') ? 'active' : '' }}">
                    <i class="mdi mdi-school-outline"></i>
                    <span>Estudiantes</span>
                </a>
            @endif

            @if ((Auth::user()->rol_id === 1 && session('direccion')) || Auth::user()->rol_id === 4)
                {{-- Seccion de Mentores Académicos     --}}
                <a href="{{ route('academicos.index') }}"
                    class="menu-item {{ request()->routeIs('academicos.*') ? 'active' : '' }}">
                    <i class="mdi mdi-account-tie-outline"></i>
                    <span>Mentores Académicos</span>
                </a>
            @endif

            @if ((Auth::user()->rol_id === 1 && session('direccion')) || Auth::user()->rol_id === 4)
                {{-- Seccion de Unidades Economicas    --}}
                <div class="menu-group">
                    <button
                        class="menu-item menu-toggle 
                    {{ request()->routeIs('empresas.*') || request()->routeIs('mentores.*') ? 'active-parent' : '' }}">

                        <i class="mdi mdi-domain"></i>
                        <span>Unidades Económicas</span>
                        <i class="mdi mdi-chevron-down arrow"></i>
                    </button>

                    <div
                        class="submenu 
                    {{ request()->routeIs('empresas.*') || request()->routeIs('mentores.*') ? 'open' : '' }}">

                        <a href="{{ route('empresas.index') }}"
                            class="submenu-item {{ request()->routeIs('empresas.*') ? 'active' : '' }}">
                            Unidades Económicas
                        </a>

                        <a href="{{ route('mentores.index') }}"
                            class="submenu-item {{ request()->routeIs('mentores.*') ? 'active' : '' }}">
                            Mentores Industriales
                        </a>

                    </div>
                </div>
            @endif

            @if (Auth::user()->rol_id === 1 || Auth::user()->rol_id === 4)

                {{-- Seccion de Direcciones de Carrera   --}}
                <div class="menu-group">
                    <button
                        class="menu-item menu-toggle
                    {{ request()->routeIs('direcciones.*') || request()->routeIs('directores.*') || request()->routeIs('carreras.*') ? 'active-parent' : '' }}">

                        <i class="mdi mdi-map-marker-outline"></i>
                        <span>Direcciones de Carrera</span>
                        <i class="mdi mdi-chevron-down arrow"></i>
                    </button>

                    <div
                        class="submenu
                    {{ request()->routeIs('direcciones.*') || request()->routeIs('directores.*') || request()->routeIs('carreras.*') ? 'open' : '' }}">

                        @if (Auth::user()->rol_id === 1)
                            <a href="{{ route('direcciones.index') }}"
                                class="submenu-item {{ request()->routeIs('direcciones.*') ? 'active' : '' }}">
                                Dirección Carrera
                            </a>

                            <a href="{{ route('directores.index') }}"
                                class="submenu-item {{ request()->routeIs('directores.*') ? 'active' : '' }}">
                                Director de Carrera
                            </a>
                        @endif

                        <a href="{{ route('carreras.index') }}"
                            class="submenu-item {{ request()->routeIs('carreras.*') ? 'active' : '' }}">
                            Programas Educativos
                        </a>

                    </div>
                </div>
            @endif

            {{-- Seccion Estadisticas --}}
            <div class="menu-group">
                <a href="{{ route('estadisticas.index') }}"
                    class="menu-item {{ request()->routeIs('estadisticas.*') ? 'active' : '' }}">
                    <i class="mdi mdi-chart-bar"></i>
                    <span>Estadísticas</span>
                </a>
            </div>
            {{-- Seccion Anexos --}}
            <div class="menu-group">

                <button
                    class="menu-item menu-toggle
        {{ request()->routeIs('anexo*') ? 'active-parent' : '' }}">

                    <i class="mdi mdi-file-document-outline"></i>
                    <span>Anexos</span>
                    <i class="mdi mdi-chevron-down arrow"></i>
                </button>

                <div class="submenu {{ request()->routeIs('anexo*') ? 'open' : '' }}">

                    <div class="submenu-group">

                        <div class="submenu-title">
                            <i class="mdi mdi-folder-outline"></i>
                            Anexo 1
                        </div>

                        <a href="{{ route('anexo1_1.index') }}"
                            class="submenu-item {{ request()->routeIs('anexo1_1.*') ? 'active' : '' }}">
                            <span>1.1</span> Planeación y Difusión
                        </a>

                        <a href="{{ route('anexo1_2.index') }}"
                            class="submenu-item {{ request()->routeIs('anexo1_2.*') ? 'active' : '' }}">
                            <span>1.2</span> Programa de Difusión
                        </a>

                        <a href="{{ route('anexo1_3.index') }}"
                            class="submenu-item {{ request()->routeIs('anexo1_3.*') ? 'active' : '' }}">
                            <span>1.3</span> Registro de Interesados
                        </a>

                    </div>

                    <div class="submenu-group">

                        <div class="submenu-title">
                            <i class="mdi mdi-folder-outline"></i>
                            Anexo 2
                        </div>

                        <a href="{{ route('anexo2_1.index') }}"
                            class="submenu-item {{ request()->routeIs('anexo2_1.*') ? 'active' : '' }}">
                            <span>2.1</span> Evaluación y Selección UE
                        </a>

                    </div>

                </div>

            </div>

        @endif
    </nav>

</aside>
<div id="overlay"></div>
