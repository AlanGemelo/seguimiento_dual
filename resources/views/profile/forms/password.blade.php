<div class="settings-section">

    <h4 class="settings-title">
        Cambiar contraseña
    </h4>

    <form method="POST" action="{{ route('profile.password.update') }}">
        @csrf
        @method('PATCH')

        <!-- Contraseña actual -->
        <div class="mb-3">
            <label class="form-label">Contraseña actual</label>

            <div class="input-group">
                <input type="password"
                    id="current_password"
                    name="current_password"
                    class="form-control"
                    required>

                <button type="button"
                    class="btn btn-outline-secondary"
                    onclick="togglePassword('current_password')">

                    <i id="icon-current_password"
                        class="mdi mdi-eye-outline"></i>
                </button>
            </div>
        </div>

        <!-- Nueva contraseña -->
        <div class="mb-3">
            <label class="form-label">Nueva contraseña</label>
            <small id="passwordHelp" class="text-muted">
                Mínimo 8 caracteres, una mayúscula, una minúscula y un número.
            </small>
            <div class="input-group">
                <input type="password"
                    id="password"
                    name="password"
                    class="form-control"
                    required
                    minlength="8"
                    pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}"
                    title="Debe tener al menos 8 caracteres, una mayúscula, una minúscula y un número"
                    data-password="false">

                <button type="button"
                    class="btn btn-outline-secondary"
                    onclick="togglePassword('password')">

                    <i id="icon-password"
                        class="mdi mdi-eye-outline"></i>
                </button>
            </div>
        </div>

        <!-- Confirmación -->
        <div class="mb-3">
            <label class="form-label">Confirmar contraseña</label>
            <small id="passwordMatch" class="text-muted d-block mt-1">
                Las contraseñas deben coincidir.
            </small>
            <div class="input-group">
                <input type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    class="form-control"
                    required
                    minlength="8"
                    pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}"
                    title="Debe tener al menos 8 caracteres, una mayúscula, una minúscula y un número"
                    data-password="false">

                <button type="button" 
                    class="btn btn-outline-secondary"
                    onclick="togglePassword('password_confirmation')">

                    <i id="icon-password_confirmation"
                        class="mdi mdi-eye-outline"></i>
                </button>
            </div>
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-success">
                Actualizar contraseña
            </button>
        </div>

    </form>

</div>