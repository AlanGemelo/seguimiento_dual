@extends('layouts.app')
@section('title', 'Editar Dirección de Carrera')

@section('content')
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Editar Direccion de Carrera</h4>
                            <span class="text-danger">* Son campos requeridos</span>
                            <div class="dropdown-divider"></div>
                            <form class="pt-3" action="{{ route('direcciones.update', $direccion->id) }}" method="post">
                                @csrf
                                @method('PATCH')
                                <div class="form-group">
                                    <label for="name">Nombre <span class="text-danger">*</span></label>
                                    <input type="text" data-tipo="text" class="form-control form-control-lg"
                                        id="name" placeholder="" name="name"
                                        value="{{ $direccion->name, old('name') }}">

                                </div>
                                <div class="form-group">
                                    <label for="email">Correo Electronico <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg" id="email" placeholder=""
                                        name="email" value="{{ $direccion->email, old('email') }}">

                                </div>


                                <div class="mt-3">
                                    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                                        type="submit">Actualizar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
