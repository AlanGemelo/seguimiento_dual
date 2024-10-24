@extends("layouts.app")
@section("title", "Mentor Academico")
@section("content")
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Mentor Academico</h4>
                            <div class="dropdown-divider"></div>
                            <div class="form-group">
                                <label for="titulo">Titulo</label>
                                <input type="text" class="form-control form-control-lg" id="titulo"
                                    placeholder="Juan Perez Hermenegildo" name="titulo" value="{{ $mentor->titulo }}"
                                    disabled>
                            </div>
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input type="text" class="form-control form-control-lg" id="name"
                                    placeholder="Juan Perez Hermenegildo" name="name" value="{{ $mentor->name }}"
                                    disabled>
                            </div>
                            <div class="form-group">
                                <label for="email">Correo Electronico</label>
                                <input type="email" class="form-control form-control-lg" id="email"
                                    placeholder="user@utvtol.edu.mx" name="email" value="{{ $mentor->email }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="direccion_id">Direccion de Carrera</label>
                                <input type="text" class="form-control form-control-lg" id="direccion_id"
                                    placeholder="user@utvtol.edu.mx" name="direccion_id"
                                    value="{{ $mentor->direccion->name }}" disabled>
                            </div>

                            <div    class="row">
                                @foreach($mentor->estudiantes as $estudiante)
                                <div    class="col-md-4 mb-4">
                                    <div    class="card h-100 shadow-lg`">
                                        <div    class="card-body d-flex flex-column justify-content-between">
                                            <h5 class="card-title align-center">{{ $estudiante->name }}</h5>
                                       
                                            <a href="{{ route('estudiantes.show',Vinkla\Hashids\Facades\Hashids::encode($estudiante->matricula)) }}"   class="btn btn-primary mt-auto">Ver detalles</a>
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
