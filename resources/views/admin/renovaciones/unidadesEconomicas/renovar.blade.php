@extends('layouts.app')
@section('title', 'Renovar Convenio')

@section('content')
    <div class="row">
        <div class="col-md-8 mx-auto">

            <div class="card shadow-sm border-0">

                {{-- HEADER --}}
                <div class="card-header">
                    <h5 class="mb-0">Renovación de Convenio</h5>
                    <small class="text-muted">
                        Registro de nueva versión del convenio
                    </small>
                </div>

                <div class="card-body">

                    {{-- INFO ACTUAL --}}
                    <div class="mb-4">
                        <h6 class="text-muted">Información actual</h6>

                        <div class="p-3 bg-light rounded">

                            <strong>{{ $empresa->nombre }}</strong><br>
                            <small>{{ $empresa->email }}</small><br>

                            <hr class="my-2">

                            <small>
                                Convenio actual:
                                <strong>{{ $convenio->tipo }}</strong>
                            </small><br>

                            <small>
                                Vigencia:
                                <strong>{{ $convenio->inicio }} - {{ $convenio->fin }}</strong>
                            </small>

                        </div>
                    </div>

                    {{-- FORM --}}
                    <form action="{{ route('convenios.renovar.store', $empresa->id) }}" method="POST"
                        enctype="multipart/form-data">

                        @csrf

                        <h6 class="text-muted mb-3">Nuevo convenio</h6>

                        {{-- TIPO --}}
                        <div class="mb-3">
                            <label class="form-label">Tipo de convenio</label>
                            <select name="tipo" class="form-select" required>
                                <option value="ESPECIFICO">ESPECÍFICO</option>
                                <option value="MARCO-EMPRESA">MARCO-EMPRESA</option>
                            </select>
                        </div>

                        {{-- FECHAS --}}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Fecha inicio</label>
                                <input type="date" name="inicio" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Fecha fin</label>
                                <input type="date" name="fin" class="form-control" required>
                            </div>
                        </div>

                        {{-- ARCHIVO --}}
                        <div class="mb-3">
                            <label class="form-label">Archivo PDF</label>
                            <input type="file" name="archivo" class="form-control" accept="application/pdf">
                        </div>

                        {{-- VERSION --}}
                        <div class="mb-3">
                            <label class="form-label">Versión</label>
                            <input type="text" name="version" class="form-control" placeholder="Ej. v2.0">
                        </div>

                        {{-- ACCIONES --}}
                        <div class="d-flex justify-content-end gap-2">

                            <a href="{{ url()->previous() }}" class="btn btn-secondary">
                                Cancelar
                            </a>

                            <a href="{{ route('storeRenovarEmpresa', $estudiante->id) }}" class="btn btn-success">
                                Renovar
                            </a>

                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
