<?
require_once('../include/init.inc.php');

$act = get_postget_var('act');
$id = get_postget_var('id');
$ru = 'user.php';
$tpl->assign('act', $act);

switch ($act) {
    case 'activate':
    case 'deactivate':
        $newState = ($act == 'activate') ? 1 : 0;
        db_query("UPDATE user SET active='$newState' WHERE id = '$id' ");
        flashbag_put('Изменения сохранены');
        redirect($ru);
        break;


    case 'edit':
        $user = new user($id);
        $user = $user->to_array();
        $tpl->assign('user', $user);
        break;

}

$items = new user_list();
$items->filters[] = " username != '".$_SERVER['bot_config']['name']."' OR username IS NULL ";
$items = $items->get();
$tpl->assign('items', $items);

$tpl->assign('menu_cat', 'users');
$tpl->tpl = 'user';
$tpl->render('admin/main.tpl');
?>