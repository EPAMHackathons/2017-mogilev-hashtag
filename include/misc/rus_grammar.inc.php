<?

/**
 * Возвращает сумму прописью
 * @author runcore
 * @uses morph(...)
 */
function num2str($num)
{
    $num = preg_replace('@\s@', '', $num);
    $num = floatval($num);
    $nul = 'ноль';
    $ten = array(
        array('', 'один', 'два', 'три', 'четыре', 'пять', 'шесть', 'семь', 'восемь', 'девять'),
        array('', 'одна', 'две', 'три', 'четыре', 'пять', 'шесть', 'семь', 'восемь', 'девять'),
    );
    $a20 = array('десять', 'одиннадцать', 'двенадцать', 'тринадцать', 'четырнадцать', 'пятнадцать', 'шестнадцать', 'семнадцать', 'восемнадцать', 'девятнадцать');
    $tens = array(2 => 'двадцать', 'тридцать', 'сорок', 'пятьдесят', 'шестьдесят', 'семьдесят', 'восемьдесят', 'девяносто');
    $hundred = array('', 'сто', 'двести', 'триста', 'четыреста', 'пятьсот', 'шестьсот', 'семьсот', 'восемьсот', 'девятьсот');
    $unit = array( // Units
        array('копейка', 'копейки', 'копеек', 1),
        array('рубль', 'рубля', 'рублей', 0),
        array('тысяча', 'тысячи', 'тысяч', 1),
        array('миллион', 'миллиона', 'миллионов', 0),
        array('миллиард', 'милиарда', 'миллиардов', 0),
    );
    //
    list($rub, $kop) = explode('.', sprintf("%015.2f", floatval($num)));
    $out = array();
    if (intval($rub) > 0) {
        foreach (str_split($rub, 3) as $uk => $v) { // by 3 symbols
            if (!intval($v)) continue;
            $uk = sizeof($unit) - $uk - 1; // unit key
            $gender = $unit[$uk][3];
            list($i1, $i2, $i3) = array_map('intval', str_split($v, 1));
            // mega-logic
            $out[] = $hundred[$i1]; # 1xx-9xx
            if ($i2 > 1) $out[] = $tens[$i2] . ' ' . $ten[$gender][$i3]; # 20-99
            else $out[] = $i2 > 0 ? $a20[$i3] : $ten[$gender][$i3]; # 10-19 | 1-9
            // units without rub & kop
            if ($uk > 1) $out[] = morph($v, $unit[$uk][0], $unit[$uk][1], $unit[$uk][2]);
        } //foreach
    } else $out[] = $nul;
    $out[] = morph(intval($rub), $unit[1][0], $unit[1][1], $unit[1][2]); // rub
    $out[] = $kop . ' ' . morph($kop, $unit[0][0], $unit[0][1], $unit[0][2]); // kop
    return trim(preg_replace('/ {2,}/', ' ', join(' ', $out)));
}


function morph($n, $f1, $f2, $f5)
{
    $n = abs(intval($n)) % 100;
    if ($n > 10 && $n < 20) return $f5;
    $n = $n % 10;
    if ($n > 1 && $n < 5) return $f2;
    if ($n == 1) return $f1;
    return $f5;
}


function FileSizeConvert($bytes)
{
    if (!preg_match('@^\d+$@', $bytes)) $bytes = filesize($bytes);

    $bytes = floatval($bytes);
    $arBytes = array(
        0 => array(
            "UNIT" => "Тб",
            "VALUE" => pow(1024, 4)
        ),
        1 => array(
            "UNIT" => "Гб",
            "VALUE" => pow(1024, 3)
        ),
        2 => array(
            "UNIT" => "Мб",
            "VALUE" => pow(1024, 2)
        ),
        3 => array(
            "UNIT" => "Кб",
            "VALUE" => 1024
        ),
        4 => array(
            "UNIT" => "б",
            "VALUE" => 1
        ),
    );

    foreach ($arBytes as $arItem) {
        if ($bytes >= $arItem["VALUE"]) {
            $result = $bytes / $arItem["VALUE"];
            $result = str_replace(".", ".", strval(round($result, 1))) . " " . $arItem["UNIT"];
            break;
        }
    }
    return $result;
}


function get_rome_number($n)
{
    switch ($n) {
        case 1:
            return 'I';
            break;
        case 2:
            return 'II';
            break;
        case 3:
            return 'III';
            break;
        case 4:
            return 'IV';
            break;
        case 5:
            return 'V';
            break;
        case 6:
            return 'VI';
            break;
        case 7:
            return 'VII';
            break;
        case 8:
            return 'VIII';
            break;
        case 9:
            return 'IX';
            break;
        case 10:
            return 'X';
            break;
    }
}

?>