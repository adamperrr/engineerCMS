@extends('layouts.admin')

@section('title', 'Ustawienia użytkownika')

@section('content')
    <h1>Ustawienia użytkownika</h1>
    <form method="POST" action="{{ route('user-settings-admin.change-name') }}">
        {{ method_field('PUT') }}
        {{ csrf_field() }}

        @if ($errors->name->any())
            @foreach ($errors->name->all() as $error)
                <div class="btn btn-danger">{{ $error }}</div>
            @endforeach
        @endif

        @if(session()->has('messageName'))
            <div class="alert alert-success">
                {{ session()->get('messageName') }}
            </div>
        @endif

        <div class="form-group">
            <label for="email">E-mail:</label>
            <input type="text" id="email" name="email" class="form-control" value="{{ $user->email }}" readonly>
        </div>

        <div class="form-group">
            <label for="name">Imię:</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}" required>
        </div>

        <div class="form-group">
            <button class="btn btn-primary">Zmień</button>
        </div>

        </form>
        <form method="POST" action="{{ route('user-settings-admin.change-password') }}">
            {{ method_field('PUT') }}
            {{ csrf_field() }}

        @if ($errors->password->any())
            @foreach ($errors->password->all() as $error)
                <div class="btn btn-danger">{{ $error }}</div>
            @endforeach
        @endif

        @if(session()->has('messagePassword'))
            <div class="alert alert-success">
                {{ session()->get('messagePassword') }}
            </div>
        @endif

        <h2>Zmiana hasła</h2>
        <div class="form-group">
            <label for="old_password">Stare hasło:</label>
            <input type="password" id="old_password" name="old_password" class="form-control" placeholder="Podaj stare hasło" required>
        </div>
        <div class="form-group">
            <label for="new_password">Nowe hasło:</label>
            <input type="password" id="new_password" name="new_password" class="form-control" placeholder="Podaj nowe hasło" required>
        </div>
        <div class="form-group">
            <label for="password_confirm">Potwierdzenie nowego hasła:</label>
            <input type="password" id="password_confirm" name="password_confirm" class="form-control" placeholder="Potwierdź nowe hasło" required>
        </div>
        <div class="form-group">
            <button class="btn btn-primary">Zmień hasło</button>
        </div>
    </form>
@endsection