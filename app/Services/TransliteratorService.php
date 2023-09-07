<?php

namespace App\Services;

use App\Contracts\TransliteratorServiceInterface;

class TransliteratorService implements TransliteratorServiceInterface
{
    private bool $translited = false;

    public function isTextTranslited(null|string $text): bool
    {
        if ($text) {
            $cyrillicPattern = '/[а-яіїєґА-ЯІЇЄҐ]/u'; // Check for Ukrainian characters
            return !preg_match(
                $cyrillicPattern,
                $text
            );
        }

        return $this->translited;
    }

    public function detranslit($src): string
    {
        $this->translited = true;
        return $this->translit($src);
    }

    public function translit($src): string
    {
        $out_text = '';
        $count = mb_strlen($src);
        if (!$this->translited) {
            for ($i = 0; $i < $count; $i++) {
                $schar = mb_substr($src, $i, 1);
                list($schar, $isDouble) = $this->getAlt($schar, 0);
                if ($isDouble) {
                    $i++;
                }
                $out_text .= $schar;
            }
            $this->translited = true;
        } else {
            for ($i = 0; $i < $count; $i++) {
                $schar = mb_substr($src, $i, 1);
                $dchar = $schar . mb_substr($src, $i + 1, 1);
                list($schar, $isDouble) = $this->getAlt($schar, 1, $dchar);
                if ($isDouble) {
                    $i++;
                }
                $out_text .= $schar;
            }
            $this->translited = false;
        }
        return $out_text;
    }

    private function getAlt($schar, $trans, $dchar = '')
    {
        $cyr = [
            "щ",
            "ш",
            "ч",
            "ц",
            "ю",
            "я",
            "ж",
            "а",
            "б",
            "в",
            "г",
            "д",
            "е",
            "ё",
            "з",
            "и",
            "й",
            "к",
            "л",
            "м",
            "н",
            "о",
            "п",
            "р",
            "с",
            "т",
            "у",
            "ф",
            "х",
            "ь",
            "ы",
            "ъ",
            "э",
            "є",
            "ї",
            "і",
            " ",
            "Щ",
            "Ш",
            "Ч",
            "Ц",
            "Ю",
            "Я",
            "Ж",
            "А",
            "Б",
            "В",
            "Г",
            "Д",
            "Е",
            "Ё",
            "З",
            "И",
            "Й",
            "К",
            "Л",
            "М",
            "Н",
            "О",
            "П",
            "Р",
            "С",
            "Т",
            "У",
            "Ф",
            "Х",
            "Ь",
            "Ы",
            "Ъ",
            "Э",
            "Є",
            "Ї",
            "І",
            "В",
            "в",
            "№"
        ];
        $lat = [
            "sh",
            "sh",
            "ch",
            "c",
            "yu",
            "ya",
            "j",
            "a",
            "b",
            "v",
            "g",
            "d",
            "e",
            "e",
            "z",
            "i",
            "y",
            "k",
            "l",
            "m",
            "n",
            "o",
            "p",
            "r",
            "s",
            "t",
            "u",
            "f",
            "h",
            "'",
            "y",
            "_",
            "e",
            "e",
            "yi",
            "i",
            " ",
            "Shch",
            "Sh",
            "Ch",
            "C",
            "Yu",
            "Ya",
            "J",
            "A",
            "B",
            "V",
            "G",
            "D",
            "e",
            "e",
            "Z",
            "I",
            "y",
            "K",
            "L",
            "M",
            "N",
            "O",
            "P",
            "R",
            "S",
            "T",
            "U",
            "F",
            "H",
            "'",
            "Y",
            "_",
            "E",
            "E",
            "Yi",
            "I",
            "W",
            "w",
            "#"
        ];
        $outchar = '';
        $sdouble = 0;

        if ($trans == 1) {
            $ind_count = count($lat);
            for ($j = 0; $j < $ind_count; $j++) {
                if ($dchar == $lat[$j]) {
                    $sdouble = 1;
                    $outchar = $cyr[$j];
                    break;
                }
            }
            if ($outchar == '') {
                for ($j = 0; $j < $ind_count; $j++) {
                    if ($schar == $lat[$j]) {
                        $outchar = $cyr[$j];
                        break;
                    }
                }
            }
            if ($outchar == '') {
                $outchar = $schar;
            }
        } else {
            $ind_count = count($cyr);
            for ($j = 0; $j < $ind_count; $j++) {
                if ($schar == $cyr[$j]) {
                    $outchar = $lat[$j];
                    break;
                }
            }
            if ($outchar == '') {
                $outchar = $schar;
            }
        }

        return [$outchar, $sdouble];
    }
}
