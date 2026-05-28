@extends('layouts.app')

@section('title', 'Perfil')

@section('styles')
<style>
    .github-settings {
        background: #f6f8fa;
        padding: 30px;
    }

    .github-sidebar {
        background: white;
        border: 1px solid #d0d7de;
        border-radius: 6px;
        overflow: hidden;
    }

    .github-sidebar .list-group-item {
        border: none;
        padding: 12px 18px;
    }

    .github-sidebar .list-group-item.active {
        background-color: #f6f8fa;
        border-left: 3px solid #006837;
        color: #006837;
        font-weight: 600;
    }

    .github-sidebar .list-group-item:hover {
        background: #f6f8fa;
        color: #006837;
    }

    .settings-section {
        background: white;
        border: 1px solid #d0d7de;
        border-radius: 6px;
        padding: 24px;
    }

    .settings-title {
        font-size: 22px;
        font-weight: 600;
        margin-bottom: 25px;
    }

    .profile-avatar {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        border: 1px solid #d0d7de;
    }

    .form-control {
        min-height: 48px;
    }

    input::-ms-reveal,
      input::-ms-clear {
        display: none;
      }
</style>
@endsection

@section('content')

<div class="github-settings">

    <!-- HEADER -->
    <div class="mb-4">

        <h3 class="mb-0">
            {{ auth()->user()->name }}
            {{ auth()->user()->apellidoP }}
            {{ auth()->user()->apellidoM }}
        </h3>

        <div class="text-muted small">
            {{ auth()->user()->email }}
        </div>

        <x-alerts.flash-messages />

        <hr>

    </div>

    <div class="row">

        <!-- SIDEBAR -->
        <div class="col-md-3">
            @include('profile.partials.sidebar')
        </div>

        <!-- CONTENT -->
        <div class="col-md-9">

            @if($section == 'perfil')
            @include('profile.forms.perfil')
            @endif

            @if($section == 'password')
            @include('profile.forms.password')
            @endif

        </div>

    </div>

</div>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {

        // elementos
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('password_confirmation');
        const help = document.getElementById('passwordHelp');
        const message = document.getElementById('passwordMatch');
        const submitBtn = document.querySelector('button[type="submit"]');

        if (submitBtn) submitBtn.disabled = true;

        // toggle password
        function togglePassword(id) {
            const input = document.getElementById(id);
            const icon = document.getElementById('icon-' + id);

            if (!input) return;

            if (input.type === 'password') {
                input.type = 'text';
                if (icon) {
                    icon.classList.remove('mdi-eye-outline');
                    icon.classList.add('mdi-eye-off-outline');
                }
            } else {
                input.type = 'password';
                if (icon) {
                    icon.classList.remove('mdi-eye-off-outline');
                    icon.classList.add('mdi-eye-outline');
                }
            }
        }

        window.togglePassword = togglePassword;

        // reglas password
        function validateStrength(value) {
            return {
                length: value.length >= 8,
                upper: /[A-Z]/.test(value),
                lower: /[a-z]/.test(value),
                number: /[0-9]/.test(value),
            };
        }

        // validar fuerza
        function checkStrength() {
            const value = password.value;
            const rules = validateStrength(value);

            const valid = rules.length && rules.upper && rules.lower && rules.number;

            if (valid) {
                help.classList.remove('text-danger');
                help.classList.add('text-success');
                help.textContent = 'Contraseña válida ✔';
            } else {
                help.classList.remove('text-success');
                help.classList.add('text-danger');
                help.textContent = '8+ caracteres, mayúscula, minúscula y número';
            }

            return valid;
        }

        // validar coincidencia
        function checkMatch() {
            if (!message) return false;

            if (confirmPassword.value === '') {
                message.textContent = 'Las contraseñas deben coincidir.';
                message.className = 'text-muted d-block mt-1';
                return false;
            }

            if (password.value === confirmPassword.value) {
                message.textContent = '✔ Coinciden';
                message.className = 'text-success d-block mt-1';
                return true;
            } else {
                message.textContent = '✖ No coinciden';
                message.className = 'text-danger d-block mt-1';
                return false;
            }
        }

        // estado general
        function updateState() {
            const strength = checkStrength();
            const match = checkMatch();

            if (submitBtn) submitBtn.disabled = !(strength && match);
        }

        // eventos
        if (password) password.addEventListener('input', updateState);
        if (confirmPassword) confirmPassword.addEventListener('input', updateState);

        updateState();

    });
</script>
@endsection