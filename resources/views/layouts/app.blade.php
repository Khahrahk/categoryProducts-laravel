<!DOCTYPE html>
<html class="loading" lang="" data-textdirection="">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    @routes
    <title>@yield('title') - {{ config('app.name') }}</title>
    <link rel="apple-touch-icon" href="{{ asset('images/ico/favicon.ico') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/ico/favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @include('panels/styles')
</head>
<body class="vertical-layout vertical-menu-modern blank-page" data-menu="vertical-menu-modern" data-col="blank-page" data-framework="laravel" data-asset-path="{{ asset('/') }}">
<div class="d-flex flex-column app-content content h-100">
    @include('panels.navbar')
    <div class="d-flex flex-row content-area-wrapper h-100">
        <div class="d-flex flex-column">
            <div class="d-flex flex-row h-100">
                @include('panels.sidebar')
            </div>
        </div>
        <div class="d-flex flex-column w-100">
            <div class="d-flex flex-row w-100">
                @yield('header')
            </div>
            <div class="d-flex flex-row content-area-wrapper h-100">
                <div class="d-flex flex-column w-100">
                    <div class="d-flex flex-row h-100">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('panels/footer')
@include('panels/scripts')
</body>
</html>
