<?php
require_once('../include/init.inc.php');

$act = get_postget_var('act');
$id = get_postget_var('id');
$ru = 'config.php';


switch ($act) {
	case 'save':

		foreach ($_POST as $k => $v) {
			if (preg_match('@^inp_(\d+)$@', $k, $m)) {
				$id = $m[1];
				db_query("UPDATE config SET `value` = '$v' WHERE id = $id");
			}
		}

		if ( !empty($_POST['key']) && !empty($_POST['value']) ) {
			$key = $_POST['key'];
			$val = $_POST['value'];
			$comment = $_POST['comment'];

			db_query("INSERT INTO config SET `key`='$key', `value`='$val', comment='$comment' ");
		}

		flashbag_put('Изменения сохранены');
		redirect($ru);
		break;
}

$items = db_getAll("SELECT * FROM config ORDER BY `key` ASC");
$tpl->assign('items', $items);

$tpl->assign('menu_cat', 'config');
$tpl->tpl = 'config';
$tpl->render('admin/main.tpl');

?>