<?php

namespace App\Models\Presenters;

interface Presentable
{
    public function title(): string;

    public function subTitle(): string;

    public function label(): string;

    public function singularLabel(): string;

    public function perSearchShow(): int;

    public function url(): string;

}
