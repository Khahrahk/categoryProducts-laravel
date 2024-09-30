$(function () {
    'use strict';
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
            url: route('categories.list'),
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
            url: route('categories.store'),
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: () => {
                table.api().ajax.reload();
                createModal.modal('toggle');
                if (dangerLabel.length > 0) {
                    dangerLabel.remove();
                    $('.has-error').removeClass("has-error");
                }
                setTimeout(() => {
                    form.trigger('reset');
                }, 300);
            },
            error: response => {
                if (dangerLabel.length > 0) {
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
            url: route('categories.update'),
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
            url: route('categories.delete'),
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
});
