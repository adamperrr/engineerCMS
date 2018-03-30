<table class="table table-hover bibtex-table">
    @foreach($elementsArr as $ix => $element)
        <tr>
            <td>[{{ $ix + 1 }}]</td>
            <td>
            <!-- [ {{$element->element->entrytype->value}} ] -->
                @switch(strtolower($element->element->entrytype->value))
                    @case('article')
                    @include('components.subpages.bibtex-types.entries.article', ['element' => $element])
                    @break
                    @case('book')
                    @include('components.subpages.bibtex-types.entries.book', ['element' => $element])
                    @break
                    @case('booklet')
                    @include('components.subpages.bibtex-types.entries.booklet', ['element' => $element])
                    @break
                    @case('conference')
                    @include('components.subpages.bibtex-types.entries.conference', ['element' => $element])
                    @break
                    @case('inbook')
                    @include('components.subpages.bibtex-types.entries.inbook', ['element' => $element])
                    @break
                    @case('incollection')
                    @include('components.subpages.bibtex-types.entries.incollection', ['element' => $element])
                    @break
                    @case('manual')
                    @include('components.subpages.bibtex-types.entries.manual', ['element' => $element])
                    @break
                    @case('mastersthesis')
                    @include('components.subpages.bibtex-types.entries.mastersthesis', ['element' => $element])
                    @break
                    @case('phdthesis')
                    @include('components.subpages.bibtex-types.entries.phdthesis', ['element' => $element])
                    @break
                    @case('inproceedings')
                    @include('components.subpages.bibtex-types.entries.conference', ['element' => $element])
                    @break
                    @case('proceedings')
                    @include('components.subpages.bibtex-types.entries.conference', ['element' => $element])
                    @break
                    @case('techreport')
                    @include('components.subpages.bibtex-types.entries.techreport', ['element' => $element])
                    @break
                    @case('unpublished')
                    @include('components.subpages.bibtex-types.entries.unpublished', ['element' => $element])
                    @break
                    @default
                    @include('components.subpages.bibtex-types.entries.misc', ['element' => $element])
                    @break
                @endswitch
            </td>
        </tr>
    @endforeach
</table>
