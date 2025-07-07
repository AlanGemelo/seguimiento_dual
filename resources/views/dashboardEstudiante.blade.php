@extends("layouts.app")
@section("title", "Dashboard")
@section("content")
<link rel="stylesheet" href="{{ asset('css/dashboardestudiante.css') }}">
<body class="body">
    <div class="card">
    <div class="row">
       
        <div class="col-12 grid-margin">
            @if (session("status"))
                <div class="alert alert-success alert-dismissible text-dark" role="alert">
                    <span class="text-sm"> <a href="javascript:" class="alert-link text-dark">Excelente</a>.
                        {{ session("status") }}.</span>
                    <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="card-body">
                <h6 class="card-title">Estudiante Dual</h6>
                <div class="dropdown-divider"></div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="matricula">Matricula</label>
                            <input type="number" class="form-control form-control-lg" id="matricula" name="matricula"
                                value="{{ $estudiante->matricula }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control form-control-lg" id="name"
                                placeholder="Juan Perez Hermenegildo" name="name" value="{{ $estudiante->name }}"
                                disabled>
                        </div>
                        <div class="form-group">
                            <label for="curp">CURP</label>
                            <input type="text" class="form-control form-control-lg" id="curp" name="curp"
                                value="{{ $estudiante->curp }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="fecha_na">Fecha de Nacimiento</label>
                            <input type="date" class="form-control form-control-lg" name="fecha_na" id="fecha_na"
                                value="{{ $estudiante->fecha_na }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="cuatrimestre">Cuatrimestre</label>
                            <input type="text" class="form-control form-control-lg" id="cuatrimestre" name="cuatrimestre"
                                value="{{ $estudiante->cuatrimestre }}" disabled>
                        </div>
                        <form class="pt-3"
                            action="{{ route("estudiantes.updateDocDual", Vinkla\Hashids\Facades\Hashids::encode($estudiante->matricula)), "doc-dual" }}"
                            method="post" enctype="multipart/form-data">
                            @csrf
                            @method("PATCH")
                            <div class="form-group">
                                <label for="formato54">Formato 5.4<span class="text-danger">*</span></label>
                                <div style=" display: flex; justify-content: space-between;align-items: center; gap: 4px">
                                    <input hidden type="file" class="form-control form-control-lg" id="formato54"
                                        placeholder="formato54" name="formato54" value="{{ old("formato54") }}">
                                    @error("formato54")
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <a id='formato54_' href="{{ url(Storage::url($estudiante->formato54)) }}"
                                        class=" form-control form-control-lg btn-primary" target="_blank">Ver
                                        formato 5.4
                                        <span class="mdi mdi-file-pdf-box"></span>
                                    </a>
                                    <button class="btn btn-secondary w-50  " id='formato54C'
                                        onclick="ocultar('formato54_','formato54','formato54C')" type="button">Cambiar
                                        Documento</button>
                                </div>
                            </div>
                            <div class="mt-3 d-flex justify-content-center">
                                <button hidden class="btn btn-lg btn-block btn-primary btn-lg font-weight-medium font-weight-medium w auth-form-btn "
                                    id="guardar" type="submit">Guardar
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>
    </div>
</div>
@endsection
<script>
    function ocultar(id, id2, text) {
        const elemento = document.getElementById(`${id}`);
        document.getElementById('guardar').hidden = !elemento.hidden ? false : true;
        elemento.hidden = !elemento.hidden;
        document.getElementById(`${text}`).textContent = elemento.hidden ? 'Ver Documento' :
            'Cambiar Documento'; // Habilita el botón para cambiar el archivo
        if (!elemento.hidden) {
            document.getElementById(id2).value = '';


        }
        const elemento1 = document.getElementById(`${id2}`);
        elemento1.hidden = !elemento1.hidden; // Habilita el botón para cambiar el archivo
    }
</script>
</body>