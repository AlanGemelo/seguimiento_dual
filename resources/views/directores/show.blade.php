@extends('layouts.app')
@section('title', 'Director de Carrera')
@section('content')
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Director de carrera</h4>
                            <div class="dropdown-divider"></div>
                            <div class="form-group">
                                <label for="nombre">Nombre(s)</label>
                                <input type="text" class="form-control form-control-lg" id="nombre"
                                    placeholder="Su(s) nombre(s)" name="nombre" value="{{ $director->nombre }}" disabled>
                            </div>

                            <div class="form-group">
                                <label for="apellidoP">Apellido Paterno</label>
                                <input type="text" class="form-control form-control-lg" id="apellidoP"
                                    placeholder="Su apellido paterno" name="apellidoP" value="{{ $director->apellidoP }}"
                                    disabled>
                            </div>

                            <div class="form-group">
                                <label for="apellidoM">Apellido Materno</label>
                                <input type="text" class="form-control form-control-lg" id="apellidoM"
                                    placeholder="Su apellido materno" name="apellidoM" value="{{ $director->apellidoM }}"
                                    disabled>
                            </div>

                            <div class="form-group">
                                <label for="email">Correo Electronico</label>
                                <input type="email" class="form-control form-control-lg" id="email"
                                    placeholder="Su dirección de correo electrónico" name="email"
                                    value="{{ $director->email }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="direccion_id">Direccion de Carrera</label>
                                <input type="direccion_id" class="form-control form-control-lg" id="direccion_id"
                                    placeholder="Nombre de la dirección o carrera" name="direccion_id"
                                    value="{{ $director->direccion->name }}" disabled>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
