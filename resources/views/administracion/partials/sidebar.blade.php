<div class="github-sidebar">
    <div class="list-group list-group-flush" role="tablist">

        <!-- USUARIOS -->
        <div class="list-group-item fw-bold text-muted">
            <span class="mdi mdi-account-circle-outline me-2"></span> Usuarios
        </div>

        <button
            class="list-group-item list-group-item-action ps-5 {{ $activeTab == 'usuarios' ? 'active' : '' }}"
            data-bs-toggle="tab"
            data-bs-target="#usuarios"
            type="button"
            role="tab"
            aria-controls="usuarios"
            aria-selected="{{ $activeTab == 'usuarios' ? 'true' : 'false' }}">

            <span class="mdi mdi-account-outline me-2"></span>
            Gestión de Usuarios
        </button>

        <!-- SEGURIDAD -->
        <div class="list-group-item fw-bold text-muted mt-2">
            <span class="mdi mdi-shield-lock-outline me-2"></span> Seguridad
        </div>

        <button
            class="list-group-item list-group-item-action ps-5 {{ $activeTab == 'password-reset' ? 'active' : '' }}"
            data-bs-toggle="tab"
            data-bs-target="#password-reset"
            type="button"
            role="tab"
            aria-controls="password-reset"
            aria-selected="{{ $activeTab == 'password-reset' ? 'true' : 'false' }}">

            <span class="mdi mdi-key-outline me-2"></span>
            Restablecer Contraseñas
        </button>

        <!-- BACKUPS -->
        <div class="list-group-item fw-bold text-muted mt-2">
            <span class="mdi mdi-database-lock-outline me-2"></span> Sistema
        </div>

        <button
            class="list-group-item list-group-item-action ps-5 {{ $activeTab == 'backups' ? 'active' : '' }}"
            data-bs-toggle="tab"
            data-bs-target="#backups"
            type="button"
            role="tab"
            aria-controls="backups"
            aria-selected="{{ $activeTab == 'backups' ? 'true' : 'false' }}">

            <span class="mdi mdi-database-refresh-outline me-2"></span>
            Copias de Seguridad
        </button>

    </div>
</div>