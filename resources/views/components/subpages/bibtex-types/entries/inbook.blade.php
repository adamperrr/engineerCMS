{{--
Required fields: author/editor, title, chapter/pages, publisher, year
Optional fields: volume/number, series, type, address, edition, month, note, key
--}}

@php
    $f = $element;
    $text = $f->getAuthorOrEditor('. ');

    $text2 = '';
    $text2 .= $f->getElementByAttribute('title', '</i>, ', '<i>');
    $text2 .= $f->getEditorIfWasntUsedBefore(', ');
    $text2 = ucfirst ($text2);
    $text2 = $f->setDotAtStringEnd($text2);
    $text .= ' ' . $text2;

    $text3 = '';
    $series = '';
    if($f->fieldExists('volume')) {
        if($f->fieldExists('series')) {
            $series = $f->getElementByAttribute('series', '', '&nbsp;of&nbsp;');
        }

        $text3 .= $f->getElementByAttribute('volume', $series . ', ', 'volume&nbsp;');

    } elseif($f->fieldExists('number')) {
        if($f->fieldExists('series')) {
            $series = $f->getElementByAttribute('series', '', '&nbsp;in&nbsp;');
        }

        $text3 .= $f->getElementByAttribute('number', $series . ', ', 'number&nbsp;');
    }

    $text3 .= $f->getType('', ', ', '');
    $text3 .= $f->getElementByAttribute('chapter', ', ', 'chapters&nbsp;');
    $text3 .= $f->getElementByAttribute('pages', ', ', 'pages&nbsp;');
    $text3 = ucfirst ($text3);
    $text3 = $f->setDotAtStringEnd($text3);
    $text .= ' ' . $text3;

    $text4 = '';
    $text4 .= $f->getElementByAttribute('publisher', ', ');
    $text4 .= $f->getElementByAttribute('address', ', ');
    $text4 .= $f->getElementByAttribute('edition', '&nbsp;edition, ', ' ');
    $text4 .= $f->getDate(', ');
    $text4 .= $f->getKey(', ');
    $text4 .= $f->getElementByAttribute('url', ', ');
    $text4 = ucfirst ($text4);
    $text4 = $f->setDotAtStringEnd($text4);
    $text .= ' ' . $text4;

    $text .= $f->getElementByAttribute('note', '. ', ' ');
@endphp

{!! $text !!}