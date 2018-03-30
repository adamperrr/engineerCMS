@extends('layouts.admin')

@section('title', $page->title)

@section('content')
    <h1><b>Podgląd strony:</b></h1>
    <div class='container main-container'>

    @if($page->titleVisibility)
    <h1>{{ $page->title }}</h1>
    @endif

    @if($page->descVisibility and $page->description!="")
    <div class="page-description">{!! $page->description !!}</div>
    @endif

        @foreach($subpages as $subpage)
        <div id="subpage{{$subpage->id}}">
            @if($subpage->titleVisibility)
            <h2>{{ $subpage->title }}</h2>
            @endif


            @if($subpage->descVisibility and $subpage->description!="")
            <div class="subpage-description">{!! $subpage->description !!}</div>
            @endif

                <small>Edytowano:{{ $subpage->updated_at }}</small><br>

            @switch($subpage->type)
            @case('bibtex')
                @include('components.subpages.bibtex', ['subpage' => $subpage])
            @break
            @case('menu')
                @include('components.subpages.menu', ['subpage' => $subpage])
            @break
            @case('contact')
                @include('components.subpages.contact', ['subpage' => $subpage])
            @break
            @default
                @include('components.subpages.text', ['subpage' => $subpage])
            @endswitch
        </div>
        @endforeach
    </div>
@endsection