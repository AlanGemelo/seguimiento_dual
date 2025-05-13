@extends("layouts.guest")
@section("title", "Recuperar Cuenta")
@section("content")
    <div class="container-scroller animate__animated animate__jello animate__infinite">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <div class="brand-logo animate__animated animate__jello animate__infinite">
                                <img src="{{ asset("assets/images/logo.png") }}" alt="Cuervo Logo">
                            </div>
                            <h2 class="fw-light">Recuperar Cuenta</h2>

                            @if (session("status"))
                            <div class="animate__animated animate__jello animate__infinite alert alert-success d-flex flex-column justify-content-between ">
                                {{ session("status") }}
                                <br>
                               <a href="https://mail.google.com/mail/u/2/#inbox" class="btn btn-success mt-2" target="_blank">Ir a mi correo</a>
                                Se ha enviado un correo de restablecimiento de contraseña 
                            </div>
                            @endif
                            <form method="POST" action="{{ route("password.email") }}">
                                @csrf
                                <div class="form-group">
                                    <label for="email">Correo Electronico</label>
                                    <input type="email" class="form-control form-control-lg" id="email"
                                        placeholder="user@utvtol.edu.mx" name="email" value="{{ old("email") }}">
                                    @error("email")
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mt-3 d-flex justify-content-center">
                                    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                                        type="submit">Recuperar Cuenta</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
