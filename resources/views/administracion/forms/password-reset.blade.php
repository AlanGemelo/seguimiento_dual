<div class="settings-section">

    <h4 class="settings-title">
        Restablecer Contraseña
    </h4>

    <form method="POST"
        action="{{ route('administracion.password.reset') }}">

        @csrf

        <div class="mb-4">
            <label class="form-label fw-semibold">
                Correo Institucional
            </label>
            <div class="input-group">
                <input
                    type="email"
                    name="email"
                    id="search-email"
                    class="form-control"
                    placeholder="usuario@utvtol.edu.mx"
                    required>
                <button
                    type="button"
                    id="btnBuscar"
                    class="btn btn-outline-success">
                    <span class="mdi mdi-magnify"></span>
                    Buscar
                </button>
            </div>
        </div>

        <div class="border rounded p-3 bg-light mb-4">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label text-muted small">
                        Nombre Completo
                    </label>
                    <div class="fw-semibold" id="full-name">
                        -
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label text-muted small">
                        Rol
                    </label>
                    <div class="fw-semibold" id="role">
                        -
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label text-muted small">
                        Correo
                    </label>
                    <div class="fw-semibold" id="user-email">
                        -
                    </div>
                </div>

            </div>
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold">
                Contraseña Temporal
            </label>
            <input
                type="text"
                name="temp_password"
                class="form-control"
                value="{{ session('temp_password') }}"
                readonly>
        </div>

        <div class="d-flex justify-content-end">

            <button
                type="submit"
                class="btn btn-success">
                <span class="mdi mdi-key-reset me-1"></span>
                Generar Contraseña
            </button>
        </div>
    </form>
</div>