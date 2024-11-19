@extends('layouts.app')
@section('title', 'Mostrar Mentor Industrial')

@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mt-3 ps-3">Mentor Industrial</h4>
                        <div class="dropdown-divider"></div>
                        <div class="form-group">
                            <label for="titulo">Titulo</label>
                            <input type="text" class="form-control form-control-lg" id="titulo"
                                placeholder="" name="titulo" value="{{ $mentorIndustrial->titulo }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control form-control-lg" id="name"
                                placeholder="" name="name" value="{{ $mentorIndustrial->name }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="name">Empresa</label>
                            <input type="text" class="form-control form-control-lg" id="name"
                                placeholder="" name="name" value="{{ $mentorIndustrial->empresa->nombre }}" disabled>
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="row pt-3">
                            <div class="col d-flex justify-content-end">
                            <a href="/mentores"
                                    class="btn btn-secondary btn-sm">
                                    Volver
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection