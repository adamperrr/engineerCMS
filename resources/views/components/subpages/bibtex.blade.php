@php
    $translateArray = [
        'article' => 'Artykuł',
        'book' => 'Książka',
        'booklet' => 'Książka bez wydawcy',
        'conference' => 'Materiały konferencyjne',
        'inbook' => 'Część książki (rozdział lub strony)',
        'incollection' => 'Część książki z własnym tytułem',
        'manual' => 'Dokumentacja techniczna',
        'mastersthesis' => 'Praca magisterska',
        'misc' => 'Inne publikacje',
        'phdthesis' => 'Rozprawa doktorska',
        'inproceedings' => 'Materiały konferencyjne',
        'proceedings' => 'Materiały konferencyjne',
        'techreport' => 'Raport techniczny',
        'unpublished' => 'Materiały niepublikowane',

        'type' => 'Typ',
        'author' => 'Autor',
        'editor' => 'Edytor',
        'title' => 'Tytuł',
        'month' => 'Miesiąc',
        'year' => 'Rok',
        'citation-key' => 'Klucz do cytowania',
        'journal' => 'Czasopismo',
        'volume' => 'Tom',
        'pages' => 'Strony',
        'howpublished' => 'Sposób publikacji',
        'url' => 'Adres URL',
        'key' => 'Klucz',
        'number' => 'Numer',
        'booktitle' => 'Tytuł ksiązki',
        'address' => 'Adres',
        'publisher' => 'Wydawnictwo',
        'note' => 'Notatka'
    ];

    $subpageContent = json_decode($subpage->content);

    $elementsArr = [];
    foreach ($subpageContent->json as $key => $item) {
        $elementsArr[] = new BibtexTypeFormatter($item);
    }
@endphp

@switch($subpageContent->style)
    @case('unsrt')
        @include('components.subpages.bibtex-types.unsrt', ['elementsArr' => $elementsArr])
    @break
    @case('abbrv')
        @php
            foreach ($elementsArr as $key => $item) {
                $item->setShort();
            }
            usort($elementsArr, "compareElements");
        @endphp
        @include('components.subpages.bibtex-types.abbrv', ['elementsArr' => $elementsArr])
    @break
    @default
        @php usort($elementsArr, "compareElements"); @endphp
        @include('components.subpages.bibtex-types.plain', ['elementsArr' => $elementsArr])
    @break
@endswitch

