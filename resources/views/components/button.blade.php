@php
    $defaultAttributes = [];
    if(!$tag) {
        if($href) {
            $tag = 'a';
            $defaultAttributes['href'] = $href;
        } else {
            $tag = 'button';
            $defaultAttributes['type'] = 'button';
        }
    }
@endphp
<{{ $tag }} {{ $attributes->merge($defaultAttributes) }}>
@if ($iconLeft)
    <x-icon :name="$iconLeft"/>
@endif
{!! $label ?? $slot !!}
@if($iconRight)
    <x-icon :name="$iconRight" class="align-items-center" />
@endif
</{{ $tag }}>
