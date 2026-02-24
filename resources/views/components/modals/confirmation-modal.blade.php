<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="{{ $id }}Label"
    aria-hidden="true">
    <div class="modal-dialog {{ $centered ? 'modal-dialog-centered' : '' }}">
        <div class="modal-content">
            <div class="modal-header {{ $headerClass ?? 'bg-danger text-white' }}">
                <h5 class="modal-title" id="{{ $id }}Label">{{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <div class="modal-body">
                @if ($bannerText)
                    <p id="{{ $bannerId ?? '' }}">{{ $bannerText }}</p>
                @endif

                @if ($showMotivo ?? false)
                    <div class="mb-3">
                        <label for="{{ $selectId }}" class="form-label">Motivo de baja</label>
                        <select id="{{ $selectId }}" class="form-select">
                            <option value="">-- Selecciona un motivo --</option>
                            @foreach ($motivos ?? [] as $motivo)
                                <option value="{{ $motivo->id }}">{{ $motivo->nombre }}</option>
                            @endforeach
                        </select>
                        <div id="{{ $warningId }}" class="text-danger mt-1" style="display:none;">
                            Debes seleccionar un motivo.
                        </div>
                    </div>
                @endif
            </div>

            <div class="modal-footer">
                <form id="{{ $formId }}" action="{{ $action }}" method="{{ $method ?? 'POST' }}">
                    @csrf
                    @if (isset($method) && $method != 'POST')
                        @method($method)
                    @endif
                    @if ($statusId ?? false)
                        <input type="hidden" name="status" id="{{ $statusId }}">
                    @endif
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">{{ $buttonText ?? 'Confirmar' }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
