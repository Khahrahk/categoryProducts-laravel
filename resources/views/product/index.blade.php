@extends('layouts.app')

@section('title', 'Products')

@section('page-style')
    <link rel="stylesheet" href="{{ asset(mix('css/pages/products/product-datatable.css')) }}">
@endsection

@section('header')
    <nav class="navbar navbar-page navbar-expand-lg bg-white d-flex flex-row w-100 ps-3 pb-1"
         style="margin: 0; box-shadow: none; border-bottom:  1px solid rgba(0, 0, 0, 0.1); height: 45px">
        <x-button class="toggle-right close" size="sm" monochrome outline
                  iconRight="burger-menu-svgrepo-com"></x-button>

        <div class="container-fluid">

        </div>
    </nav>
@endsection

@section('content')
    <div class="d-flex flex-column h-100">
        <div class="card m-5 mt-4 mb-3">
            <div class="card-body">
                <span>Фильтры</span>
                <form class="as-wrapper pt-4" name="filtering">
                    <div class="d-flex col-sm-5 w-sm-340px pb-2 gap-4">
                        <x-input name="name" id="name" label="Наименование:" label-top placeholder="Поиск"/>
                        <x-input name="priceFrom" id="priceFrom" label="Цена от:" label-top placeholder="Поиск"/>
                        <x-input name="priceTo" id="priceTo" label="Цена до:" label-top placeholder="Поиск"/>
                    </div>
                    <x-button sm primary label="Применить фильтры" name="apply" type="submit" disabled/>
                </form>
            </div>
        </div>
        <div class="card m-5 mt-0 p-1 h-100 mb-5">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <span>Товары</span>
                    <x-button outline sm primary label="Новый товар" data-bs-toggle="modal" data-bs-target="#create-modal"/>
                </div>
                <div class="table-responsive">
                    <table class="table no-hover no-header-mobile table-fixed h-100" style="width:100%">
                        <thead>
                        <tr>
                            <th>
                                <div class="value">Название</div>
                            </th>
                            <th>
                                <div class="value">Описание</div>
                            </th>
                            <th>
                                <div class="value">Цена</div>
                            </th>
                            <th>
                                <div class="value">Категория</div>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="create-modal" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel"
         data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Создать товар</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="w-100" id="form" method="post" action="">
                    <div class="modal-body">
                        @csrf
                        <x-input id="name" name="name" label-top label="Название:" autofocus required/>
                        <x-input id="description" name="description" label-top label="Описание:"/>
                        <x-input id="price" name="price" type="number" label-top label="Цена:" required/>
                        <label>Категория</label>
                        <select id="categoryId" name="categoryId" class="form-select mt-1" aria-label="Категория" required>
                            <option selected>Открыть</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->presenter()->name}}</option>
                            @endforeach
                        </select>
                        <div class="modal-footer p-0 mt-2" style="border-top: none">
                            <div class="d-flex justify-content-end gap-2">
                                <x-button outline monochrome data-bs-dismiss="modal" label="Cancel"/>
                                <x-button primary id="submit" type="submit" label="Create"/>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="update-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Обновить товар</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="w-100" id="form" method="post" action="">
                    <div class="modal-body">
                        @csrf
                        <x-input type="hidden" id="id" name="id"/>
                        <x-input id="name" name="name" wrapper-class="w-100" class="" label-top label="Name:" autofocus required/>
                        <x-input id="description" name="description" label-top label="Описание:" />
                        <x-input id="price" name="price" type="number" label-top label="Цена:" required/>
                        <label>Категория</label>
                        <select id="categoryId" name="categoryId" class="form-select mt-1" aria-label="Категория" required>
                            <option selected>Открыть</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->presenter()->name}}</option>
                            @endforeach
                        </select>
                        <div class="modal-footer p-0 mt-2" style="border-top: none">
                            <div class="d-flex w-100 justify-content-between">
                                <x-button danger disabled id="delete" label="Delete"/>
                                <div class="d-flex justify-content-end gap-2">
                                    <x-button outline monochrome data-bs-dismiss="modal" label="Cancel"/>
                                    <x-button primary disabled id="submit" type="submit" label="Update"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('page-script')
    <script src="{{ asset(mix('js/pages/products/product-datatable.js')) }}"></script>
@endsection
