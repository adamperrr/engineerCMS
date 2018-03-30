@extends('layouts.admin')

@section('title', 'Edycja linku')

@section('content')
    <h1>Edycja linku</h1>
    <form method="POST" action="{{ route('menu-admin.update', $menuLink) }}">
        {{ method_field('PUT') }}
        {{ csrf_field() }}

        @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="btn btn-danger">{{ $error }}</div>
                @endforeach
        @endif

        <div class="form-group">
            <label for="name">Nazwa:</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Podaj nazwę" value="{{ $menuLink->name }}" required>
        </div>

        <div class="form-group">
            <label for="link">URL:</label>
            <input id="link" type="text" name="link" class="form-control" placeholder="Podaj link" value="{{ $menuLink->link }}" required>
        </div>

        <div class="form-group">
            <button class="btn btn-primary">Zapisz</button>
            <a class="btn btn-danger" href="{{ URL::route('menu-admin.index') }}">Anuluj</a>
        </div>
        
    </form>
@endsection

@section('scripts')
@endsection