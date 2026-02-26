@foreach (['success', 'error', 'warning'] as $type)
    @if (session($type))
        @php
            $classes = match ($type) {
                'success' => 'alert-success',
                'error' => 'alert-danger',
                'warning' => 'alert-warning',
                default => 'alert-info',
            };
        @endphp
        <div class="alert {{ $classes }} alert-dismissible fade show" role="alert">
            {{ session($type) }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
@endforeach
