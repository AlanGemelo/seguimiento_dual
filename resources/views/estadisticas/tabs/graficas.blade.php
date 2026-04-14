<div class="tab-content">

    <div class="tab-pane fade show active" id="graficas">

        <div class="row">

            {{-- Status --}}
            {{-- <div class="col-md-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-header text-white" style="background-color: #006837;">
                        <h6 class="mb-0 text-center">Estudiantes por Status</h6>
                    </div>
                    <div class="card-body">
                        {!! $chartStatus->container() !!}
                    </div>
                </div>
            </div> --}}



            {{-- Empresa --}}
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-header text-white" style="background-color: #006837;">
                        <h6 class="mb-0 text-center">Estudiantes por Empresa</h6>
                    </div>
                    <div class="card-body">
                        {!! $chartEmpresa->container() !!}
                    </div>
                </div>
            </div>

            {{-- Mentor --}}

            <div class="col-md-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-header text-white" style="background-color: #006837;">
                        <h6 class="mb-0 text-center">Estudiantes por Empresa</h6>
                    </div>
                    <div class="card-body">
                        {!! $chartMentor->container() !!}
                    </div>
                </div>
            </div>

            {{-- Beca --}}
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-header text-white" style="background-color: #006837;">
                        <h6 class="mb-0 text-center">Estudiantes Becados</h6>
                    </div>
                    <div class="card-body">
                        {!! $chartBeca->container() !!}
                    </div>
                </div>
            </div>

            {{-- Carrera --}}
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-header text-white" style="background-color: #006837;">
                        <h6 class="mb-0 text-center">Estudiantes por Carrera</h6>
                    </div>
                    <div class="card-body">
                        {!! $chartCarrera->container() !!}
                    </div>
                </div>
            </div>



        </div>

    </div>

</div>
