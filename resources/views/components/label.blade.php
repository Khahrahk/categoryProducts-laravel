<label {{ $attributes->class([
    'text-danger-600'  => $hasError
    ]) }}>
    {!! $label ?? $slot !!}
</label>
