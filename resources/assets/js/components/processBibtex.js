exports.process = (bibtexElements) =>
{
    let result = [];
    bibtexElements.forEach(function(element){
        let temp = {};

        switch(element.entrytype) {
            case 'article':
                temp = exports.TypeArticle(element);
                break;
            case 'book':
                temp = exports.TypeBook(element);
                break;
            case 'booklet':
                temp = exports.TypeBooklet(element);
                break;
            case 'conference':
            case 'inproceedings':
                temp = exports.TypeConference(element);
                break;
            case 'inbook':
                temp = exports.TypeInbook(element);
                break;
            case 'incollection':
                temp = exports.TypeIncollection(element);
                break;
            case 'manual':
                temp = exports.TypeManual(element);
                break;
            case 'mastersthesis':
                temp = exports.TypeMastersthesis(element);
                break;
            case 'phdthesis':
                temp = exports.TypePhdthesis(element);
                break;
            case 'proceedings':
                temp = exports.TypeProceedings(element);
                break;
            case 'techreport':
                temp = exports.TypeTechreport(element);
                break;
            case 'unpublished':
                temp = exports.TypeUnpublished(element);
                break;
            default:
                temp = exports.TypeMisc(element);
                break;
        }

        result.push(temp);
    });

    return result;
};

exports.TypeArticle = (element) =>
{
    var temp = {};
    temp.entrytype = { 'value': 'article', 'required': true };
    temp.author = { 'value': '', 'required': true };
    temp.title = { 'value': '', 'required': true };
    temp.journal = { 'value': '', 'required': true };
    temp.year = { 'value': '', 'required': true };

    for(var key in element) {
        if (temp[key] === undefined) {
            temp[key] = {'value': element[key], 'required': false};
        }
        else {
            temp[key]['value'] = element[key];
        }
    }

    return temp;
}

exports.TypeBook = (element) =>
{
    var temp = {};
    temp.entrytype = { 'value': 'book', 'required': true };
    temp.author = { 'value': '', 'required': true, 'or' : 'editor' };
    temp.editor = { 'value': '', 'required': true, 'or' : 'author' };
    temp.title = { 'value': '', 'required': true };
    temp.publisher = { 'value': '', 'required': true };
    temp.year = { 'value': '', 'required': true };
    temp.volume = { 'value': '', 'required': false, 'or' : 'number' };
    temp.number = { 'value': '', 'required': false, 'or' : 'volume' };

    for(var key in element) {
        if (temp[key] === undefined) {
            temp[key] = {'value': element[key], 'required': false};
        }
        else {
            temp[key]['value'] = element[key];
        }
    }

    return temp;
}

exports.TypeBooklet = (element) =>
{
    var temp = {};
    temp.entrytype = { 'value': 'booklet', 'required': true };
    temp.title = { 'value': '', 'required': true };

    for(var key in element) {
        if (temp[key] === undefined) {
            temp[key] = {'value': element[key], 'required': false};
        }
        else {
            temp[key]['value'] = element[key];
        }
    }

    return temp;
}

exports.TypeConference = (element) =>
{
    var temp = {};
    temp.entrytype = { 'value': 'conference', 'required': true };
    temp.author = { 'value': '', 'required': true };
    temp.title = { 'value': '', 'required': true };
    temp.booktitle = { 'value': '', 'required': true };
    temp.year = { 'value': '', 'required': true };
    temp.volume = { 'value': '', 'required': false, 'or' : 'number' };
    temp.number = { 'value': '', 'required': false, 'or' : 'volume' };

    for(var key in element) {
        if (temp[key] === undefined) {
            temp[key] = {'value': element[key], 'required': false};
        }
        else {
            temp[key]['value'] = element[key];
        }
    }

    return temp;
}

exports.TypeInbook = (element) =>
{
    var temp = {};
    temp.entrytype = { 'value': 'inbook', 'required': true };
    temp.author = { 'value': '', 'required': true, 'or' : 'editor' };
    temp.editor = { 'value': '', 'required': true, 'or' : 'author' };
    temp.title = { 'value': '', 'required': true };
    temp.chapter = { 'value': '', 'required': false };
    temp.pages = { 'value': '', 'required': false };
    temp.publisher = { 'value': '', 'required': true };
    temp.year = { 'value': '', 'required': true };

    for(var key in element) {
        if (temp[key] === undefined) {
            temp[key] = {'value': element[key], 'required': false};
        }
        else {
            temp[key]['value'] = element[key];
        }
    }

    return temp;
}

exports.TypeIncollection = (element) =>
{
    var temp = {};
    temp.entrytype = { 'value': 'incollection', 'required': true };
    temp.author = { 'value': '', 'required': true };
    temp.title = { 'value': '', 'required': true };
    temp.booktitle = { 'value': '', 'required': true };
    temp.publisher = { 'value': '', 'required': true };
    temp.year = { 'value': '', 'required': true };
    temp.volume = { 'value': '', 'required': false, 'or' : 'number' };
    temp.number = { 'value': '', 'required': false, 'or' : 'volume' };

    for(var key in element) {
        if (temp[key] === undefined) {
            temp[key] = {'value': element[key], 'required': false};
        }
        else {
            temp[key]['value'] = element[key];
        }
    }

    return temp;
}

exports.TypeManual = (element) =>
{
    var temp = {};
    temp.entrytype = { 'value': 'manual', 'required': true };
    temp.title = { 'value': '', 'required': true };

    for(var key in element) {
        if (temp[key] === undefined) {
            temp[key] = {'value': element[key], 'required': false};
        }
        else {
            temp[key]['value'] = element[key];
        }
    }

    return temp;
}

exports.TypeMastersthesis = (element) =>
{
    var temp = {};
    temp.entrytype = { 'value': 'mastersthesis', 'required': true };
    temp.author = { 'value': '', 'required': true };
    temp.title = { 'value': '', 'required': true };
    temp.school = { 'value': '', 'required': true };
    temp.year = { 'value': '', 'required': true };

    for(var key in element) {
        if (temp[key] === undefined) {
            temp[key] = {'value': element[key], 'required': false};
        }
        else {
            temp[key]['value'] = element[key];
        }
    }

    return temp;
}

exports.TypePhdthesis = (element) =>
{
    var temp = {};
    temp.entrytype = { 'value': 'phdthesis', 'required': true };
    temp.author = { 'value': '', 'required': true };
    temp.title = { 'value': '', 'required': true };
    temp.school = { 'value': '', 'required': true };
    temp.year = { 'value': '', 'required': true };

    for(var key in element) {
        if (temp[key] === undefined) {
            temp[key] = {'value': element[key], 'required': false};
        }
        else {
            temp[key]['value'] = element[key];
        }
    }

    return temp;
}

exports.TypeProceedings = (element) =>
{
    var temp = {};
    temp.entrytype = { 'value': 'proceedings', 'required': true };
    temp.title = { 'value': '', 'required': true };
    temp.year = { 'value': '', 'required': true };
    temp.volume = { 'value': '', 'required': false, 'or' : 'number' };
    temp.number = { 'value': '', 'required': false, 'or' : 'volume' };

    for(var key in element) {
        if (temp[key] === undefined) {
            temp[key] = {'value': element[key], 'required': false};
        }
        else {
            temp[key]['value'] = element[key];
        }
    }

    return temp;
}

exports.TypeTechreport = (element) =>
{
    var temp = {};
    temp.entrytype = { 'value': 'techreport', 'required': true };
    temp.author = { 'value': '', 'required': true };
    temp.title = { 'value': '', 'required': true };
    temp.institution = { 'value': '', 'required': true };
    temp.year = { 'value': '', 'required': true };

    for(var key in element) {
        if (temp[key] === undefined) {
            temp[key] = {'value': element[key], 'required': false};
        }
        else {
            temp[key]['value'] = element[key];
        }
    }

    return temp;
}

exports.TypeUnpublished = (element) =>
{
    var temp = {};
    temp.entrytype = { 'value': 'unpublished', 'required': true };
    temp.author = { 'value': '', 'required': true };
    temp.title = { 'value': '', 'required': true };
    temp.note = { 'value': '', 'required': true };

    for(var key in element) {
        if (temp[key] === undefined) {
            temp[key] = {'value': element[key], 'required': false};
        }
        else {
            temp[key]['value'] = element[key];
        }
    }

    return temp;
}

exports.TypeMisc = (element) =>
{
    var temp = {};
    temp.entrytype = { 'value': 'misc', 'required': true };
    /*temp.address = { 'value': '', 'required': false };
    temp.author = { 'value': '', 'required': false };
    temp.booktitle = { 'value': '', 'required': false };
    temp.chapter = { 'value': '', 'required': false };
    temp.doi = { 'value': '', 'required': false };
    temp.eid = { 'value': '', 'required': false };
    temp.edition = { 'value': '', 'required': false };
    temp.editor = { 'value': '', 'required': false };
    temp.howpublished = { 'value': '', 'required': false };
    temp.institution = { 'value': '', 'required': false };
    temp.isbn = { 'value': '', 'required': false };
    temp.issn = { 'value': '', 'required': false };
    temp.journal = { 'value': '', 'required': false };
    temp.key = { 'value': '', 'required': false };
    temp.month = { 'value': '', 'required': false };
    temp.note = { 'value': '', 'required': false };
    temp.number = { 'value': '', 'required': false };
    temp.organization = { 'value': '', 'required': false };
    temp.pages = { 'value': '', 'required': false };
    temp.publisher = { 'value': '', 'required': false };
    temp.school = { 'value': '', 'required': false };
    temp.series = { 'value': '', 'required': false };
    temp.title = { 'value': '', 'required': false };
    temp.type = { 'value': '', 'required': false };
    temp.url = { 'value': '', 'required': false };
    temp.volume = { 'value': '', 'required': false };
    temp.key = { 'value': '', 'required': false };
    temp.year = { 'value': '', 'required': false };*/

    for(var key in element) {
        if (temp[key] === undefined) {
            temp[key] = {'value': element[key], 'required': false};
        }
        else {
            temp[key]['value'] = element[key];
        }
    }

    return temp;
}