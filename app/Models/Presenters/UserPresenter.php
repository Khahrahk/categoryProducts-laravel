<?php

namespace App\Models\Presenters;

class UserPresenter extends Presenter
{
    public function initials()
    {
        $name = $this->login();
        $nameParts = explode(' ', trim($name));
        return count($nameParts) === 1
            ? strtoupper(mb_substr($name, 0, 2))
            : strtoupper(mb_substr($nameParts[0], 0, 1) . mb_substr(end($nameParts), 0, 1));
    }

    public function login()
    {
        $name = trim($this->entity->login);
        return $name ?: '';
    }

    public function email()
    {
        $email = trim($this->entity->email);
        return $email ?: $this->entity->login;
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
