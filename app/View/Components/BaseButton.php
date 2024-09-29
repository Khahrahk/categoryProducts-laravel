<?php

namespace App\View\Components;

use Illuminate\View\ComponentAttributeBag;

abstract class BaseButton extends BaseComponent
{
    protected array $smartAttributes = [];

    public function __construct(
        public bool $outline = false,
        public bool $flat = false,
        public bool $link = false,
        public bool $full = false,
        public ?string $color = null,
        public ?string $size = null,
        public ?string $label = null,
        public ?string $iconLeft = null,
        public ?string $iconRight = null,
        public ?string $href = null
    ) {
    }

    abstract public function render();

    protected function mergeData(array $data): array
    {
        /** @var ComponentAttributeBag $attributes */
        $attributes = $data['attributes'];
        $attributes = $this->mergeClasses($attributes);
        $data['disabled'] = (bool)$attributes->get('disabled');
        $data['attributes'] = $attributes->except($this->smartAttributes);

        return $data;
    }

    private function mergeClasses(ComponentAttributeBag $attributes): ComponentAttributeBag
    {
        return $attributes->class([
            'l-button align-items-center d-inline-flex justify-content-center',
            'button-icon' => !$this->label,
            'w-100' => $this->full,
            $this->size($attributes),
            $this->color($attributes),
        ]);
    }

    private function size(ComponentAttributeBag $attributes): string
    {
        return $this->size
            ? $this->sizes()[$this->size]
            : $this->modifierClasses($attributes, $this->sizes());
    }

    abstract public function sizes(): array;

    private function color(ComponentAttributeBag $attributes): string
    {
        return $this->color
            ? $this->currentColors()[$this->color]
            : $this->modifierClasses($attributes, $this->currentColors());
    }

    abstract public function currentColors(): array;

    abstract public function defaultColors(): array;
}
