@extends('layouts.app')
@section('title', 'Crear Mentor Academico')
@section('content')
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Crear Estudiante Dual</h4>
                            <span class="text-danger">* Son campos requeridos</span>
                            <div class="dropdown-divider"></div>
                            <div class="form-group">
                                <label for="titulo">Titulo <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg" id="titulo" placeholder="Juan Perez Hermenegildo" name="titulo" value="{{ $mentor->titulo }}" disabled>
                            </div>                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control form-control-lg" id="name" placeholder="Juan Perez Hermenegildo" name="name" value="{{ $mentor->name }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="email">Correo Electronico</label>
                                    <input type="email" class="form-control form-control-lg" id="email" placeholder="user@utvtol.edu.mx" name="email" value="{{ $mentor->email }}" disabled>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

