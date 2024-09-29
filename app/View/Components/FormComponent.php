<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\ComponentAttributeBag;

abstract class FormComponent extends BaseComponent
{
    public function render()
    {
        return function (array $data) {
            return view($this->getView(), $this->mergeAttributes($data))->render();
        };
    }

    abstract protected function getView(): string;

    protected function mergeAttributes(array $data): array
    {
        /** @var ComponentAttributeBag $attributes */
        $attributes = $data['attributes'];

        if ($attributes->has('name') && !$attributes->has('id')) {
            $attributes->offsetSet('id', md5($attributes->get('name')));
        }

        foreach ($this->sharedAttributes() as $attribute) {
            $value = property_exists($this, $attribute) ? data_get($this, $attribute) : $attributes->get($attribute);
            $data[$attribute] = $value;
            $attributes->offsetSet($attribute, $value);
        }

        return $data;
    }

    protected function sharedAttributes(): array
    {
        return ['id', 'name', 'disabled', 'readonly', 'checked'];
    }
}
