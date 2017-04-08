<?
function get_lang($keyname, $lang = false)
{
    $lang = ($lang === false) ? CUR_LANG : $lang;
    $res = (isset($_SERVER['my_lang'][$lang][$keyname])) ? $_SERVER['my_lang'][$lang][$keyname] : '';
    return $res;
}

function get_lang_str($key)
{
    if (empty($_SERVER['my_lang'])) $_SERVER['my_lang'] = load_language();
    return stripcslashes($_SERVER['my_lang'][$key]);
}


function load_language($lang = '')
{
    if (empty($lang)) $lang = CUR_LANG;
    $lang = preg_replace('@[^\w]@', '', $lang);

    $file = DOC_ROOT . '/languages/' . $lang . '/language.conf';
    $a = file($file);
    $res = array();
    foreach ($a as $s) {
        list($key, $val) = explode('=', $s);
        $key = utf8_trim($key);
        $val = utf8_trim($val);
        if (preg_match('@^"(.*?)"$@', $val, $m)) {
            $res[$key] = $m[1];
        }
    }

    return $res;
}


function save_lang($lang, $lang_key)
{
    $fp = fopen(DOC_ROOT . '/languages/' . $lang_key . '/language.conf', 'w');
    foreach ($lang as $key => $str) {
        fputs($fp, clean_lang_key($key) . ' = "' . clean_lang_str($str) . '"' . "\r\n");
    }
    fclose($fp);
}


function clean_lang_key($s)
{
    $s = preg_replace('@[^\w]@', '', $s);
    $s = str_replace('"', '', $s);
    return $s;
}

function clean_lang_str($s)
{
    $s = str_replace("\r", '', $s);
    $s = str_replace("\n", '<br/>', $s);
    $s = str_replace('<?', '', $s);
    $s = str_replace('?>', '', $s);
    $s = str_replace('"', '\"', $s);
    return $s;
}

?>
