@extends('layouts.app')

@section('title', 'Категории')

@section('page-style')
    <link rel="stylesheet" href="{{ asset(mix('css/pages/categories/category-datatable.css')) }}">
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
    <div class="card m-5 mt-4">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <span>Категории</span>
                <x-button outline sm primary label="Новая категория" data-bs-toggle="modal" data-bs-target="#create-modal"/>
            </div>
            <div class="table-responsive">
                <table class="table no-hover no-header-mobile table-fixed h-100" style="width:100%">
                    <thead>
                    <tr>
                        <th>
                            <div class="value">Название</div>
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
    <div class="modal fade" id="create-modal" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel"
         data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Создать категорию</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="w-100" id="form" method="post" action="">
                    <div class="modal-body">
                        @csrf
                        <x-input id="name" name="name" wrapper-class="w-100" label-top label="Название:" autofocus required/>
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
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Обновить категорию</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="w-100" id="form" method="post" action="">
                    <div class="modal-body">
                        @csrf
                        <x-input type="hidden" id="id" name="id"/>
                        <x-input id="name" name="name" wrapper-class="w-100" class="" label-top label="Название:" autofocus required/>
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
    <script>
        $.fn.dataTable.ext.pager.numbers_length = 5;
        DataTable.type('num', 'detect', () => false);
        DataTable.type('num-fmt', 'detect', () => false);
        DataTable.type('html-num', 'detect', () => false);
        DataTable.type('html-num-fmt', 'detect', () => false);

        var table = $('.table').dataTable({
            "bInfo": false,
            "bFilter": false,
            "bLengthChange": false,
            "language": {
                "sZeroRecords": "Нет результатов"
            },
            pagingType: 'simple_numbers',
            processing: false,
            serverSide: true,
            ajax: {
                async: true,
                url: '{!! route('categories.list') !!}',
                type: "GET",
            },
            autoWidth: false,
            columnDefs: [
                {
                    targets: [0, 1],
                    className: 'not-mobile-l none',
                },
            ],
            columns: [
                {data: 'name', width: '250px'},
                {data: 'edit', width: '250px', className: "text-right", orderable: false},
            ],
            dom: 'rt<"datatables-footer d-flex flex-column flex-sm-row align-items-center gap-10px justify-content-between w-100"pl>',
            order: [],
            responsive: {
                breakpoints: [{
                    name: 'mobile-l',
                    width: 576
                }],
            },
        });

        var updateModal = $('.modal#update-modal');
        var createModal = $('.modal#create-modal');

        createModal.on('shown.bs.modal', function (e) {
            $(e.currentTarget).find('#submit').prop('disabled', false);
            $(this).find('input[autofocus]').focus();
        })

        createModal.on('hidden.bs.modal', function (e) {
            $(e.currentTarget).find('#submit').prop('disabled', true);
        })

        createModal.on('submit', 'form', function (e) {
            e.preventDefault();
            var form = $(this);
            let dangerLabel = $('#danger-label-create');
            var formData = new FormData(form[0]);
            $.ajax({
                type: 'POST',
                url: '{!! route('categories.store') !!}',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: () => {
                    table.api().ajax.reload();
                    createModal.modal('toggle');
                    if(dangerLabel.length > 0){
                        dangerLabel.remove();
                        $('.has-error').removeClass("has-error");
                    }
                    setTimeout(() => {
                        form.trigger('reset');
                    }, 300);
                },
                error: response => {
                    if(dangerLabel.length > 0) {
                        dangerLabel.remove();
                        $('.has-error').removeClass("has-error");
                    }
                    $.each(response.responseJSON.errors, function (key, value) {
                        var input = form.find(`input[name=${key}]`),
                            inputContainer = input.parent().parent(),
                            errorContainer = inputContainer.find('label.text-danger-500');
                        var svg = feather.icons['x'].toSvg({class: 'icon-wrapper', height: 10})
                        if (errorContainer.length) {
                            errorContainer.html(svg + value[0]);
                        } else {
                            inputContainer.append(`<label class="text-danger" id='danger-label-create' for="${input.attr('id')}">${svg} ${value[0]}</label>`);
                        }
                        input.addClass('has-error');
                    });
                },
            });
        });

        updateModal.on('shown.bs.modal', function (e) {
            $(e.currentTarget).find('input[name="id"]').val($(e.relatedTarget).data('id'));
            $(e.currentTarget).find('input[name="name"]').val($(e.relatedTarget).data('name'));
            $(e.currentTarget).find('#submit').prop('disabled', false);
            $(e.currentTarget).find('#delete').prop('disabled', false);
            $(this).find('input[autofocus]').focus();
        })

        updateModal.on('hidden.bs.modal', function (e) {
            $(e.currentTarget).find('#submit').prop('disabled', true);
            $(e.currentTarget).find('#delete').prop('disabled', true);
        })

        updateModal.on('submit', 'form', function (e) {
            e.preventDefault();
            var form = $(this);
            var formData = new FormData(form[0]);
            $.ajax({
                type: 'POST',
                url: '{!! route('categories.update') !!}',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: () => {
                    table.api().ajax.reload();
                    updateModal.modal('toggle');
                    setTimeout(() => {
                        form.trigger('reset');
                    }, 300);
                },
                error: response => {
                    $.each(response.responseJSON.errors, function (key, value) {
                        var input = form.find(`input[name=${key}]`),
                            inputContainer = input.parent().parent(),
                            errorContainer = inputContainer.find('label.text-danger-500');
                        var svg = feather.icons['x'].toSvg({class: 'icon-wrapper'})
                        if (errorContainer.length) {
                            errorContainer.html(svg + value[0]);
                        } else {
                            inputContainer.append(`<label class="text-danger" for="${input.attr('id')}">${svg} ${value[0]}</label>`);
                        }
                        input.addClass('has-error');
                    });
                },
            });
        });

        updateModal.find('#delete').on('click', function () {
            var form = updateModal.find('#form');
            var formData = new FormData(form[0]);
            $.ajax({
                type: 'POST',
                url: '{!! route('categories.delete') !!}',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: () => {
                    table.api().ajax.reload();
                    updateModal.modal('toggle');
                    setTimeout(() => {
                        form.trigger('reset');
                    }, 300);
                },
            });
        });
    </script>
@endsection
