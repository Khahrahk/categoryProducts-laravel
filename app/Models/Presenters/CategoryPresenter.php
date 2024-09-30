<?php

namespace App\Models\Presenters;

class CategoryPresenter extends Presenter
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
        return 3;
    }

    public function searchQuery(?string $query = null)
    {
        return $this->entity->search($query);
    }

    public function url(): string
    {
        return '';
    }

}
