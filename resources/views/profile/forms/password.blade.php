<div class="settings-section">
    <h4 class="settings-title">Cambiar contraseña</h4>
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        @method('put')
        <div class="mb-3">
            <label>Contraseña actual</label>
            <input type="password" name="current_password" class="form-control">
        </div>
        <div class="mb-3">
            <label>Nueva contraseña</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="mb-3">
            <label>Confirmar contraseña</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>
        <button class="btn btn-success">Actualizar contraseña</button>
    </form>
</div>
