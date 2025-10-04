@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/dashboardrector.css') }}">

    <body class="body">
        <div class="row">
            <div class="col-12 grid-margin">
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible text-dark" role="alert">
                        <span class="text-sm"> <a href="javascript:" class="alert-link text-dark">Excelente</a>.
                            {{ session('status') }}.</span>
                        <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="row flex-grow justify-content-center">
                    @if (Auth::user()->rol_id === 1 || Auth::user()->rol_id === 4)
                        <div class="col-lg-4 d-flex flex-column">
                            <div class="row flex-grow">
                                <div class="col-12 grid-margin stretch-card">
                                    <div class="card card-rounded shadow-lg border-0">
                                        <div class="card-body text-center">
                                            <h4 class="text-secondary font-weight-bold mb-3">Mentores Industriales
                                                Registrados</h4>
                                            <h2 class="text-primary display-4">{{ $mentores }}</h2>
                                            <br>
                                            <a type="button" class="btn btn-success btn-lg btn-block"
                                                href="{{ route('mentores.create') }}">
                                                <i class="mdi mdi-account-plus mdi-24px align-middle"></i> Crear Mentor
                                                Industriales
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="col-lg-4 d-flex flex-column">
                        <div class="row flex-grow justify-content-center">
                            <div class="col-12 grid-margin stretch-card">
                                <div class="card card-rounded shadow-lg border-0">
                                    <div class="card-body text-center">
                                        <h4 class="text-secondary font-weight-bold mb-3">Estudiantes Registrados</h4>
                                        <h2 class="text-primary display-4">{{ $estudiantes }}</h2>
                                        <br>
                                        <a type="button" class="btn btn-success btn-lg btn-block"
                                            href="{{ route('estudiantes.create') }}">
                                            <i class="mdi mdi-account-plus mdi-24px align-middle"></i> Crear Estudiante
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 d-flex flex-column">
                        <div class="row flex-grow justify-content-center">
                            <div class="col-12 grid-margin stretch-card">
                                <div class="card card-rounded shadow-lg border-0">
                                    <div class="card-body text-center">
                                        <h4 class="text-secondary font-weight-bold mb-3">Documentación por vencer</h4>
                                        <h2 class="text-warning display-4"><i class="mdi mdi-alert-circle-outline"></i></h2>
                                        <br>
                                        <a type="button" class="btn btn-success btn-lg btn-block"
                                            href="{{ route('estudiantes.index') }}">
                                            <i class="mdi mdi-file-document-box mdi-24px align-middle"></i> Actualizar
                                            Documentación
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 d-flex flex-column">
                        <div class="row flex-grow justify-content-center">
                            <div class="col-12 grid-margin stretch-card">
                                <div class="card card-rounded shadow-lg border-0">
                                    <div class="card-body text-center">
                                        <h4 class="text-secondary font-weight-bold mb-3">Reporte General</h4>
                                        <p class="text-muted">
                                            Este es el reporte general de los alumnos del modelo de formación dual, que
                                            incluye información relevante sobre su trayectoria académica, mentores,
                                            proyectos y unidades economicas asignadas.
                                        </p>
                                        <br>
                                        <a type="button" class="btn btn-success btn-lg btn-block"
                                            href="{{ route('reporte.general') }}">
                                            <i class="mdi mdi-file-excel mdi-24px align-middle"></i>
                                            Descargar Reporte General (Excel)
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    {{-- <div class="bg-white shadow-lg rounded-lg p-8 max-w-md w-full">
                <div class="bg-gray-800 text-white py-4 px-6 rounded-t-lg text-center">
                    <h2 class="text-xl font-bold">Universidad XYZ</h2>
                </div>
                <div class="p-6">
                    <p class="text-gray-700 mb-4">Estimado(a) Profesor(a),</p>
                    <p class="text-gray-700 mb-4">
                        Le informamos que la documentación del alumno <strong>Alan Ortega</strong> está próxima a caducar.
                        Le solicitamos su colaboración para revisar y actualizar los documentos necesarios antes de la fecha
                        de vencimiento.
                    </p>
                    <p class="text-gray-700">Agradecemos su atención a este asunto.</p>
                </div>



            </div>
            <div class="bg-white shadow-lg rounded-lg p-8 max-w-md w-full">
                <div class="bg-gray-800 text-white py-4 px-6 rounded-t-lg text-center">
                    <h2 class="text-xl font-bold">Universidad XYZ</h2>
                </div>
                <div class="p-6">
                    <p class="text-gray-700 mb-4">
                        Lista de documentaciones próximas a vencer:
                    </p>
                    <ul class="list-disc list-inside space-y-2">
                        <li class="bg-gray-100 p-2 rounded-md">Alan Ortega - Certificado de Estudios - Vence: 15 de Septiembre</li>
                        <li class="bg-gray-100 p-2 rounded-md">Maria López - Acta de Nacimiento - Vence: 18 de Septiembre</li>
                        <li class="bg-gray-100 p-2 rounded-md">Carlos Pérez - Identificación Oficial - Vence: 20 de Septiembre</li>
                    </ul>
                </div>
                <div class="text-center mt-6">
                    <p class="text-sm text-gray-500">Atentamente,</p>
                    <p class="text-sm text-gray-500">Coordinación Administrativa, Universidad XYZ</p>
                </div>
            </div> --}}


                </div>
            </div>
        </div>
    @endsection
</body>
