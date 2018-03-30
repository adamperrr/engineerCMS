@extends('layouts.app')

@section('title', 'Potwierdzenie rejestracji')

@section('content')
<h1>Rejestracja potwierdzona</h1>
<p>Twój email został zweryfikowany.</p>
<p>Teraz możesz się <a href="{{url('/login')}}">zalogować</a></p>

@endsection