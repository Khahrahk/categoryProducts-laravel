<?php

namespace App\View\Components;

class Input extends FormComponent
{
    public function __construct(
        public bool $sm = false,
        public bool $md = false,
        public bool $lg = false,
        public ?string $size = null,
        public ?string $label = null,
        public ?string $labelWidth = null,
        public ?string $hint = null,
        public ?string $iconLeft = null,
        public ?string $iconRight = null,
        public ?string $prepend = null,
        public ?string $append = null,
        public ?string $wrapperClass = null,
        public bool $errorLess = false,
        public bool $labelTop = false,
        public ?string $frontendErrorMessage = null,
    ) {
        $this->size ??= $this->getSize();
    }

    private function getSize(): string
    {
        return $this->classes([
            'size-sm' => $this->sm,
            'size-md' => $this->md || $this->shouldUseDefault(),
            'size-lg' => $this->lg,
        ]);
    }

    private function shouldUseDefault(): bool
    {
        return !$this->sm && !$this->lg;
    }

    public function getInputClasses(bool $hasError = false, bool $hasPrepend = false, bool $hasAppend = false): string
    {
        $defaultClasses = $this->getDefaultClasses();

        if ($this->iconLeft) {
            $defaultClasses .= ' has-left';
        }

        if ($this->iconRight) {
            $defaultClasses .= ' has-right';
        }

        if ($hasPrepend) {
            $defaultClasses .= ' has-prepend';
        }

        if ($hasAppend) {
            $defaultClasses .= ' has-append';
        }

        if ($hasError) {
            return "{$this->getErrorClasses()} {$defaultClasses}";
        }

        return $defaultClasses;
    }

    protected function getDefaultClasses(): string
    {
        return str('w-100');
    }

    protected function getErrorClasses(): string
    {
        return str('has-error');
    }

    public function getView(): string
    {
        return 'components.input';
    }
}
