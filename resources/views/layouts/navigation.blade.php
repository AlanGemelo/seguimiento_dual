<nav class=" animate__animated animate__fadeInLeftBig navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <div class="me-3  animate__animated animate__slideInDown animate__delay-0.5s">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                    data-bs-toggle="minimize">
                <span class="icon-menu"></span>
            </button>
        </div>
        <div class="animate__animated animate__flipOutY animate__delay-1.5s">
            <a class="navbar-brand brand-logo" href="{{ route('dashboard') }}">
                <img src="{{ asset('assets/images/Logo-utvt.png')}}" alt="logo" width="70px"/>
            </a>
            <a class="navbar-brand brand-logo-mini" href="{{ route('dashboard') }}">
                <img src="{{ asset('assets/images/logo.png')}}" alt="logo"/>
            </a>
        </div>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-top pt-5">
        <ul class="navbar-nav">
            <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
                <h1 class="welcome-text">Bienvenido! <span class="text-black fw-bold">{{ Auth::user()->name }}</span>
                </h1>
                {{--                <h3 class="welcome-sub-text">Your performance summary this week </h3>--}}
            </li>
        </ul>
        <ul class="navbar-nav ms-auto z-0">
          
            <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                    <img class="img-xs rounded-circle" src="{{ asset('assets/images/logo.png') }}" alt="Profile image"> </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" style="border-radius: 20px;" aria-labelledby="UserDropdown">
                    <div class="dropdown-header text-center">
                        <img class="img-md rounded-circle" src="{{ asset('assets/images/logo-utvt-removebg-preview.png') }}" width="20%" alt="Profile image">
                        <p class="mb-1 mt-3 font-weight-semibold">{{ Auth::user()->name }}</p>
                        <p class="fw-light text-muted mb-0">{{ Auth::user()->email }}</p>
                    </div>
                    <a class="dropdown-item" href="{{ route('profile.edit') }}"><i
                            class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> Mi Perfil
                    </a>
                  
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="dropdown-item"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Cerrar
                            Sesion
                        </button>
                    </form>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                data-bs-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const userDropdown = document.getElementById('UserDropdown');
        const dropdownMenu = document.querySelector('.dropdown-menu');
        console.log('first')

        userDropdown.addEventListener('click', function(e) {
            e.preventDefault();
            dropdownMenu.classList.add('show'); // Fuerza a que el menú se muestre
        });
    });
</script>

