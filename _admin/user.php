<?
require_once('../include/init.inc.php');

$act = get_postget_var('act');
$id = get_postget_var('id');
$ru = 'user.php';

switch ($act) {
    case 'save':
        validate_csrf_token();

        $id = (empty($_POST['id'])) ? NULL : intval($_POST['id']);
        foreach ($_POST as $k => $v) if (!is_array($v)) $_POST[$k] = trim($v);
        unset($_POST['id']);

        if (empty($_POST['active'])) $_POST['active'] = 0;



        $item = new user($id);
        $item->from_array($_POST);

        $item->save();


        flashbag_put('Изменения сохранены');
        redirect($ru);
        break;
    case 'edit':

        if ($id == -1) $id = NULL;
        $item = new user($id);

        if (!empty($id) && empty($item->fields['id'])) throw_404();
        $item = $item->to_array();
        $tpl->assign('act', 'edit');

        $tpl->assign('item', $item);
        break;

    case 'delete':
        validate_csrf_token();

        if ($id == -1) $id = NULL;
        $item = new user($id);
        $item->delete();

        flashbag_put('Изменения сохранены');
        redirect($ru);
        break;

    case 'activate':
        db_query("UPDATE `user` SET active='1' WHERE id='$id'");
        redirect($ru);
        break;
    case 'deactivate':
        db_query("UPDATE `user` SET active='0' WHERE id='$id'");
        redirect($ru);
        break;

}

$items = new user_list();
$items = $items->get();
$tpl->assign('items', $items);

$tpl->assign('menu_cat', 'user');
$tpl->tpl = 'user';
$tpl->render('admin/main.tpl');
?>