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
                            @foreach ($mentor->estudiantes as $estudiante)
                                <div class="card card-rounded bg-gray-400 sm:bg-red-500 md:bg-green-500 lg:bg-blue-500"
"
                                    style="width: 18rem; align-items: center; justify-content: center; ">
                                    <div class="card-body">
                                        <h4 class="text-secondary">Estudiante: {{ $estudiante->name }}</h4>
                                        <br>
                                        <a type="button" class="btn btn-success"
                                            href="{{ route("estudiantes.show", Vinkla\Hashids\Facades\Hashids::encode($estudiante->matricula)) }}">Ver
                                            Estudiante <i
                                                class="mdi mdi-account-plus mdi-16px align-middle btn-icon-prepend"></i></a>
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
