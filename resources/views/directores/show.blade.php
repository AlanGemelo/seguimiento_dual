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
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control form-control-lg" id="nombre"
                                       placeholder="Juan Perez Hermenegildo" name="nombre" value="{{ $director->nombre }}"
                                       disabled>
                            </div>
                        
                            <div class="form-group">
                                <label for="email">Correo Electronico</label>
                                <input type="email" class="form-control form-control-lg" id="email"
                                       placeholder="user@utvtol.edu.mx" name="email" value="{{ $director->email }}"
                                       disabled>
                            </div>
                            <div class="form-group">
                                <label for="direccion_id">Direccion de Carrera</label>
                                <input type="direccion_id" class="form-control form-control-lg" id="direccion_id"
                                       placeholder="user@utvtol.edu.mx" name="direccion_id" value="{{ $director->direccion->name }}"
                                       disabled>
                            </div>
                          
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

