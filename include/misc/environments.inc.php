<?
function is_dev_server()
{
    if (!defined('DEV_SERVER')) return false;
    if (DEV_SERVER == 1) return true;
    return false;
}

function is_uat_server()
{
    if (!defined('DEV_SERVER')) return false;
    if (DEV_SERVER == 2) return true;
    return false;
}

?>
