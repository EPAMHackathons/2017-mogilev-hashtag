<?
/*
 * types:
<p class="text-success">...</p>
<p class="text-warning">...</p>
<p class="text-error">...</p>

 */
function flashbag_put($msg, $type = 'success')
{
    if (empty($_SESSION)) return;
    if (!is_array($_SESSION['flashbag'])) $_SESSION['flashbag'] = array();
    array_push($_SESSION['flashbag'], array('msg' => $msg, 'type' => $type));
}

function flashbag_get()
{
    if (empty($_SESSION)) return;
    if (isset($_SESSION['flashbag']) && is_array($_SESSION['flashbag']) && !empty($_SESSION['flashbag'])) return array_pop($_SESSION['flashbag']);
    return false;
}


?>