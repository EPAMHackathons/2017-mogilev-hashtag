<?php




function smarty_function_csrf_token($params)
{

	if ( !empty($params['post'])) return '<input type="hidden" name="token" value="'.$_SESSION['csrf_token'].'" />';

    return '&token=' . $_SESSION['csrf_token'];
}

?>