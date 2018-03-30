@extends('layouts.admin')

@section('title', 'Edycja użytkownika')

@section('content')
    <h1>Edycja użytkownika</h1>
    <form method="POST" action="{{ route('users-admin.update', $user) }}">
        {{ method_field('PUT') }}
        {{ csrf_field() }}

        @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="btn btn-danger">{{ $error }}</div>
                @endforeach
        @endif

        <div class="form-group">
            <label for="name">Imię:</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Podaj imię" value="{{ $user->name }}">
        </div>

        <div class="form-group">
            <label for="email">E-mail:</label>
            <input id="email" type="text" name="email" class="form-control" placeholder="Podaj link" value="{{ $user->email }}">
        </div>

        <div class="form-group">
            <label for="role">Rola użytkownika:</label>
            <select class="form-control" id="role" name="role">
                @foreach($roles as $role)
                <option value="{{ $role->id }}" {{ $user->roles[0]->id==$role->id?'selected':'' }} >{{ $role->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <button class="btn btn-primary">Zapisz</button>
            <a class="btn btn-danger" href="{{ URL::route('users-admin.index') }}">Anuluj</a>
        </div>
        
    </form>
@endsection

@section('scripts')
@endsection