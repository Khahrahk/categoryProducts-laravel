<?php

namespace App\Models\Presenters;

use Illuminate\Database\Eloquent\Model;

abstract class Presenter implements Presentable
{
    protected Model $entity;

    public function __construct(Model $entity)
    {
        $this->entity = $entity;
    }

    public function __get(string $property): mixed
    {
        if (method_exists($this, $property)) {
            return $this->{$property}();
        }

        return $this->entity->{$property};
    }

    public function __isset($property): bool
    {
        return property_exists($this, $property) || property_exists($this->entity, $property);
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
