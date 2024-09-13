@extends('layouts.app')
@section('title', 'Direccion de Carrera')
@section('content')
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Direccion de carrera</h4>
                            <div class="dropdown-divider"></div>
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input type="text" class="form-control form-control-lg" id="name"
                                       placeholder="Juan Perez Hermenegildo" name="name" value="{{ $direccion->name }}"
                                       disabled>
                            </div>
                        
                            <div class="form-group">
                                <label for="email">Correo Electronico</label>
                                <input type="email" class="form-control form-control-lg" id="email"
                                       placeholder="user@utvtol.edu.mx" name="email" value="{{ $direccion->email }}"
                                       disabled>
                            </div>
                          
                            @foreach($direccion->programas as $estudiante)
                                <div class="card card-rounded" style="width: 18rem; align-items: center; justify-content: center;">
                                    <div class="card-body">
                                        <h4 class="text-secondary">Programa Educativo: {{ $estudiante->nombre }}</h4>
                                        <br>
                                        <a type="button" class="btn btn-success" href="{{ route('estudiantes.show', Vinkla\Hashids\Facades\Hashids::encode($estudiante->matricula)) }}">Ver Estudiante  <i class="mdi mdi-account-plus mdi-16px align-middle btn-icon-prepend"></i></a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

