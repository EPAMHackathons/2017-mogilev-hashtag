<?
//we use single token per session
if ( empty($_SESSION['csrf_token']) )  set_csrf_token();


function validate_csrf_token() {
	if ( is_dev_server() ) return true;

	$token = get_postget_var('token');
	$curToken = $_SESSION['csrf_token'];
	//set_csrf_token();

	if (empty($token) ||  $token !== $curToken) die('csrf test failed');
}

function set_csrf_token() {
	$_SESSION['csrf_token'] = md5( microtime(true) . strrev(microtime(true)) );
}
?>
