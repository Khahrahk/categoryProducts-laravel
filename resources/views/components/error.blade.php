@error($name)
<label {{ $attributes->merge(['class' => 'text-danger-500']) }}>
    <x-icon name="x"/>
    {{ $message }}
</label>
@else
    @if($name)
        <label {{ $attributes->merge(['class' => 'text-danger-500']) }}>
            <x-icon name="x"/>
            {{ $name }}
        </label>
    @endif
@enderror
