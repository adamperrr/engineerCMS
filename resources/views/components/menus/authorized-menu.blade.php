<li class="nav-item">
    <a class="nav-link">
        |
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('pages-guest.index') }}">
        Strona główna
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('pages-admin.index') }}">
        Panel administracyjny
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        Wyloguj
    </a>
</li>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>
