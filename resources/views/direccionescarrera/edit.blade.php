@extends('layouts.app')
@section('title', 'Editar Dirección de Carrera')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <x-forms.section-header title="Editar Direccion de Carrera "
                    description="Formulario para editar la Direccion de Carrera responsables de la gestión y coordinación de una carrera universitaria o programa educativo." />
                <div class="card-body">
                    <form class="pt-3" action="{{ route('direcciones.update', $direccion->id) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="name">Nombre <span class="text-danger">*</span></label>
                            <input type="text" data-tipo="text" class="form-control form-control-lg" id="name"
                                placeholder="" name="name" value="{{ old('name', $direccion->name) }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Correo Electronico <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-lg" id="email" placeholder=""
                                name="email" value="{{ old('email', $direccion->email) }}">
                        </div>

                        <div class="mt-3">
                            <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                                type="submit">Actualizar
                            </button>

                            <x-buttons.cancel-button url="{{ route('direcciones.index') }}" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
