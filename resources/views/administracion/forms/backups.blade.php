<div class="settings-section">

    <h4 class="settings-title">
        Respaldo de Base de Datos
    </h4>



    <div class="border rounded p-3 bg-light mb-4">

        {{-- Último respaldo --}}
        <div class="mb-4">

            <label class="form-label text-muted small">
                Último respaldo generado
            </label>

            <div class="fw-semibold">

                @if ($ultimoArchivo)
                    {{ basename($ultimoArchivo) }}
                @else
                    Sin respaldos disponibles
                @endif

            </div>

        </div>

        {{-- Ubicación --}}
        <div class="mb-4">

            <label class="form-label text-muted small">
                Ubicación
            </label>

            <div class="fw-semibold">
                storage/app/UTVT
            </div>

        </div>

        {{-- Historial --}}
        <div>

            <label class="form-label text-muted small">
                Historial de respaldos
            </label>

            @forelse ($files as $file)
                <div class="d-flex justify-content-between align-items-center border-bottom py-2">

                    <div>

                        <div class="fw-semibold">
                            {{ basename($file) }}
                        </div>

                        <small class="text-muted">
                            {{ \Carbon\Carbon::createFromTimestamp(Storage::disk('local')->lastModified($file))->format('d/m/Y H:i') }}
                        </small>

                    </div>

                    <a href="{{ route('admin.backup.download', ['file' => $file]) }}"
                        class="btn btn-sm btn-outline-primary">

                        <span class="mdi mdi-download"></span>
                        Descargar

                    </a>

                </div>

            @empty

                <div class="text-muted">
                    No existen respaldos generados.
                </div>
            @endforelse

        </div>

    </div>

    <div class="d-flex justify-content-end gap-2">


        @if ($ultimoArchivo)
            <a href="{{ route('admin.backup.download', $file) }} class="btn btn-primary">
                <span class="mdi mdi-download me-1"></span>

                Descargar Último

            </a>
        @endif

    </div>


</div>
