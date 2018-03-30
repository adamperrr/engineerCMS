@extends('layouts.admin')

@section('title', 'Przechowywane pliki')

@section('content')
    <h1>Przechowywane pliki</h1>

    <table class="table table-hover">

        <thead>
        <tr>
            <th>Nazwa</th>
            <th>Link</th>
            <th>Rozszerzenie</th>
            <th>Rozmiar</th>
            <th></th>
        </tr>
        </thead>

        <tbody>
        <tr class="warning">
            <td class="admin-panel-file-add-col" colspan="5"><span class="glyphicon glyphicon-plus"></span><a href="{{ route('upload-admin.create') }}">Załaduj plik</a></td>
        </tr>
        </tbody>

        <tbody>
            @foreach($files as $file)
            <tr>
                @php
                    $url = env('APP_URL') . $file->url;
                @endphp

                <td><a href="{{ $url }}" target="_blank">{{ $file->name }}</a></td>
                <td><input class="form-control fileUrlInput" type="text" value="{{ $url }}"></td>
                <td>{{ $file->extension }}</td>
                <td>{{ $file->size }} B</td>
                <td class="text-right">
                    <a class="btn btn-info" href="{{ route('upload-admin.edit', $file) }}">Edytuj</a>
                    <form method="POST" action="{{ route('upload-admin.destroy', $file) }}" class="admin-panel-delete-form">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button class="btn btn-danger" data-toggle="confirmation">Usuń</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>

        <tbody>
        <tr class="warning">
            <td class="admin-panel-file-add-col" colspan="5"><span class="glyphicon glyphicon-plus"></span><a href="{{ route('upload-admin.create') }}">Załaduj plik</a></td>
        </tr>
        </tbody>

    </table>

@endsection

@section('scripts')
    <script src="{{ asset('/vendor/bootstrap-confirmation/bootstrap-confirmation.js') }}"></script>
    <script src="{{ asset('/vendor/jQueryUI/jquery-ui.js') }}"></script>
    <script>
        $( function() {
            $('[data-toggle="confirmation"]').confirmation({
                title: "Czy na pewno usunąć?",
                btnOkLabel: "Tak",
                btnCancelLabel: "Nie"
            });

            $('input.fileUrlInput').on("click", function () {
                $(this).select();
            });
        })
    </script>
@endsection