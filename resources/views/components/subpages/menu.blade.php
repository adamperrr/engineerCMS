<nav class="subpage-menu">
    <ul>
        <!--li data-title="Menu"><strong>Menu </strong></li-->
        @foreach(json_decode($subpage->content) as $link)
            <li><a href="{{ $link->url }}">{{ $link->name }}</a></li>
        @endforeach
    </ul>
</nav>

