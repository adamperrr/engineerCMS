@extends('layouts.admin')

@section('title', 'Dodawanie podstrony')

@section('content')
    <h1>Dodawanie podstrony</h1>
    <form method="POST" action="{{ route('subpages-admin.store', $page) }}">
        {{ csrf_field() }}

        @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="btn btn-danger">{{ $error }}</div>
                @endforeach
        @endif

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

        <hr>

        <div v-if="false" class="alert alert-danger">Do poprawnego działania strony wymagana jest włączona obsługa języka JavaScript w przeglądarce.</div>

        <create_subpage_types page_id="{{ $page }}" settings_str="{{ json_encode($websiteSettings) }}"></create_subpage_types>

        <div class="form-group">
            <button class="btn btn-primary">Zapisz</button>
            <a class="btn btn-danger" href="{{ URL::route('pages-admin.index') }}">Anuluj</a>
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