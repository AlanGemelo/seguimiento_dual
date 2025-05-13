@extends('layouts.app')
@section('title', 'Mentor Academico')
@section('content')
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Estudiantes a cargo</h4>
                            <div class="card-body">
                                <h4 class="card-title">Estudiante Dual</h4>
                                <div class="dropdown-divider"></div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="matricula">Matricula</label>
                                            <input type="number" class="form-control form-control-lg" id="matricula"
                                                   name="matricula" value="{{ $estudiante->matricula }}" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Nombre</label>
                                            <input type="text" class="form-control form-control-lg" id="name"
                                                   placeholder="Juan Perez Hermenegildo" name="name"
                                                   value="{{ $estudiante->name }}" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="curp">CURP</label>
                                            <input type="text" class="form-control form-control-lg" id="curp" name="curp"
                                                   value="{{ $estudiante->curp }}" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="fecha_na">Fecha de Nacimiento</label>
                                            <input type="date" class="form-control form-control-lg" name="fecha_na"
                                                   id="fecha_na"
                                                   value="{{ $estudiante->fecha_na }}" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="cuatrimestre">Cuatrimestre</label>
                                            <input type="text" class="form-control form-control-lg" id="cuatrimestre"
                                                   name="cuatrimestre"
                                                   value="{{ $estudiante->cuatrimestre }}" disabled>
                                        </div>
                                       
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

