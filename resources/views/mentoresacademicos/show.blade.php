@extends('layouts.app')
@section('title', 'Mentor Academico')
@section('content')
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection