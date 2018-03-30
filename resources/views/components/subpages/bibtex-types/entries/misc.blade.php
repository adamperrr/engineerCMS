{{--
For use when nothing else fits.
Required fields: none
Optional fields: author, title, howpublished, month, year, note, key
--}}

@php
    $f = $element;
    $text = $f->getAuthorOrEditor('. ');
    $text .= $f->getElementByAttribute('title', '</i>. ', '<i>');

    $text2 = '';
    $text2 .= $f->getElementByAttribute('howpublished', ', ');
    $text2 .= $f->getDate(', ');
    $text2 .= $f->getKey(', ');
    $text2 .= $f->getElementByAttribute('url', ', ');
    $text2 = ucfirst ($text2);
    $text2 = $f->setDotAtStringEnd($text2);
    $text .= ' ' . $text2;

    $text .= $f->getElementByAttribute('note', '. ', ' ');
@endphp

{!! $text !!}