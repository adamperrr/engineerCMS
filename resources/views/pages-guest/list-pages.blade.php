@extends('layouts.app')

@section('title', 'Lista dostępnych stron')

@section('content')
    <h1>Lista dostępnych stron</h1>

    <table class="table table-hover">
    @foreach($pages as $page)
    <tr>
        <td class="w-25">
            @if($page->pageVisibility == 0)
                <div class="guest-lock" alt="Strona niewidoczna">&#128273;&nbsp;</div>
            @endif
            <a href="{{ route('pages-guest.show', $page) }}">{{ $page->title }}</a>
        </td>
        <td class="w-75">
            {!! $page->description !!}
        </td>
    </tr>
    @endforeach
    </table>
@endsection