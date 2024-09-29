@extends('layouts.app')

@section('title', 'Регистрация')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset(mix('css/plugins/forms/form-validation.css')) }}">
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset(mix('css/pages/auth/authentication.css')) }}">
@endsection

@section('header')
    <nav class="navbar navbar-page navbar-expand-lg bg-white d-flex flex-row w-100 ps-3 pb-1"
         style="margin: 0; box-shadow: none; border-bottom:  1px solid rgba(0, 0, 0, 0.1); height: 45px">
        <x-button class="toggle-right close" size="sm" monochrome outline iconRight="burger-menu-svgrepo-com"></x-button>

        <div class="container-fluid">

        </div>
    </nav>
@endsection

@section('content')
    <div class="d-flex flex-column col-12 align-items-center h-100">
        <div class="content col-6 h-100" style="min-width: 300px; max-width: 500px;">
                <div class="login-island" style="padding-top: 50%">
                    <form method="POST" action="{{ route("register_process") }}" class="card w-100">
                        <h5 class="card-header d-flex flex-column align-items-center justify-content-center">Регистрация</h5>
                        <div class="card-body p-3">
                            @csrf
                            <div class="form d-flex flex-column gap-3">
                                <x-input name="name" label-top error-less placeholder="Никнейм" :value="old('login')" wrapper-class="w-100" required />
                                <x-input name="email" label-top error-less placeholder="Email" :value="old('login')" wrapper-class="w-100" required />
                                <x-input name="password" type="password" label-top error-less placeholder="Пароль" wrapper-class="w-100" required />
                                <x-input name="password_confirmation" type="password" label-top error-less placeholder="Подтвердите пароль" wrapper-class="w-100" required />
                            @if($errors->any())
                                    <div class="invalid-feedback d-block">{{ $errors->first() }}</div>
                                @endif
                            </div>
                            <div class="d-flex flex-row py-3">
                                <x-button link primary :href="route('login')" label="Вход" />
                            </div>
                            <div class="d-flex flex-column action">
                                <x-button outline primary full label="Подтвердить" type="submit" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection

@section('vendor-script')
    <script src="{{asset(mix('js/plugins/forms/validation/jquery.validate.min.js'))}}"></script>
@endsection

@section('page-script')
    <script src="{{asset(mix('js/pages/auth/auth-login.js'))}}"></script>
@endsection
