@extends('layouts.app')

@section('title', 'Product')

@section('page-style')
    <link rel="stylesheet" href="{{ asset(mix('css/pages/categories/category-datatable.css')) }}">
@endsection

@section('header')
    <nav class="navbar navbar-page navbar-expand-lg bg-white d-flex flex-row w-100 ps-3 pb-1"
         style="margin: 0; box-shadow: none; border-bottom:  1px solid rgba(0, 0, 0, 0.1); height: 45px">
        <x-button class="toggle-right close" size="sm" monochrome outline
                  iconRight="burger-menu-svgrepo-com"></x-button>

        <div class="container-fluid">
            Товар: {{ $product->presenter()->name() }}
        </div>
    </nav>
@endsection

@section('content')
    <div class="card m-5 mt-4 w-100">
        <div class="card-body w-100">
            <div class="d-flex flex-column gap-3">
                <span class="d-flex flex-row">Наименование: {{ $product->presenter()->name() }}</span>
                <span class="d-flex flex-row">Цена: {{ $product->presenter()->price() }}</span>
                <span class="d-flex flex-row">Описание: {{ $product->presenter()->description() }}</span>
                <span class="d-flex flex-row">Категория: {{ $product->category->name }}</span>
        </div>
    </div>
@endsection
