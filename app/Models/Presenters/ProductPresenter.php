<?php

namespace App\Models\Presenters;

class ProductPresenter extends Presenter
{
    public function initials()
    {
        $name = $this->name();
        $nameParts = substr($name, 0, 2);
        return strtoupper($nameParts);
    }

    public function name()
    {
        $name = trim($this->entity->name);
        return $name ?: '';
    }

    public function description()
    {
        $name = trim($this->entity->description);
        return $name ?: '';
    }

    public function price()
    {
        $name = trim($this->entity->price);
        return $name ?: '';
    }

    public function title(): string
    {
        return '';
    }

    public function subTitle(): string
    {
        return '';
    }

    public function label(): string
    {
        return '';
    }

    public function singularLabel(): string
    {
        return '';
    }

    public function perSearchShow(): int
    {
        return 0;
    }

    public function url(): string
    {
        return '';
    }

}
