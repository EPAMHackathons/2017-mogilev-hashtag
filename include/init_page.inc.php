<?
//** prepare variables for template here
flashMessagesToTpl($tpl);


function flashMessagesToTpl($tpl)
{
    $flash_messages = array();
    do {
        $msg = flashbag_get();
        if (!empty($msg)) $flash_messages[] = $msg;
    } while (!empty($msg));
    $tpl->assign('flash_messages', $flash_messages);

}

?>