@extends('layouts.app')
@section('title', 'Editar Estudiante')

@section('content')
<body class="body">
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Editar Estudiante Dual</h4>
                            <span class="text-danger">* Son campos requeridos</span>
                            <div class="dropdown-divider"></div>
                            <form class="pt-3"
                                action="{{ route('estudiantes.update', Vinkla\Hashids\Facades\Hashids::encode($estudiante->matricula)) }}"
                                method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="row">

                                    <div class="col-md-6">

                                        <a id='evaluacion_form_'
                                            href="{{ url(Storage::url($estudiante->evaluacion_form)) }}"
                                            class=" form-control form-control-lg btn-primary" target="_blank">Ver
                                            Evalucaion de formacion
                                            <span class="mdi mdi-file-pdf-box"></span>
                                        </a>
                                    </div>

                                    <div class="form-group">
                                        <label for="formato54">Formato 5.4<span class="text-danger">*</span></label>
                                        <div
                                            style=" display: flex; justify-content: space-between;align-items: center; gap: 4px">
                                            <input hidden type="file" class="form-control form-control-lg" id="formato54"
                                                placeholder="formato54" name="formato54" value="{{ old('formato54') }}">
                                            @error('formato54')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            <a id='formato54_' href="{{ url(Storage::url($estudiante->formato54)) }}"
                                                class=" form-control form-control-lg btn-primary" target="_blank">Ver
                                                formato 5.4
                                                <span class="mdi mdi-file-pdf-box"></span>
                                            </a>
                                            {{-- <button class="btn btn-secondary w-50  " id='formato54C'
                                                                                        onclick="ocultar('formato54_','formato54','formato54C')" type="button">Cambiar Documento</button>
                                                                                --}}
                                        </div>
                                    </div>

                                </div>

                                
                            <div class="d-flex justify-content-end mt-3">
                                    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                                        type="submit">Editar
                                    </button>
                                </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function ocultar(id, id2, text) {
            const elemento = document.getElementById(`${id}`);
            elemento.hidden = !elemento.hidden;
            document.getElementById(`${text}`).textContent = elemento.hidden ? 'Ver Documento' :
                'Cambiar Documento'; // Habilita el botón para cambiar el archivo
            if (!elemento.hidden) {
                document.getElementById(id2).value = '';


            }
            const elemento1 = document.getElementById(`${id2}`);
            elemento1.hidden = !elemento1.hidden; // Habilita el botón para cambiar el archivo
        }

        function mostrarInput() {
            var becaValue = document.getElementById('beca').value;
            var becitaInput = document.getElementById('tipoBeca');
            console.log(becaValue)
            if (becaValue == 0) { // Reemplaza 'el_valor_especifico' con el valor específico que deseas comparar
                becitaInput.style.display = 'block';
            } else {
                becitaInput.style.display = 'none';
            }
        }

        // Función para cambiar el archivo
        function changeFile() {
            // Restablece el campo de entrada de archivos seleccionado
            document.getElementById('carta_acp').value = '';
        }
    </script>
@endsection
</body>