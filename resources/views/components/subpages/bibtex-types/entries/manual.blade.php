{{--
Required fields: title
Optional fields: author, organization, address, edition, month, year, note, key
--}}

@php
    $f = $element;
    $text = $f->getAuthorOrEditor('. ');
    $text .= $f->getElementByAttribute('title', '</i>. ', '<i>');

    $text2 = '';
    $text2 .= $f->getEditorIfWasntUsedBefore(', ');
    $text2 .= $f->getElementByAttribute('organization', ', ');
    $text2 .= $f->getElementByAttribute('address', ', ');
    $text2 .= $f->getElementByAttribute('edition', '&nbsp;edition, ', ' ');
    $text2 .= $f->getDate(', ');
    $text2 .= $f->getElementByAttribute('pages', ', ', 'pages&nbsp;');
    $text2 .= $f->getKey(', ');
    $text2 .= $f->getElementByAttribute('url', ', ');
    $text2 = ucfirst ($text2);
    $text2 = $f->setDotAtStringEnd($text2);
    $text .= ' ' . $text2;

    $text .= $f->getElementByAttribute('note', '. ', ' ');
@endphp

{!! $text !!}