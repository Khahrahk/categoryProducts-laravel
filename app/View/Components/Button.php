<?php

namespace App\View\Components;

use Illuminate\View\ComponentAttributeBag;

class Button extends BaseComponent
{
    protected array $smartAttributes = [];

    public function __construct(
        public bool $outline = false,
        public bool $flat = false,
        public bool $link = false,
        public bool $choice = false,
        public bool $full = false,
        public ?string $color = null,
        public ?string $size = null,
        public ?string $label = null,
        public ?string $iconLeft = null,
        public ?string $iconRight = null,
        public ?string $href = null,
        public ?string $tag = null,
    ) {
    }

    public function render()
    {
        return function (array $data) {
            return view('components.button', $this->mergeData($data))->render();
        };
    }

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
            'button-choice' => $this->choice,
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

    public function sizes(): array
    {
        return [
            'sm' => 'size-sm',
            'default' => 'size-md',
            'md' => 'size-md',
            'lg' => 'size-lg',
        ];
    }

    private function color(ComponentAttributeBag $attributes): string
    {
        return $this->color
            ? $this->currentColors()[$this->color]
            : $this->modifierClasses($attributes, $this->currentColors());
    }

    public function currentColors(): array
    {
        if ($this->outline) {
            return $this->outlineColors();
        }

        if ($this->flat) {
            return $this->flatColors();
        }

        if ($this->link) {
            return $this->linkColors();
        }

        return $this->defaultColors();
    }

    public function outlineColors(): array
    {
        return [
            'default' => 'type-secondary color-accent',
            'accent' => 'type-secondary color-accent',
            'monochrome' => 'type-secondary color-monochrome',
            'danger' => 'type-secondary color-danger',
        ];
    }

    public function flatColors(): array
    {
        return [
            'default' => 'type-flat color-accent',
            'accent' => 'type-flat color-accent',
            'monochrome' => 'type-flat color-monochrome',
            'danger' => 'type-flat color-danger',
        ];
    }

    public function linkColors(): array
    {
        return [
            'default' => 'type-link color-primary',
            'primary' => 'type-link color-primary',
            'danger' => 'type-link color-danger',
            'dark-mode' => 'type-link color-dark-mode',
            'monochrome' => 'type-link color-monochrome',
        ];
    }

    public function defaultColors(): array
    {
        return [
            'default' => 'type-primary color-accent',
            'primary' => 'type-primary color-primary',
            'accent' => 'type-primary color-accent',
            'monochrome' => 'type-primary color-monochrome',
            'danger' => 'type-primary color-danger',
        ];
    }
}
