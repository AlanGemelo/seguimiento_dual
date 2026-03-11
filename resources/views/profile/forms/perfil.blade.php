<div class="settings-section">

    <div class="settings-title">
        Perfil público
    </div>

    <div class="row">

        <!-- FOTO -->
        <div class="col-md-4 text-center">

            <img src="{{ asset('assets/images/logo-utvt-new.png') }}" class="profile-avatar mb-3">

            {{-- <button class="btn btn-outline-secondary btn-sm w-100">
                Cambiar avatar 
            </button> --}}

            <h4 class="text-muted mb-2">
                <i class="bi bi-person-badge"></i> <!-- Icono de rol (Bootstrap Icons) -->
                {{ $user->rol->name ?? 'Sin rol asignado' }}
            </h4>
        </div>

        <!-- FORMULARIO -->
        <div class="col-md-8">

            <form method="post" action="{{ route('profile.update') }}">
                @csrf
                @method('patch')

                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Apellido paterno</label>
                    <input type="text" name="apellidoP" value="{{ old('apellidoP', $user->apellidoP) }}"
                        class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Apellido materno</label>
                    <input type="text" name="apellidoM" value="{{ old('apellidoM', $user->apellidoM) }}"
                        class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Correo</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control">
                </div>


                <!-- Botones de Acción -->
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                    <button class="btn btn-success">
                        Guardar cambios
                    </button>
                </div>
            </form>

        </div>

    </div>

</div>
