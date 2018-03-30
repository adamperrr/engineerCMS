@extends('layouts.admin')

@section('title', 'Edycja menu')

@section('content')
    <h1>Edycja menu</h1>

    <table class="table table-hover admin-panel-menu-table">
        <thead>
            <tr>
                <th>Nazwa</th>
                <th>Link</th>
                <th></th>
            </tr>
        </thead>

        <tr class="warning">
            <td class="admin-panel-menu-add" colspan="3">
                <span class="glyphicon glyphicon-plus"></span>
                <a href="{{ route('menu-admin.create') }}">Dodaj link</a>
            </td>
        </tr>

        <tbody class="admin-panel-menu-main-tbody">
        @foreach($menuLinks as $link)
        <tr class="admin-panel-menu-link-row" data-menulinkid="{{ $link->id }}">
            <td>
                <span class="glyphicon glyphicon-sort"></span>
                {{ $link->name }}
            </td>
            <td>
                {{ $link->link }}
            </td>

            <td class="text-right">
                <a class="btn btn-info" href="{{ route('menu-admin.edit', $link) }}">Edytuj</a>
                <form method="POST" action="{{ route('menu-admin.destroy', $link) }}" class="admin-panel-delete-form">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button class="btn btn-danger" data-toggle="confirmation">Usuń</button>
                </form>

            </td>
        </tr>
        @endforeach
        </tbody>
        <tr class="warning">
            <td class="admin-panel-menu-add" colspan="3">
                <span class="glyphicon glyphicon-plus"></span>
                <a href="{{ route('menu-admin.create') }}">Dodaj link</a>
            </td>
        </tr>
    </table>

@endsection

@section('scripts')
    <script src="{{ asset('/vendor/bootstrap-confirmation/bootstrap-confirmation.js') }}"></script>
    <script src="{{ asset('/vendor/jQueryUI/jquery-ui.js') }}"></script>
    <script>
        $( function() {
            $(".admin-panel-menu-main-tbody").sortable({
                items: 'tr.admin-panel-menu-link-row',
                handle: '.glyphicon-sort',
                axis: 'y',

                update: function (event, ui) {
                    var $menulinksID = [];
                    $(this).children().each(function () {
                        var $menulinkId = $(this).data('menulinkid');
                        $menulinksID.push($menulinkId);
                    });

                    var token = $('meta[name=csrf-token]').attr("content");

                    $.ajax({
                        url: '/admin/menu/update_order',
                        type: 'POST',
                        data: {_token: token, menulinksID : JSON.stringify($menulinksID)},
                        dataType: 'JSON',
                        success: function (data) {
                            console.log(data.msg);
                        }
                    });
                },
            });

            $('[data-toggle="confirmation"]').confirmation({
                title: "Czy na pewno usunąć?",
                btnOkLabel: "Tak",
                btnCancelLabel: "Nie"
            });
        })
    </script>
@endsection