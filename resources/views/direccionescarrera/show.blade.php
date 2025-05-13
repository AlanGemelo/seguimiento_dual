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
                            <div class="form-group">
                                <label for="email">Director de Carrera</label>
                                <input type="email" class="form-control form-control-lg" id="email"
                                       {{-- placeholder="user@utvtol.edu.mx" name="email" value="{{ $direccion->director->name }}" --}}
                                       disabled>
                            </div>
                          
                            <div    class="row">
                                @foreach($direccion->programas as $programa)
                                <div    class="col-md-4 mb-4">
                                    <div    class="card h-100 shadow-lg`">
                                        <div    class="card-body d-flex flex-column justify-content-between">
                                            <h5 data-aos="fade-up" class="card-title">{{ $programa->nombre }}</h5>
                                       
                                            <a href="{{ route('carreras.show', $programa->id) }}"   class="btn btn-primary mt-auto">Ver detalles</a>
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

