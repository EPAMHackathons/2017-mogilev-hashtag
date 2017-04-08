<?php
require_once('../include/init.inc.php');

if ( !$_SESSION['admin_user']->isRoot() ) die('not allowed');

$act = get_postget_var('act');
$id = get_postget_var('id');
$ru = 'admin_users.php';
$banned_perms = array('index', 'admin_users', 'login');
$allowed_perms = load_perms( $banned_perms );

switch ($act) {
	case 'save':
		validate_csrf_token();

		$id = (empty($_POST['id'])) ? NULL : intval($_POST['id']);
		foreach ($_POST as $k => $v) if (!is_array($v)) $_POST[$k] = trim($v);
		unset($_POST['id']);

		if (empty($_POST['active'])) $_POST['active'] = 0;
		if (empty($_POST['is_root'])) $_POST['is_root'] = 0;

		if (!empty($_POST['pwd'])) $_POST['pwd'] = $pwd = md5( md5( md5( $_POST['us_pwd'] . strrev($_POST['us_pwd']) )));
			else unset($_POST['pwd']);


		if (!empty($_POST['permissions'])) {
			$perms = array();
			$pms = explode(',', $_POST['permissions']);
			foreach ($pms as $p) {
				if ( in_array(strtolower($p), $allowed_perms) )  $perms[] = $p;
			}
			$_POST['permissions'] = implode(',', $perms);
		}
		
		$item = new admin_users($id);
		$item->from_array($_POST);
		$item->save();
		flashbag_put('Изменения сохранены');
		redirect($ru);
		break;

	case 'edit':
		if ($id == -1) $id = NULL;
		$item = new admin_users($id);
		if (!empty($id) && empty($item->fields['id'])) throw_404();
		$item = $item->to_array();
		$tpl->assign('act', 'edit');
		$tpl->assign('item', $item);
		$tpl->assign('perms', $allowed_perms);
		break;

	case 'delete':
		validate_csrf_token();
		if ($id == -1) $id = NULL;
		$item = new admin_users($id);
		$item->delete();
		flashbag_put('Изменения сохранены');
		redirect($ru);
		break;
	
	case 'activate':
		db_query("UPDATE admin_users SET active='1' WHERE id='$id'");
		redirect($ru);
		break;

	case 'deactivate':
		db_query("UPDATE admin_users SET active='0' WHERE id='$id'");
		redirect($ru);
		break;
}

$items = new admin_users_list();
$items = $items->get();
$tpl->assign('items', $items);

$tpl->assign('menu_cat', 'admin_users');

$tpl->tpl = 'admin_users';
$tpl->render('admin/main.tpl');

function load_perms( $banned_perms ) {
	$perms = array();
	$files = scandir(DOC_ROOT . '/_admin/');
	foreach ($files as $f) {
		$a = pathinfo($f);
		$f = strtolower($a['filename']);
		if ($a['extension'] == 'php' && !in_array($f, $banned_perms)) $perms[] = $f;
	}
	return $perms;
}
?>