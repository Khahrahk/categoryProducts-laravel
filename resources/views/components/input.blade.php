@php
    $hasError = !$errorLess && $name && isset($errors) && $errors->has($name);
    $name = $attributes->get('name');
@endphp
<div @class(['d-flex flex-column', $wrapperClass])>
    @if ($label)
        <div @class(['input-unit w-100', 'flex-column' => $labelTop])>
            <x-label :label="$label" :has-error="$hasError" :for="$id" @class(["unit-label", $labelWidth])/>
            <div class="d-flex flex-column unit-contents justify-content-center align-items-start w-100 flex-shrink-1">
                @endif
                <div @class(['relative l-input d-flex w-100', $size])>
                    @if ($iconLeft)
                        <div class="absolute pointer-events-none d-flex h-100 align-items-center icon-wrapper icon-left">
                            <x-icon :name="$iconLeft" @class(['opacity-50' => $attributes->has('disabled') && !empty($attributes->get('disabled'))])/>
                        </div>
                    @elseif($prepend)
                        {{ $prepend }}
                    @endif

                    <input {{ $attributes->class([$getInputClasses($hasError, (bool)$prepend, (bool)$append)])->merge(['type' => 'text', 'autocomplete' => 'off', 'name' => $name]) }} />
                    @if ($iconRight)
                        <div class="absolute pointer-events-none d-flex h-100 align-items-center icon-wrapper icon-right">
                            <x-icon :name="$iconRight" @class(['opacity-50' => $attributes->has('disabled') && !empty($attributes->get('disabled'))])/>
                        </div>
                    @elseif ($append)
                        {{ $append }}
                    @endif
                </div>
                @if (!$hasError && $hint)
                    <label @if ($id) for="{{ $id }}" @endif>
                        {{ $hint }}
                    </label>
                @endif
                @if($frontendErrorMessage)
                    <x-error class="error hidden" :name="$frontendErrorMessage" @if ($id) for="{{ $id }}" @endif />
                @endif
                @if ($hasError)
                    <x-error :name="$name" @if ($id) for="{{ $id }}" @endif />
                @endif
                @if ($label)
            </div>
        </div>
    @endif
</div>
