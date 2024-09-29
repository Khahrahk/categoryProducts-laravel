<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\ComponentAttributeBag;

abstract class BaseComponent extends Component
{
    protected function classes(array $classList): string
    {
        $classes = [];

        foreach ($classList as $class => $constraint) {
            if (is_numeric($class)) {
                $classes[] = $constraint;
            } elseif ($constraint) {
                $classes[] = $class;
            }
        }

        return implode(' ', $classes);
    }

    /**
     *      <x-badge xs ... /> will return "xs"
     *      <x-badge ... /> will return "default"
     */
    private function findModifier(ComponentAttributeBag $attributes, array $modifiers): string
    {
        $keys = collect($modifiers)->keys()->except(['default'])->toArray();
        $modifiers = $attributes->only($keys)->getAttributes();
        $modifier = collect($modifiers)->filter()->keys()->first();

        // store the modifier to remove from attributes bag
        if ($modifier && !in_array($modifier, $this->smartAttributes)) {
            $this->smartAttributes[] = $modifier;
        }

        return $modifier ?? 'default';
    }

    /** Finds the correct modifier css classes on attributes */
    public function modifierClasses(ComponentAttributeBag $attributes, array $modifiers): string
    {
        $modifier = $this->findModifier($attributes, $modifiers);

        return $modifiers[$modifier];
    }
}
