<div class="github-sidebar">
    <div class="list-group list-group-flush" role="tablist">
        <!-- PERFIL -->
        <div class="list-group-item fw-bold text-muted">
            <span class="mdi mdi-account-circle-outline me-2"></span> Perfil
        </div>
        <button class="list-group-item list-group-item-action ps-5 {{ $activeTab == 'perfil' ? 'active' : '' }}"
            data-bs-toggle="tab" data-bs-target="#perfil" type="button" role="tab" aria-controls="perfil"
            aria-selected="{{ $activeTab == 'perfil' ? 'true' : 'false' }}">
            <span class="mdi mdi-account-outline me-2"></span> Perfil público
        </button>

        <!-- ACCESO Y SEGURIDAD -->
        <div class="list-group-item fw-bold text-muted mt-2">
            <span class="mdi mdi-shield-lock-outline me-2"></span> Acceso y Seguridad
        </div>
        <button id="password-tab"
            class="list-group-item list-group-item-action ps-5 {{ $activeTab == 'password' ? 'active' : '' }}"
            data-bs-toggle="tab" data-bs-target="#password" type="button" role="tab" aria-controls="password"
            aria-selected="{{ $activeTab == 'password' ? 'true' : 'false' }}">
            <span class="mdi mdi-key-outline me-2"></span> Contraseña
        </button>
    </div>
</div>
