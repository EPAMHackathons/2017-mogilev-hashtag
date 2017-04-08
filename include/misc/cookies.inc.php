<?
function my_deletecookie($name)
{
    $expire = 10 * 365 * 24 * 3600;
    setcookie($name, '', time() - $expire, '/', APP_TOP_DOMAIN);
}

function my_setcookie($name, $value, $expire = false)
{
    if ($expire === false) $expire = 365 * 24 * 3600; //default is 1 year
    setcookie($name, $value, time() + $expire, '/', APP_TOP_DOMAIN);

}

?>