@extends('layouts.app')
@section('title', 'Mentor Academico')
@section('content')
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Mentor Academico</h4>
                            <div class="dropdown-divider"></div>
                            <div class="form-group">
                                <label for="titulo">Título</label>
                                <input type="text" class="form-control form-control-lg" id="titulo"
                                    placeholder="Su grado académico" name="titulo" value="{{ $mentor->titulo }}" disabled>
                            </div>

                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input type="text" class="form-control form-control-lg" id="name"
                                    placeholder="Su(s) nombre(s)" name="name" value="{{ $mentor->name }}" disabled>
                            </div>

                            <div class="form-group">
                                <label for="apellidoP">Apellido Paterno</label>
                                <input type="text" class="form-control form-control-lg" id="apellidoP"
                                    placeholder="Su apellido paterno" name="apellidoP" value="{{ $mentor->apellidoP }}"
                                    disabled>
                            </div>

                            <div class="form-group">
                                <label for="apellidoM">Apellido Materno</label>
                                <input type="text" class="form-control form-control-lg" id="apellidoM"
                                    placeholder="Su apellido materno" name="apellidoM" value="{{ $mentor->apellidoM }}"
                                    disabled>
                            </div>

                            <div class="form-group">
                                <label for="email">Correo Electrónico</label>
                                <input type="email" class="form-control form-control-lg" id="email"
                                    placeholder="Su dirección de correo electrónico" name="email"
                                    value="{{ $mentor->email }}" disabled>
                            </div>

                            <div class="form-group">
                                <label for="direccion_id">Dirección de Carrera</label>
                                <input type="text" class="form-control form-control-lg" id="direccion_id"
                                    placeholder="Nombre de la dirección o carrera" name="direccion_id"
                                    value="{{ $mentor->direccion->name }}" disabled>
                            </div>


                            <div class="row">
                                @foreach ($mentor->estudiantes as $estudiante)
                                    <div class="col-md-4 mb-4">
                                        <div class="card h-100 shadow-lg`">
                                            <div class="card-body d-flex flex-column justify-content-between">
                                                <h5 class="card-title align-center">{{ $estudiante->name }}</h5>

                                                <a href="{{ route('estudiantes.show', Vinkla\Hashids\Facades\Hashids::encode($estudiante->matricula)) }}"
                                                    class="btn btn-primary mt-auto">Ver detalles</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
