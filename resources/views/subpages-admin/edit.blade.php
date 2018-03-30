@extends('layouts.admin')

@section('title', 'Edycja podstrony')

@section('content')
    <h1>Edycja podstrony</h1>
    <form method="POST" action="{{ route('subpages-admin.update', $subpage) }}">
        {{ method_field('PUT') }}
        {{ csrf_field() }}

        @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="btn btn-danger">{{ $error }}</div>
                @endforeach
        @endif

        <div class="form-group">
            <label for="title">Tytuł:</label>
            <input id="title" type="text" name="title" class="form-control" placeholder="Podaj tytuł" value="{{ $subpage->title }}" required>
        </div>

        <div class="form-group">
            <div class="checkbox">
                <label><input type="checkbox" name="titleVisibility" {{ $subpage->titleVisibility==1 ? 'checked': '' }} >Tytuł widoczny</label>
            </div>
        </div>

        <div class="form-group">
            <label for="description">Opis:</label>
            <textarea type="text" id="description" name="description" class="form-control" placeholder="Podaj opis">{{ $subpage->description }}</textarea>
        </div>

        <div class="form-group">
            <div class="checkbox">
                <label><input type="checkbox" name="descVisibility" {{ $subpage->descVisibility==1 ? 'checked': '' }} >Opis widoczny</label>
            </div>
        </div>


        <div class="form-group">
          <label for="type">Typ podstrony:</label>
            <input class="form-control" id="type" name="type" required="required" readonly="readonly" value="{{ $subpage->type }}">
        </div>

        <!--
        <div class="form-group">
            <label for="content">Zawartość:</label>
            <textarea type="text" id="content" name="content" class="form-control" placeholder="Podaj zawartość">{{ $subpage->content }}</textarea>
        </div>
        -->
        <edit_subpage_types subpage_str="{{ $subpage }}" settings_str="{{ json_encode($websiteSettings) }}"></edit_subpage_types>


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