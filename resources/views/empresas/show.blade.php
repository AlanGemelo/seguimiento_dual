@php
    use Illuminate\Support\Facades\Storage;
@endphp

@extends ('layouts.app')
@section('title', 'Mostrar UEI')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <x-forms.section-header title="Datos de la Unidad Económica interesada"
                    description="Visualización de la información de la Unidad Económica (UE)." />

                <div class="card-body">
                    <!-- Información Básica -->
                    <div class="mb-4">
                        <h5 class="section-title fw-bold">
                            Información Básica
                        </h5>
                        <small class="text-muted text-stone-950">(Datos principales)</small>
                        <div class="dropdown-divider mb-4"></div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nombre" class="form-label">Nombre de la empresa
                                </label>
                                <input type="text" class="form-control" id="nombre"
                                    placeholder="Razón social o nombre legal de la empresa" name="nombre"
                                    value="{{ $empresa->nombre }}" disabled />
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="direccion" class="form-label">Dirección de la sede principal
                                </label>
                                <input type="text" class="form-control" id="direccion" name="direccion"
                                    value="{{ old('direccion', $empresa->direccion) }}" disabled />
                            </div>
                        </div>
                    </div>

                    {{-- Datos de Contacto --}}
                    <div class="row mb-4">
                        <h5 class="section-title fw-bold">
                            Datos de Contacto
                        </h5>
                        <small class="text-muted text-stone-950">(Comunicación directa)</small>
                        <div class="dropdown-divider mb-4"></div>

                        <!-- Correo -->
                        <div class="col-md-5 mb-3">
                            <label for="email" class="form-label">Correo Electrónico
                                <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ old('email', $empresa->email) }}" disabled />
                        </div>

                        <!-- Extensión -->
                        <div class="col-md-2 mb-3" style="max-width: 10%">
                            <label for="ext_telefonica" class="form-label">Ext.</label>
                            <input type="text" class="form-control" id="ext_telefonica" name="ext_telefonica"
                                placeholder="Ext." value="{{ $empresa->ext_telefonica ?? 'N/A' }}" disabled />
                        </div>

                        <!-- Teléfono -->
                        <div class="col-md-5 mb-3">
                            <label for="telefono" class="form-label">Teléfono de contacto
                                <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="telefono" name="telefono"
                                value="{{ preg_replace('/(\d{3})(\d{3})(\d{4})/', '$1-$2-$3', $empresa->telefono) }}"
                                disabled />
                        </div>
                    </div>

                    {{--  Vinculación Académica --}}
                    <div class="row">
                        <h5 class="section-title fw-bold">
                            Vinculación Académica
                            <span class="text-danger">*</span>
                        </h5>
                        <small class="text-muted text-stone-950">
                            (Relación con la universidad)
                        </small>
                        <div class="dropdown-divider mb-1"></div>
                        <div class="p-3">
                            <div class="form-group">
                                <label for="direcciones_ids" class="form-label">Direcciones de Carrera
                                </label>
                                @if ($empresa->direcciones->count() > 0)
                                    <ul class="list-group">
                                        @foreach ($empresa->direcciones as $direccion)
                                            <li class="list-group-item">
                                                {{ $direccion->name }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <div class="alert alert-warning">
                                        No se han seleccionado direcciones
                                        de carrera
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- Documentos del Convenio -->
                    <div class="mb-4 p-3">
                        <h5 class="section-title fw-bold">
                            Documentos del Convenio
                        </h5>
                        <div class="dropdown-divider mb-4"></div>

                        @if ($empresa->convenios->count() > 0)

                            @foreach ($empresa->convenios as $conv)
                                <div class="card mb-4 shadow-sm border-0">
                                    <div class="card-header text-black">

                                        {{ $conv->tipo == 'ESPECIFICO' ? 'Convenio Específico' : 'Convenio Marco' }}
                                    </div>

                                    <div class="card-body">

                                        <div class="row mb-3">

                                            <!-- VIGENCIA -->
                                            <div class="col-md-4">
                                                <label class="fw-semibold">Tipo de vigencia</label><br>

                                                @if ($conv->vigencia === 'INDEFINIDO')
                                                    <span class="badge bg-success">Indefinido</span>
                                                @else
                                                    <span class="badge bg-primary">Limitado</span>
                                                @endif
                                            </div>

                                            <!-- INICIO -->
                                            <div class="col-md-4">
                                                <label class="fw-semibold">Fecha de inicio</label><br>
                                                <span>{{ $conv->inicio }}</span>
                                            </div>

                                            <!-- FIN -->
                                            <div class="col-md-4">
                                                <label class="fw-semibold">Fecha de fin</label><br>
                                                <span>{{ $conv->fin ?? 'No aplica' }}</span>
                                            </div>

                                        </div>

                                        <!-- ARCHIVO -->
                                        <div class="mt-3">
                                            <label class="fw-semibold">Archivo</label><br>

                                            @if ($conv->archivo)
                                                <a href="{{ asset('storage/' . $conv->archivo) }}" target="_blank"
                                                    class="btn btn-sm btn-outline-primary">
                                                    Ver documento
                                                </a>
                                            @else
                                                <span class="text-muted">No disponible</span>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="alert alert-warning">
                                No hay convenios registrados para esta empresa.
                            </div>
                        @endif
                    </div>

                    <!-- Botones de Acción -->
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                        <x-buttons.back-button url="{{ route('empresas.index') }}" />
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
