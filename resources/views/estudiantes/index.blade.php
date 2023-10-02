@extends('layouts.app')
@section('title', 'Estudiantes')

@section('content')
    <div class="row">
        <div class="col-12 grid-margin">
            @if( session('status') )
                <div class="alert alert-success alert-dismissible text-dark" role="alert">
                <span class="text-sm"> <a href="javascript:" class="alert-link text-dark">Excelente</a>.
                    {{ session('status') }}.</span>
                    <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary rounded pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Lista De Estudiantes</h6>
                                <div class="float-end">
                                    {{-- Button del modal --}}
                                    <a href="{{route('estudiantes.create')}}" class="btn btn-primary"
                                       title="Agregar una nueva Moto">
                                        <i class="mdi mdi-plus-circle-outline"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Matricula</th>
                                        <th>Estudiante</th>
                                        <th>CURP</th>
                                        <th>Fecha de Nacimiento</th>
                                        <th>Cuatrimestre</th>
                                        <th>Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($estudiantes as $estudiante)
                                        <tr>
                                            <td>{{ $estudiante->matricula }}</td>
                                            <td>{{ $estudiante->name }}</td>
                                            <td>{{ $estudiante->curp }}</td>
                                            <td>{{ $estudiante->fecha_na }}</td>
                                            <td>{{ $estudiante->cuatrimestre }}</td>
                                            <td>
                                                <a href="{{ route('estudiantes.show', Vinkla\Hashids\Facades\Hashids::encode($estudiante->matricula)) }}"
                                                   class="btn btn-facebook">
                                                    <i class="mdi mdi-eye btn-icon-prepend"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
