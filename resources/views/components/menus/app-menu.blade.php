<div class="collapse navbar-collapse" id="navbarResponsive">
    <ul class="navbar-nav ml-auto">
        @foreach($MyNavBar->roots() as $item)
            <li class="nav-item">
                <a class="nav-link" href="{{ $item->url() }}">{{ $item->title }}</a>
            </li>
        @endforeach

        @auth
            @include('components.menus.authorized-menu')
        @endauth
    </ul>
</div>