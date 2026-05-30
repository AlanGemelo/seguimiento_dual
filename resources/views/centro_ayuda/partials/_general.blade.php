<div class="row">

    {{-- Inicio de sesión --}}

    {{-- Cambiar contraseña --}}
    <div class="col-md-4 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <h5 class="fw-bold">
                    <i class="mdi mdi-lock-reset text-warning"></i>
                    Cambiar contraseña
                </h5>
                <p class="small text-muted">
                    Guía para actualizar o cambiar la contraseña de acceso a tu cuenta.
                </p>
            </div>
            <div class="card-footer bg-white border-0">
                <a href="https://youtu.be/ZYkQp-gR3uI"
                    target="_blank"
                    class="btn btn-danger btn-sm w-100">
                    <i class="mdi mdi-youtube"></i>
                    Ver tutorial
                </a>
            </div>
        </div>
    </div>
    @if (Auth::user()->rol_id === 1 || Auth::user()->rol_id === 4)
    {{-- Restablecer la contraseña --}}
    <div class="col-md-4 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <h5 class="fw-bold">
                    <i class="mdi mdi-lock-reset text-warning"></i>
                    Restablecer contraseña
                </h5>
                <p class="small text-muted">
                    Guía para que un administrador o director pueda restablecer la contraseña o el acceso de un usuario cuando este la haya olvidado.
                </p>
            </div>
            <div class="card-footer bg-white border-0">
                <a href="https://youtu.be/oXY969uKgf8"
                    target="_blank"
                    class="btn btn-danger btn-sm w-100">
                    <i class="mdi mdi-youtube"></i>
                    Ver tutorial
                </a>
            </div>
        </div>
    </div>
    @endif

    {{-- Navegación --}}


</div>