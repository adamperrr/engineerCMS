@extends('layouts.admin')

@section('title', 'Dodawanie pliku')

@section('content')
    <h1>Dodawanie pliku</h1>
    <form method="POST" action="{{ route('upload-admin.store-file') }}" enctype="multipart/form-data">
        {{ csrf_field() }}

        @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="btn btn-danger">{{ $error }}</div>
                @endforeach
        @endif

        <div class="form-group">
            <label for="file">Plik:</label>
            <input type="file" id="file" name="file" class="form-control-file" required>
        </div>

        <div class="form-group">
            <label for="name">Nazwa:</label>
            <input id="name" type="text" name="name" class="form-control" placeholder="Podaj nazwę" required>
        </div>

        <div class="form-group">
            <button class="btn btn-primary">Zapisz</button>
            <a  class="btn btn-danger" href="{{ URL::route('upload-admin.index') }}">Anuluj</a>
        </div>
        
    </form>
@endsection

@section('scripts')
@endsection