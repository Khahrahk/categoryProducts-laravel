<?php

namespace App\Providers;

use App\View\Components\Button;
use App\View\Components\Icon;
use App\View\Components\Input;
use App\View\Components\Label;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::component('input', Input::class);
        Blade::component('label', Label::class);
        Blade::component('icon', Icon::class);
        Blade::component('button', Button::class);
    }
}
