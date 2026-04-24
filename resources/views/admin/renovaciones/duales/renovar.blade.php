@extends('layouts.app')

@section('title', 'Renovar Estudiante Dual')

@section('content')
    <div class="row">
        <div class="col-md-8 mx-auto">

            <div class="card shadow-sm border-0">

                {{-- HEADER --}}
                <div class="card-header">
                    <h5 class="mb-0">Renovación de Estudiante Dual</h5>
                    <small class="text-muted">
                        Actualización de periodo de estadía dual
                    </small>
                </div>

                <div class="card-body">

                    {{-- INFO ACTUAL --}}
                    <div class="mb-4">
                        <h6 class="text-muted">Información actual</h6>

                        <div class="p-3 bg-light rounded">
                            <strong>
                                {{ $estudiante->name }} {{ $estudiante->apellidoP }} {{ $estudiante->apellidoM }}
                            </strong><br>

                            <small>Matrícula: {{ $estudiante->matricula }}</small><br>
                            <small>Programa educativo: {{ $estudiante->carrera->nombre ?? 'Sin carrera' }}</small><br>

                            <hr class="my-2">

                            <small>
                                Vigencia actual:
                                <strong>{{ $estudiante->fin_dual ?? 'No definida' }}</strong>
                            </small>
                        </div>
                    </div>

                    {{-- FORM --}}
                    <form action="{{ route('estudiantes.renovar.store', $estudiante->matricula) }}" method="POST">
                        @csrf

                        <h6 class="text-muted mb-3">Nueva vigencia</h6>

                        {{-- OPCIONES RAPIDAS --}}
                        <div class="mb-3">
                            <label class="form-label">Opciones rápidas</label>

                            <div class="d-flex gap-2 flex-wrap">

                                <button type="button" class="btn btn-outline-success btn-sm" onclick="setYears(1)">
                                    +1 Año
                                </button>

                                <button type="button" class="btn btn-outline-success btn-sm" onclick="setYears(2)">
                                    +2 Años
                                </button>

                                <button type="button" class="btn btn-outline-success btn-sm" onclick="setYears(3)">
                                    +3 Años
                                </button>

                            </div>
                        </div>

                        {{-- FECHA --}}

                        <div class="mb-3">
                            <label class="form-label">Fin Dual</label>
                            <input type="date" name="fin_dual" id="fin_dual" class="form-control" required>
                        </div>


                        {{-- ACCIONES --}}
                        <div class="d-flex justify-content-end gap-2">

                            <a href="{{ url()->previous() }}" class="btn btn-secondary">
                                Cancelar
                            </a>

                            <button type="submit" class="btn btn-success">
                                Renovar
                            </button>

                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function setYears(years) {
            let today = new Date();
            today.setFullYear(today.getFullYear() + years);

            let formatted = today.toISOString().split('T')[0];
            document.getElementById('fin_dual').value = formatted;
        }
    </script>
@endpush
