<li><a href="{{ route('login') }}">Logowanie</a></li>
@if($websiteSettings['registrationOpen']['value'] == 1)
<li><a href="{{ route('register') }}">Rejestracja</a></li>
@endif