{{--
Required fields: author/editor, title, publisher, year
Optional fields: volume/number, series, address, edition, month, note, key, url
--}}

@php
    $f = $element;
    $text = $f->getAuthorOrEditor('. ');

    $text2 = '';
    $text2 .= $f->getElementByAttribute('title', '</i>, ', '<i>');
    $text2 .= $f->getEditorIfWasntUsedBefore(', ');

    $series = '';
    if($f->fieldExists('volume')) {
        if($f->fieldExists('series')) {
            $series = $f->getElementByAttribute('series', '', '&nbsp;of&nbsp;');
        }

        $text2 .= $f->getElementByAttribute('volume', $series . '. ', 'volume&nbsp;');
    } elseif($f->fieldExists('number')) {
        if($f->fieldExists('series')) {
            $series = $f->getElementByAttribute('series', '', '&nbsp;in&nbsp;');
        }

        $text2 .= $f->getElementByAttribute('number', $series . '. ', 'number&nbsp;');
    }

    $text2 = ucfirst ($text2);
    $text2 = $f->setDotAtStringEnd($text2);
    $text .= ' ' . $text2;

    $text3 = '';
    $text3 .= $f->getElementByAttribute('publisher', ', ');
    $text3 .= $f->getElementByAttribute('address', ', ');
    $text3 .= $f->getElementByAttribute('edition', '&nbsp;edition, ', '');
    $text3 .= $f->getDate(', ');
    $text3 .= $f->getElementByAttribute('pages', ', ', 'pages&nbsp;');
    $text3 .= $f->getKey(', ');
    $text3 .= $f->getElementByAttribute('url', ', ');

    $text3 = ucfirst ($text3);
    $text3 = $f->setDotAtStringEnd($text3);
    $text .= ' ' . $text3;

    $text .= $f->getElementByAttribute('note', '. ', ' ');
@endphp

{!! $text !!}