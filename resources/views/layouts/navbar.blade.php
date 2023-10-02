<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item nav-category">Acciones</li>
        <li class="nav-item">
{{--            {{ request()->routeIs('plagio.*') ? 'active' : ''}}--}}
            <a class="nav-link" href="">
                <i class="menu-icon mdi mdi-floor-plan"></i>
                <span class="menu-title">Estudiantes</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="#form-elements">
                <i class="menu-icon mdi mdi-card-text-outline"></i>
                <span class="menu-title">Mentores Academicos</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#charts" aria-expanded="false"
               aria-controls="charts">
                <i class="menu-icon mdi mdi-chart-line"></i>
                <span class="menu-title">Empresas</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="charts">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="pages/charts/chartjs.html">Empresa</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="pages/charts/chartjs.html">Mentor Industrial</a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</nav>
