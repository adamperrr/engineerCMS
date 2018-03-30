@extends('layouts.admin')

@section('title', 'Edycja pliku')

@section('content')
    <h1>Edycja pliku</h1>
    <form method="POST" action="{{ route('upload-admin.update', $file) }}">
        {{ method_field('PUT') }}
        {{ csrf_field() }}

        @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="btn btn-danger">{{ $error }}</div>
                @endforeach
        @endif

        <div class="form-group">
            <label for="name">Nazwa:</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Podaj nazwę" value="{{ $file->name }}" required>
        </div>

        <div class="form-group">
            <button class="btn btn-primary">Zapisz</button>
            <a  class="btn btn-danger" href="{{ URL::route('upload-admin.index') }}">Anuluj</a>
        </div>
        
    </form>
@endsection

@section('scripts')
@endsection