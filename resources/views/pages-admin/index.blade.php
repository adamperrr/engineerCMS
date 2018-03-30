@extends('layouts.admin')

@section('title', 'Dostępne strony')

@section('content')
    <h1>Strony</h1>
    <table class="table table-hover" id="sortable-pages">

        <tbody class="admin-panel-container-page">
            <tr class="warning">
                <td class="admin-panel-page-add-col" colspan="2"><span class="glyphicon glyphicon-plus"></span><a href="{{ route('pages-admin.create') }}">Dodaj stronę</a></td>
            </tr>
        </tbody>


    @foreach($pages as $page)
        <tbody class="admin-panel-container-page">
            <tr class="info admin-panel-page-row">
                <td class="admin-panel-page-col">
                    @if($page->pageVisibility == 0)
                        <span class="glyphicon glyphicon-lock"></span>
                    @endif
                    <a href="{{ route('pages-admin.show', $page) }}">{{ $page->title }}</a>
                </td>
                <td class="text-right">
                    <a class="btn btn-info" href="{{ route('pages-admin.edit', $page) }}">Edytuj</a>
                    <form method="POST" action="{{ route('pages-admin.destroy', $page) }}" class="admin-panel-delete-form">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button class="btn btn-danger" data-toggle="confirmation">Usuń</button>
                    </form>
                </td>
            </tr>

            <tbody class="admin-panel-container-subpages">
            @foreach($page->getRelation('subpages') as $subpage)
                <tr class="active admin-panel-subpage-row" id="{{ "subpage" . $subpage->id }}" data-pageid="{{ $page->id }}" data-subpageid="{{ $subpage->id }}">
                    <td class="admin-panel-subpage-col"><p><span class="glyphicon glyphicon-sort"></span>{{ $subpage->title }}</p></td>
                    <td class="text-right">
                        <a class="btn btn-info" href="{{ route('subpages-admin.edit', $subpage) }}">Edytuj</a>
                        <form method="POST" action="{{ route('subpages-admin.destroy', $subpage) }}" class="admin-panel-delete-form">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button class="btn btn-danger" data-toggle="confirmation">Usuń</button>
                        </form>
                    </td>
                </tr>
            @endforeach

            </tbody>
                <tr class="active">
                    <td colspan="2" class="admin-panel-subpage-add-col"><a href="{{ route('subpages-admin.create', $page) }}">Dodaj podstronę</a></td>
                </tr>
        </tbody>
    @endforeach

        <tbody class="admin-panel-container-page">
            <tr class="warning">
                <td class="admin-panel-page-add-col" colspan="2"><span class="glyphicon glyphicon-plus"></span><a href="{{ route('pages-admin.create') }}">Dodaj stronę</a></td>
            </tr>
        </tbody>
    </table>

@endsection

@section('scripts')
    <script src="{{ asset('/vendor/bootstrap-confirmation/bootstrap-confirmation.js') }}"></script>
    <script src="{{ asset('/vendor/jQueryUI/jquery-ui.js') }}"></script>
    <script>
        $( function() {
            $("tbody.admin-panel-container-subpages").sortable({
                items: 'tr.admin-panel-subpage-row',
                handle: '.glyphicon-sort',
                axis: 'y',

                update: function (event, ui) {
                    var $subpagesID = [];
                    $(this).children().each(function () {
                        var $subpageId = $(this).data('subpageid');
                        $subpagesID.push($subpageId);
                    });

                    var token = $('meta[name=csrf-token]').attr("content");

                    $.ajax({
                        url: '/admin/subpage/update_order',
                        type: 'POST',
                        data: {_token: token, subpagesID : JSON.stringify($subpagesID)},
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