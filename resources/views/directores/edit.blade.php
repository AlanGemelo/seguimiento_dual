@extends("layouts.app")
@section("title", "Editar Director de Carrera")

@section("content")
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Editar Director {{ $direccion->nombre }} </h4>
                            <span class="text-danger">* Son campos requeridos</span>
                            <div class="dropdown-divider"></div>
                            <form class="pt-3" action="{{ route("directores.update", $direccion->id) }}" method="post">
                                @csrf
                                @method("PATCH")
                                <div class="form-group">
                                    <label for="nombre">Nombre <span class="text-danger">*</span></label>
                                    <input type="text"data-tipo="text" class="form-control form-control-lg" id="nombre" placeholder=""
                                        name="nombre" value="{{ $direccion->nombre, old("nombre") }}">

                                </div>
                                <div class="form-group">
                                    <label for="email">Correo Electronico <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg" id="email" placeholder=""
                                        name="email" value="{{ $direccion->email, old("email") }}">

                                </div>
                                {{-- Seleccionar Docencia del estudiante --}}
                                <div class="form-group">
                                    <label for="direccion_id" class="form-label">Direccion de Carrera <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" aria-label="Seleccionar Empresa" name="direccion_id">
                                        <option selected>Seleccione una opcion</option>
                                        @foreach ($direcciones as $key)
                                            <option value="{{ $key->id }}"
                                                {{ $direccion->direccion_id == $key->id ? "selected" : "" }}>
                                                {{ $key->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error("direccion_id")
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mt-3">
                                    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                                        type="submit">Actualizar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
