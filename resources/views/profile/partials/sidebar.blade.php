<div class="github-sidebar">

    <div class="list-group list-group-flush">

        <div class="list-group-item fw-bold text-muted bg-light">
            <span class="mdi mdi-account-circle-outline me-2"></span>
            Perfil
        </div>

        <a href="{{ route('profile.index') }}"
            class="list-group-item list-group-item-action ps-5
            {{ request()->routeIs('profile.index') ? 'active' : '' }}">

            <span class="mdi mdi-account-outline me-2"></span>
            Perfil público
        </a>

        <div class="list-group-item fw-bold text-muted bg-light">
            <span class="mdi mdi-shield-account-outline me-2"></span>
            Seguridad
        </div>

        <a href="{{ route('profile.password') }}"
            class="list-group-item list-group-item-action ps-5
            {{ request()->routeIs('profile.password') ? 'active' : '' }}">

            <span class="mdi mdi-key-outline me-2"></span>
            Contraseña
        </a>

    </div>

</div>