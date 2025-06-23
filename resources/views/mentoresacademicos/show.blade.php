@extends('layouts.app')
@section('title', 'Mentor Academico')
@section('content')
<<<<<<< HEAD
<div class="row">
    <div class="col-12 grid-margin">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title px-3 pt-3">Datos del Mentor Academico</h4>
                        <div class="dropdown-divider"></div>
                        <div class="row py-3 text-center">
                            <div class="col-4">
                                <p class="fw-semibold fs-6">Título:</p>
                                <p class="fw-light">{{ $mentor->titulo }}</p>
                            </div>
                            <div class="col-4">
                            <p class="fw-semibold fs-6">Nombre:</p>
                            <p class="fw-light">{{ $mentor->name }}</p>
                            </div>
                            <div class="col-4">
                            <p class="fw-semibold fs-6">Correo Electrónico:</p>
                            <p class="fw-light">{{ $mentor->email }}</p>
                            </div>
                        </div>
                        <div class="row py-3 text-center">
                        <p class="fw-semibold fs-5">Alumnos a cargo:</p>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-sm table-hover">
                                <thead>
                                    <tr class="text-center">
                                        <th>Nombre del alumno</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($mentor->estudiantes as $estudiante)
                                    <tr class="text-center">
                                        <td>{{ $estudiante->name }}</td>
                                        <td>
                                            <a type="button" class="btn btn-success" href="{{ route('estudiantes.show', Vinkla\Hashids\Facades\Hashids::encode($estudiante->matricula)) }}">Ver Estudiante <i class="mdi mdi-account-plus mdi-16px align-middle btn-icon-prepend"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row pt-3">
                            <div class="col d-flex justify-content-end">
                            <a href="/academicos"
                                    class="btn btn-secondary btn-sm">
                                    Volver
                                </a>
                            </div>
=======
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Datos del Mentor Académico</h4>
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
                            <x-back-button url="{{ route('academicos.index') }}"/>
>>>>>>> f57f20083a2decb167ed3140251ba15d87cdac3d
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection