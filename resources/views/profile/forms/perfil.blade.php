<div class="settings-section">

    <div class="settings-title">
        Perfil público
    </div>

    <div class="row">

        <!-- FOTO -->
        <div class="col-md-4 text-center">

            <img src="{{ asset('assets/images/logo-utvt-new.png') }}"
                class="profile-avatar mb-3">

            <h5 class="text-muted">
                {{ $user->rol->name ?? 'Sin rol asignado' }}
            </h5>

        </div>

        <!-- FORM -->
        <div class="col-md-8">

            <form method="POST"
                action="{{ route('profile.update') }}">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nombre</label>

                    <input type="text"
                        name="name"
                        class="form-control"
                        value="{{ old('name', $user->name) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Apellido paterno</label>

                    <input type="text"
                        name="apellidoP"
                        class="form-control"
                        value="{{ old('apellidoP', $user->apellidoP) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Apellido materno</label>

                    <input type="text"
                        name="apellidoM"
                        class="form-control"
                        value="{{ old('apellidoM', $user->apellidoM) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Correo</label>

                    <input type="email"
                        name="email"
                        class="form-control"
                        value="{{ old('email', $user->email) }}">
                </div>

                <div class="d-flex justify-content-end">
                    <button class="btn btn-success">
                        Guardar cambios
                    </button>
                </div>

            </form>

        </div>

    </div>

</div>