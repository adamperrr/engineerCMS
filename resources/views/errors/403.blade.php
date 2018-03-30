@extends('layouts.app-no-header')

@section('title', 'Błąd')

@section('content')
    <div class="error-status">
        <h1>Błąd 403</h1>
        <h2>Brak uprawnień dostępu do strony</h2>
        <h3>Zaloguj się, aby zobaczyć tę stronę</h3>
    </div>
@endsection