exports.showDifferenceTypes = (element) =>
{
    let allFieldsAttribute = {
        article : ['entrytype', 'citation-key', 'author', 'title', 'journal', 'year', 'volume', 'number', 'pages', 'month', 'note', 'key', 'issn', 'url', 'doi'],
        book : ['entrytype', 'citation-key', 'author', 'editor', 'title', 'publisher', 'year', 'volume', 'number', 'series',
            'address', 'edition', 'month', 'note', 'isbn', 'url', 'key'],
        booklet : ['entrytype', 'citation-key', 'title', 'author', 'howpublished', 'address', 'month', 'year', 'note', 'key', 'url', 'doi'],
        conference : ['entrytype', 'citation-key', 'author', 'title', 'booktitle', 'year', 'editor', 'volume', 'number', 'series', 'pages',
            'address', 'month', 'organization', 'publisher', 'note', 'key', 'url', 'doi'],
        inbook : ['entrytype', 'citation-key', 'author', 'editor', 'title', 'chapter', 'pages', 'publisher', 'year', 'volume', 'number', 'series',
            'type', 'address', 'edition', 'month', 'note', 'key', 'isbn', 'url', 'doi'],
        incollection : ['entrytype', 'citation-key', 'author', 'title', 'booktitle', 'publisher', 'year', 'editor', 'volume', 'number', 'series',
            'type', 'chapter', 'pages', 'address', 'edition', 'month', 'note', 'key', 'isbn', 'url', 'doi'],
        inproceedings : ['entrytype', 'citation-key', 'author', 'title', 'booktitle', 'year', 'editor', 'volume', 'number', 'series', 'pages',
            'address', 'month', 'organization', 'publisher', 'note', 'key', 'url', 'doi'],
        manual : ['entrytype', 'citation-key', 'title', 'author', 'organization', 'address', 'edition', 'month', 'year', 'note', 'key', 'isbn', 'url', 'doi'],
        mastersthesis : ['entrytype', 'citation-key', 'author', 'title', 'school', 'year', 'type', 'address', 'month', 'note', 'key', 'url', 'doi'],
        misc : ['entrytype', 'citation-key', 'author', 'title', 'howpublished', 'month', 'year', 'note', 'key', 'isbn', 'issn', 'url', 'doi'],
        phdthesis : ['entrytype', 'citation-key', 'author', 'title', 'school', 'year', 'type', 'address', 'month', 'note', 'key', 'url', 'doi'],
        proceedings : ['entrytype', 'citation-key', 'title', 'year', 'editor', 'volume', 'number', 'series', 'address', 'month', 'organization',
            'publisher', 'note', 'key', 'isbn', 'url', 'doi'],
        techreport : ['entrytype', 'citation-key', 'author', 'title', 'institution', 'year', 'type', 'number', 'address', 'month', 'note', 'key', 'url', 'doi'],
        unpublished : ['entrytype', 'citation-key', 'author', 'title', 'note', 'month', 'year', 'key', 'url', 'doi']
    };

    let attributesForElement = [];

    switch (element['entrytype'].value) {
        case 'article':
        case 'book':
        case 'booklet':
        case 'conference':
        case 'inproceedings':
        case 'inbook':
        case 'incollection':
        case 'manual':
        case 'mastersthesis':
        case 'phdthesis':
        case 'proceedings':
        case 'techreport':
        case 'unpublished':
            attributesForElement = allFieldsAttribute[ element['entrytype'].value ];
            break;
        default:
            attributesForElement = allFieldsAttribute['misc'];
            break;
    }


    let elementKeys = Object.keys(element);
    let funFind = function(elementKey, index, array, type){
        return elementKey == this.type;
    };
    let result = [];
    attributesForElement.forEach(function(type, index, array){
        let foundTypeIx = elementKeys.findIndex(funFind, {'type': type});
        if(foundTypeIx == -1)
        {
            result.push(type);
        }
    });

    return result;
};

exports.chooseStyle = (loadedBibtexData, bibtexSortMethod) =>
{
    function compareType(a, b) {
        a['type'] = (typeof a.type === 'undefined') ? '' : a.type;
        b['type'] = (typeof b.type === 'undefined') ? '' : b.type;
        return a.type.localeCompare(b.type, 'pl');
    };

    function compareAuthor(a, b) {
        a['author'] = (typeof a.author === 'undefined') ? '' : a.author;
        b['author'] = (typeof b.author === 'undefined') ? '' : b.author;
        return a.author.localeCompare(b.author, 'pl');
    };

    function compareTitle(a, b) {
        a['title'] = (typeof a.title === 'undefined') ? '' : a.title;
        b['title'] = (typeof b.title === 'undefined') ? '' : b.title;
        return a.title.localeCompare(b.title, 'pl');
    };

    function compareYear(a, b) {
        if (a.year < b.year)
            return -1
        if (a.year > b.year)
            return 1
        return 0
    };

    switch (bibtexSortMethod) {
        case 'typeDesc':
            loadedBibtexData.sort(compareType);
            loadedBibtexData.reverse();
            break;
        case 'authorAsc':
            loadedBibtexData.sort(compareAuthor);
            break;
        case 'authorDesc':
            loadedBibtexData.sort(compareAuthor);
            loadedBibtexData.reverse();
            break;
        case 'titleAsc':
            loadedBibtexData.sort(compareTitle);
            break;
        case 'titleDesc':
            loadedBibtexData.sort(compareTitle);
            loadedBibtexData.reverse();
            break;
        case 'yearAsc':
            loadedBibtexData.sort(compareYear);
            break;
        case 'yearDesc':
            loadedBibtexData.sort(compareYear);
            loadedBibtexData.reverse();
            break;
        default:
            loadedBibtexData.sort(compareType);
            break;
    }

    return loadedBibtexData;
};