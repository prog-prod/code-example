var translited = false;
function translit(src, dest) {
    elem = document.getElementById(src).value;
    out_text = "";
    count = elem.length;
    if (!translited) {
        for (i = 0; i < count; i++) {
            //schar = get_alt(elem[i],0);
            schar = elem[i];
            arr = get_alt(schar, 0);
            if (arr[1] == 1) {
                i++
            }
            schar = arr[0];
            out_text += schar
        }
        translited = true;
        document.getElementById('translit_button').innerHTML = document.getElementById('translit_button').getAttribute('data-text-detranslit');
    }
    else {
        for (i = 0; i < count; i++) {
            //schar = get_alt(elem[i],0);
            schar = elem[i];
            dchar = schar + elem[i + 1]
            arr = get_alt(schar, 1, dchar);
            if (arr[1] == 1) {
                i++
            }
            schar = arr[0];
            out_text += schar
        }
        translited = false;
        document.getElementById('translit_button').innerHTML = document.getElementById('translit_button').getAttribute('data-text-translit');
    }
    document.getElementById(dest).value = out_text;
}

function detranslit(src, dest) {
    elem = document.getElementById(src).value;

    out_text = "";
    count = elem.length;
    for (i = 0; i < count; i++) {
        //schar = get_alt(elem[i],0);
        schar = elem[i];
        dchar = schar + elem[i + 1]
        arr = get_alt(schar, 1, dchar);
        if (arr[1] == 1) {
            i++
        }
        schar = arr[0];
        out_text += schar
    }
    document.getElementById(dest).value = out_text
}

function get_alt(schar, trans, dchar) {
    cyr = [
        "щ", "ш", "ч", "ц", "ю", "я", "ж", "а", "б", "в",
        "г", "д", "е", "ё", "з", "и", "й", "к", "л", "м", "н",
        "о", "п", "р", "с", "т", "у", "ф", "х", "ь", "ы", "ъ",
        "э", "є", "ї", "і", " ",
        "Щ", "Ш", "Ч", "Ц", "Ю", "Я", "Ж", "А", "Б", "В",
        "Г", "Д", "Е", "Ё", "З", "И", "Й", "К", "Л", "М", "Н",
        "О", "П", "Р", "С", "Т", "У", "Ф", "Х", "Ь", "Ы", "Ъ",
        "Э", "Є", "Ї", "І", "В", "в", "№"

    ];
    lat = [
        "sh", "sh", "ch", "c", "yu", "ya", "j", "a", "b", "v",
        "g", "d", "e", "e", "z", "i", "y", "k", "l", "m", "n",
        "o", "p", "r", "s", "t", "u", "f", "h",
        "'", "y", "_", "e", "e", "yi", "i", " ",
        "Shch", "Sh", "Ch", "C", "Yu", "Ya", "J", "A", "B", "V",
        "G", "D", "e", "e", "Z", "I", "y", "K", "L", "M", "N",
        "O", "P", "R", "S", "T", "U", "F", "H", "'",
        "Y", "_", "E", "E", "Yi", "I", "W", "w", "#"

    ];
    outchar = '';
    sdouble = 0;
    if (trans == 1) {
        ind_count = lat.length;

        for (j = 0; j < ind_count; j++) {
            if (dchar == lat[j]) {
                sdouble = 1
                outchar = cyr[j];
                break;
            }
        }
        if (outchar == '') {
            for (j = 0; j < ind_count; j++) {
                if (schar == lat[j]) {
                    outchar = cyr[j];
                    break;
                }
            }
        }
        if (outchar == '') {
            outchar = schar;
        }
        return [outchar, sdouble];
    }
    else {
        ind_count = cyr.length;

        for (j = 0; j < ind_count; j++) {
            if (schar == cyr[j]) {
                outchar = lat[j];
                break;
            }
        }
        if (outchar == '') {
            outchar = schar;
        }
        return [outchar, sdouble];
    }

}