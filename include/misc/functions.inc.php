<?

//HTTP-302 redirect
function redirect($url)
{
    header("HTTP/1.1 301 Moved Permanently");
    header('Location: ' . $url);
    die;
}

//HTTP-404 Error
function throw_404()
{

    header("HTTP/1.1 404 Not Found");
    header("Status: 404 Not Found");
    echo '<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN">' .
        '<html><head>' .
        '<title>404 Not Found</title>' .
        '</head><body>' .
        '<h1>Not Found</h1>' .
        '<p>The requested URL ' . htmlentities($_SERVER['REQUEST_URI']) . ' was not found on this server.</p>' .
        '</body></html>';
    die();
}

//download file from URL
function download_file($url)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);
    $s = curl_exec($ch);
    curl_close($ch);
    return $s;
}

function gen_url($s)
{
    $s = str_replace('ь', '', $s);
    $s = str_replace('ъ', '', $s);
    $s = str_replace('Ъ', '', $s);
    $s = str_replace('Ь', '', $s);

    $s = utf8_to_ascii($s);
    $s = utf8_strtolower($s);

    $s = preg_replace('/[^a-z0-9]/', ' ', $s);
    $s = preg_replace('/\s+/', ' ', $s);
    $s = utf8_trim($s);
    $s = str_replace(' ', '-', $s);
    return $s;
}

function validEmail($email)
{
    $isValid = true;
    $atIndex = strrpos($email, "@");
    if (is_bool($atIndex) && !$atIndex) {
        $isValid = false;
    } else {
        $domain = substr($email, $atIndex + 1);
        $local = substr($email, 0, $atIndex);
        $localLen = strlen($local);
        $domainLen = strlen($domain);
        if ($localLen < 1 || $localLen > 64) {
            $isValid = false;
        } else if ($domainLen < 1 || $domainLen > 255) {
            $isValid = false;
        } else if ($local[0] == '.' || $local[$localLen - 1] == '.') {
            $isValid = false;
        } else if (preg_match('/\\.\\./', $local)) {
            $isValid = false;
        } else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain)) {
            $isValid = false;
        } else if (preg_match('/\\.\\./', $domain)) {
            $isValid = false;
        } else if (!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/', str_replace("\\\\", "", $local))) {
            if (!preg_match('/^"(\\\\"|[^"])+"$/', str_replace("\\\\", "", $local))) {
                $isValid = false;
            }
        }
    }
    return $isValid;
}


function base64_urlencode($string)
{
    $data = base64_encode($string);
    $data = str_replace(array('+', '/', '='), array('-', '_', '.'), $data);
    return $data;
}

function base64_urldecode($data)
{
    $data = str_replace(array('-', '_', '.'), array('+', '/', '='), $data);
    $data = base64_decode($data);
    return $data;
}

function mask_login($str)
{
    $n = round(strlen($str) / 4);
    $res = mask_string($str, $n, $n);
    return $res;
}

function mask_string($str, $first, $last)
{
    $len = utf8_strlen($str);
    $res = $str;
    if ($len <= $first + $last) {
        $res = utf8_substr($str, 0, 1) . str_repeat('*', $len - 2) . utf8_substr($str, $len - 1, 1);
    } else {
        $res = utf8_substr($str, 0, $first) . str_repeat('*', $len - ($first + $last)) . utf8_substr($str, $len - $last, $last);
    }
    return $res;
}


function get_postget_var($key)
{
    if (isset($_POST[$key])) return $_POST[$key];
    if (isset($_GET[$key])) return $_GET[$key];
    return '';

}


function printr($a)
{
    print_r($a);
}


function remap_array($a, $key)
{
    $res = array();
    if (!empty($a)) foreach ($a as $v) $res[$v[$key]] = $v;
    return $res;
}

function remap_arrays($a, $key)
{
    $res = array();
    foreach ($a as $v) $res[$v[$key]][] = $v;
    return $res;
}


function gen_pass($len)
{
    $pass = md5(microtime(true) . strrev(microtime(true)) . rand(1, 1000000));
    return substr($pass, $len);
}


function textarea_toarray($s)
{
    $res = array();
    $a = explode("\n", $s);
    if (!empty($a)) {
        foreach ($a as $v) {
            $v = utf8_trim($v);
            if (!empty($v)) $res[] = $v;
        }
    }

    return $res;
}

function xml_to_array($s)
{
    $xml = simplexml_load_string($s);
    $json = json_encode($xml);
    return json_decode($json, TRUE);
}

function xmlfile_to_aray($fname)
{
    $s = file_get_contents($fname);
    return xmlfile_to_aray($s);
}


function cast_to_string($var)
{
    if (!is_array($var)) return (string)$var;

    foreach ($var as $k => $v) {
        if (is_array($v)) $var[$k] = cast_to_string($v);
        else {
            $v = (string)$v;
            if ($v == '0000-00-00') $v = '';
            $var[$k] = $v;
        }

    }
    return $var;
}

function arrayofobj_to_array($a)
{
    foreach ($a as $k => $v) {
        if (is_object($v)) $a[$k] = obj_to_array($v);
        elseif (is_array($v)) $a[$k] = arrayofobj_to_array($v);
        else $a[$k] = $v;
    }
    return $a;
}

function obj_to_array($o)
{
    $a = (array)$o;
    foreach ($a as $k => $v) {
        if (is_object($v)) $a[$k] = obj_to_array($v);
        elseif (is_array($v)) $a[$k] = arrayofobj_to_array($v);
        else $a[$k] = $v;
    }
    return $a;
}


function get_visitors_ip()
{
    if (isset($_SERVER['HTTP_X_REAL_IP'])) $ip = $_SERVER['HTTP_X_REAL_IP'];
    elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else $ip = $_SERVER['REMOTE_ADDR'];
    return $ip;
}

function sprint_r($var)
{
    ob_start();
    print_r($var);
    $s = ob_get_clean();
    return $s;
}

function svar_dump($var)
{
    ob_start();
    var_dump($var);
    $s = ob_get_clean();
    return $s;
}

function getUserIP()
{
    if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER) && !empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',') > 0) {
            $addr = explode(",", $_SERVER['HTTP_X_FORWARDED_FOR']);
            return trim($addr[0]);
        } else {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}


function mask_str($s)
{
    $len = strlen($s);
    $ending = substr($s, -2);
    return str_pad($ending, $len, '*', STR_PAD_LEFT);
}

function maskCodes($arr)
{
    if (!$_SESSION['admin_user']->isRoot() ) {
        foreach ($arr as $k => $v) {
            $arr[$k]['codeRaw'] = $v['code'];
            $arr[$k]['promocodeRaw'] = $v['promocode'];

            $arr[$k]['code'] = mask_str($v['code']);
            $arr[$k]['promocode'] = mask_str($v['promocode']);

        }
    }
    return $arr;
}

function unmaskCodes($codes, $f)
{
    foreach ($codes as $k => $v) {
        if ($v['codeRaw'] == $f || $v['promocodeRaw'] == $f) {
            $codes[$k]['hl'] = true;
            $codes[$k]['code'] = $v['codeRaw'];
            $codes[$k]['promocode'] = $v['promocodeRaw'];
        }
    }
    return $codes;
}



function sort_pos($a, $b)
{
    $a = $a['position'];
    $b = $b['position'];
    if ($a == $b) return 0;
    return ($a > $b) ? 1 : -1;
}

function build_flat_tree($parent, $items)
{
    $tree = build_tree($parent, $items);
    $res = flatten_tree($tree, 0);
    return $res;
}

function flatten_tree($tree)
{
    $res = [];
    if (empty($tree)) return $res;

    foreach ($tree as $t) {
        $childs = $t['childs'];
        unset($t['childs']);

        $res[] = $t;
        $res = array_merge($res, flatten_tree($childs));
    }
    return $res;
}

function build_tree($parent, $items, $lvl = 0)
{
    $ret = [];
    foreach ($items as $i) {
        if ($parent == $i['parent_id']) {
            $i['lvl'] = $lvl;
            $ret[] = $i;
        }
    }
    foreach ($ret as $k => $r) {
        $ret[$k]['childs'] = build_tree($r['id'], $items, $lvl + 1);
    }

    usort($ret, 'sort_pos');
    return $ret;
}

?>