@extends('layouts.admin')

@section('title', 'Edycja strony')

@section('content')
    <h1>Edycja strony</h1>
    <form method="POST" action="{{ route('pages-admin.update', $page) }}">
        {{ method_field('PUT') }}
        {{ csrf_field() }}

        @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="btn btn-danger">{{ $error }}</div>
                @endforeach
        @endif

        <div class="form-group">
            <div class="checkbox">
                <label><input type="checkbox" name="pageVisibility" {{ $page->pageVisibility==1 ? 'checked': '' }} >Strona widoczna</label>
            </div>
        </div>

        <div class="form-group">
            <label for="title">Tytuł:</label>
            <input id="title" type="text" name="title" class="form-control" placeholder="Podaj tytuł" value="{{ $page->title }}" required>
        </div>

        <div class="form-group">
            <div class="checkbox">
                <label><input type="checkbox" name="titleVisibility" {{ $page->titleVisibility==1 ? 'checked': '' }} >Tytuł widoczny</label>
            </div>
        </div>

        <div class="form-group">
            <label for="description">Opis:</label>
            <textarea type="text" id="description" name="description" class="form-control" placeholder="Podaj opis">{{ $page->description }}</textarea>
        </div>

        <div class="form-group">
            <div class="checkbox">
                <label><input type="checkbox" name="descVisibility" checked="checked" {{ $page->descVisibility==1 ? 'checked': '' }} >Opis widoczny</label>
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