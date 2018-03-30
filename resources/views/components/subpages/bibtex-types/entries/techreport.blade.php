{{--
Required fields: author, title, institution, year
Optional fields: type, number, address, month, note, key
--}}

@php
    $f = $element;
    $text = $f->getAuthorOrEditor('. ');
    $text .= $f->getElementByAttribute('title', '</i>. ', '<i>');

    $text2 = '';
    $text2 .= $f->getType('', ', ', '');
    $text2 .= $f->getElementByAttribute('number', '. ', 'number&nbsp;');
    $text2 .= $f->getElementByAttribute('institution', ', ');
    $text2 .= $f->getElementByAttribute('address', ', ');
    $text2 .= $f->getDate(', ');
    $text2 .= $f->getKey(', ');
    $text2 .= $f->getElementByAttribute('url', ', ');
    $text2 = ucfirst ($text2);
    $text2 = $f->setDotAtStringEnd($text2);
    $text .= ' ' . $text2;

    $text .= $f->getElementByAttribute('note', '. ', ' ');
@endphp

{!! $text !!}