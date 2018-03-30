@extends('layouts.admin')

@section('title', 'Dodawanie strony')

@section('content')
    <h1>Tworzenie strony</h1>
    <form method="POST" action="{{ route('pages-admin.save') }}">
        {{ csrf_field() }}

        @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="btn btn-danger">{{ $error }}</div>
                @endforeach
        @endif

        <div class="form-group">
            <div class="checkbox">
                <label><input type="checkbox" name="pageVisibility" checked="checked">Strona widoczna</label>
            </div>
        </div>

        <div class="form-group">
            <label for="title">Tytuł:</label>
            <input id="title" type="text" name="title" class="form-control" placeholder="Podaj tytuł" required>
        </div>

        <div class="form-group">
            <div class="checkbox">
                <label><input type="checkbox" name="titleVisibility" checked="checked">Tytuł widoczny</label>
            </div>
        </div>

        <div class="form-group">
            <label for="description">Opis:</label>
            <textarea type="text" id="description" name="description" class="form-control" placeholder="Podaj opis"></textarea>
        </div>

        <div class="form-group">
            <div class="checkbox">
                <label><input type="checkbox" name="descVisibility" checked="checked">Opis widoczny</label>
            </div>
        </div>

        <div class="form-group">
            <button class="btn btn-primary">Zapisz</button>
            <a  class="btn btn-danger" href="{{ URL::route('pages-admin.index') }}">Anuluj</a>
        </div>
        
    </form>
@endsection

@section('scripts')
    <script src="{{ asset('/vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('/vendor/unisharp/laravel-ckeditor/adapters/jquery.js') }}"></script>
    <script>
        $('textarea').ckeditor();
    </script>
@endsection