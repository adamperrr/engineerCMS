{{--
Required fields: author, title, booktitle, publisher, year
Optional fields: editor, volume/number, series, type, chapter, pages, address, edition, month, note, key
--}}

@php
    $f = $element;
    $text = $f->getAuthorOrEditor('. ');
    $text .= $f->getElementByAttribute('title', '</i>. ', '<i>');

    $text2 = '';
    $text2 .= $f->getEditorIfWasntUsedBefore(', ');
    $text2 .= $f->getElementByAttribute('booktitle', '</i>, ', '<i>');

    $series = '';
    if($f->fieldExists('volume')) {
        if($f->fieldExists('series')) {
            $series = $f->getElementByAttribute('series', '', '&nbsp;of&nbsp;');
        }

        $text2 .= $f->getElementByAttribute('volume', $series . ', ', 'volume&nbsp;');

    } elseif($f->fieldExists('number')) {
        if($f->fieldExists('series')) {
            $series = $f->getElementByAttribute('series', '', '&nbsp;in&nbsp;');
        }

        $text2 .= $f->getElementByAttribute('number', $series . ', ', 'number&nbsp;');
    }

    $text2 .= $f->getType('', ', ', '');
    $text2 .= $f->getElementByAttribute('chapter', ', ', 'chapters&nbsp;');
    $text2 .= $f->getElementByAttribute('pages', ', ', 'pages&nbsp;');
    $text2 = ucfirst ($text2);
    $text2 = $f->setDotAtStringEnd($text2);
    $text .= ' ' . $text2;

    $text3 = '';
    $text3 .= $f->getElementByAttribute('publisher', ', ');
    $text3 .= $f->getElementByAttribute('address', ', ');
    $text3 .= $f->getElementByAttribute('edition', '&nbsp;edition, ', ' ');
    $text3 .= $f->getDate(', ');
    $text3 .= $f->getKey(', ');
    $text3 .= $f->getElementByAttribute('url', ', ');
    $text3 = ucfirst ($text3);
    $text3 = $f->setDotAtStringEnd($text3);
    $text .= ' ' . $text3;

    $text .= $f->getElementByAttribute('note', '. ', ' ');
@endphp

{!! $text !!}