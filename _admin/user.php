<?
require_once('../include/init.inc.php');

$act = get_postget_var('act');
$id = get_postget_var('id');
$ru = 'users.php';

switch ($act) {

}

$items = new user_list();
$items = $items->get();
$tpl->assign('items', $items);

$tpl->assign('menu_cat', 'users');
$tpl->tpl = 'user';
$tpl->render('admin/main.tpl');
?>