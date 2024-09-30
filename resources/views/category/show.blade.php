@extends('layouts.app')

@section('title', 'Category')

@section('page-style')
    <link rel="stylesheet" href="{{ asset(mix('css/pages/categories/category-datatable.css')) }}">
@endsection

@section('header')
    <nav class="navbar navbar-page navbar-expand-lg bg-white d-flex flex-row w-100 ps-3 pb-1"
         style="margin: 0; box-shadow: none; border-bottom:  1px solid rgba(0, 0, 0, 0.1); height: 45px">
        <x-button class="toggle-right close" size="sm" monochrome outline
                  iconRight="burger-menu-svgrepo-com"></x-button>

        <div class="container-fluid">
            Категория: {{ $category->presenter()->name() }}
        </div>
    </nav>
@endsection

@section('content')
    <div class="card m-5 mt-4">
        <div class="card-body">
            <span>Товары</span>
            <div class="table-responsive pt-2">
                <table class="table no-hover no-header-mobile table-fixed" style="width:100%">
                    <thead>
                    <tr>
                        <th>
                            <div class="value">Наименование</div>
                        </th>
                        <th>
                            <div class="value">Описание</div>
                        </th>
                        <th>
                            <div class="value">Цена</div>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($category->products as $product)
                        <tr>
                            <th>
                                <div class="value"><a href="{{ route('products.show', ['id' => $product->id]) }}">{{ $product->name }}</a></div>
                            </th>
                            <th>
                                <div class="value">{{ $product->description }}</div>
                            </th>
                            <th>
                                <div class="value">{{ $product->price }}</div>
                            </th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
