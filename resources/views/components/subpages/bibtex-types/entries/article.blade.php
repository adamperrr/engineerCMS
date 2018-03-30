{{--
Required fields: author, title, journal, year, volume
Optional fields: number, pages, month, note, key
--}}

@php
    $f = $element;
    $text = $f->getAuthorOrEditor('. ');
    $text .= $f->getElementByAttribute('title', '. ');

    $text2 = '';
    $text2 .= $f->getElementByAttribute('journal', '</i>, ', '<i>');
    $text2 .= $f->getElementByAttribute('volume', '', '');
    $text2 .= $f->getElementByAttribute('number', ')', '(');
    $text2 .= $f->getElementByAttribute('pages', ', ', ':');
    $text2 .= $f->getDate(', ');
    $text2 .= $f->getKey(', ');
    $text2 .= $f->getElementByAttribute('url', ', ');
    $text2 = ucfirst ($text2);
    $text2 = $f->setDotAtStringEnd($text2);
    $text .= ' ' . $text2;

    $text .= $f->getElementByAttribute('note', '. ', ' ');
@endphp

{!! $text !!}