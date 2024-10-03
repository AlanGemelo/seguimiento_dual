<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="mdi mdi-home menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
    @if (Auth::user()->rol_id !== 3)
    <li class="nav-item nav-category">Opciones</li>
    <li class="nav-item {{ request()->routeIs('estudiantes.*') ? 'active' : ''}}">
        <a class="nav-link" href="{{ route('estudiantes.index') }}">
            <i class="menu-icon mdi mdi-account"></i>
            <span class="menu-title">Estudiantes</span>
        </a>
    </li>
        
    @endif
        @if(Auth::user()->rol_id === 1|| Auth::user()->rol_id === 4)
        <li class="nav-item {{ request()->routeIs('academicos.*') ? 'active' : ''}}">
            <a class="nav-link" href="{{ route('academicos.index') }}">
                <i class="menu-icon mdi mdi-card-text-outline"></i>
                <span class="menu-title">Mentores Academicos</span>
            </a>
        </li>
        <li class="nav-item {{ request()->routeIs('empresas.*') ? 'active' : '' , request()->routeIs('mentores.*') ? 'active' : ''}}">
            <a class="nav-link" data-bs-toggle="collapse" href="#charts" aria-expanded="false"
               aria-controls="charts">
                <i class="menu-icon mdi mdi-home-assistant"></i>
                <span class="menu-title">Empresas</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="charts">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ request()->routeIs('empresas.*') ? 'active' : ''}}"><a class="nav-link" href="{{ route('empresas.index') }}">Empresa</a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('mentores.*') ? 'active' : ''}}"><a class="nav-link" href="{{ route('mentores.index') }}">Mentor Industrial</a>
                    </li>
                </ul>
            </div>
        </li>
       @if(Auth::user()->rol_id === 1)
       <li class="nav-item {{ request()->routeIs('direcciones.*') ? 'active' : '' , request()->routeIs('mentores.*') ? 'active' : ''}}">
        <a class="nav-link" data-bs-toggle="collapse" href="#chartsD" aria-expanded="false"
           aria-controls="chartsD">
           <i class="menu-icon mdi mdi-package"></i>
           <span class="menu-title">Direccion de Carrera</span>
            <i class="menu-arrow"></i>
        </a>
       
        <div class="collapse" id="chartsD">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item {{ request()->routeIs('direcciones.*') ? 'active' : ''}}"><a class="nav-link" href="{{ route('direcciones.index') }}">Direccion Carrera</a>
                </li>
                <li class="nav-item {{ request()->routeIs('directores.*') ? 'active' : ''}}"><a class="nav-link" href="{{ route('directores.index') }}">Director de Carrera</a>
                </li>
                <li class="nav-item {{ request()->routeIs('carreras.*') ? 'active' : ''}}"><a class="nav-link" href="{{ route('carreras.index') }}">Programa Educativo</a>
                </li>
            </ul>
        </div>
    </li>
    <li class="nav-item {{ request()->routeIs('estadisticas.*') ? 'active' : ''}}">
        <a class="nav-link" href="{{ route('estadisticas.index') }}">
            <i class="menu-icon mdi mdi-chart-line"></i>
            <span class="menu-title">Estadisticas</span>
        </a>
    </li>
    @endif
        
       
            @endif
            <divider/>
            <hr>
            <li class="nav-item {{ request()->routeIs('profile.*') ? 'active' : '' , request()->routeIs('profile.*') ? 'active' : ''}}">
                <a class="nav-link" data-bs-toggle="collapse" href="#chartsProfile" aria-expanded="false"
                   aria-controls="chartsProfile">
                   <i class="menu-icon mdi mdi-account"></i>
                   <span class="menu-title">Mi Perfil</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="chartsProfile">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item {{ request()->routeIs('profile.edit') ? 'active' : ''}}">
                            <a class="nav-link" href="{{ route('profile.edit') }}">
                                <i class="menu-icon mdi mdi-pencil"></i>
                                Editar Perfil
                            </a>
                        </li>
                        <li class="nav-item" style="display: inline-block">
                            <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-link').submit();">
                                <i class="menu-icon mdi mdi-power"></i>
                                Cerrar Sesión
                            </a>
                            <form id="logout-link" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
                </li>
        
   
    </ul>
</nav>
