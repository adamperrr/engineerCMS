{{--
Required fields: author, title, institution, year
Optional fields: type, number, address, month, note, key
--}}

@php
    $f = $element;
    $text = $f->getAuthorOrEditor('. ');
    $text .= $f->getElementByAttribute('title', '</i>. ', '<i>');

    $text2 = '';
    $text2 .= $f->getKey(', ');
    $text2 .= $f->getElementByAttribute('note', ', ');
    $text2 .= $f->getDate('. ');
    $text2 = ucfirst ($text2);
    $text2 = $f->setDotAtStringEnd($text2);
    $text .= ' ' . $text2;
@endphp

{!! $text !!}