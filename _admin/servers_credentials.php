<?
require_once('../include/init.inc.php');

$act = get_postget_var('act');
$id = get_postget_var('id');
$ru = 'servers_credentials.php';

switch ($act) {
	case 'save':
	validate_csrf_token();

	$id = (empty($_POST['id'])) ? NULL : intval($_POST['id']);

	foreach ($_POST as $k => $v) if (!is_array($v)) $_POST[$k] = trim($v);
	unset($_POST['id']);

    if (empty($_POST['active'])) $_POST['active'] = 0;
	
	$item = new servers($id);
	$item->from_array($_POST);
	
	$item->save();

		
	flashbag_put('Изменения сохранены');
	redirect($ru);
	break;
case 'edit':

	if ($id == -1) $id = NULL;
	$item = new servers($id);
	if (!empty($id) && empty($item->fields['id'])) throw_404();
	$item = $item->to_array();
	$tpl->assign('act', 'edit');


			$tpl->assign('item', $item);
	break;

case 'delete':
	validate_csrf_token();

	if ($id == -1) $id = NULL;
	$item = new servers($id);
	$item->delete();

	flashbag_put('Изменения сохранены');
	redirect($ru);
	break;





	//************** childs
	case 'child_save':
	validate_csrf_token();

	$id = (empty($_POST['id'])) ? NULL : intval($_POST['id']);
	foreach ($_POST as $k => $v) if (!is_array($v)) $_POST[$k] = trim($v);
	unset($_POST['id']);

    if (empty($_POST['active'])) $_POST['active'] = 0;
	
	$item = new servers_credentials($id);
	$item->from_array($_POST);
			//rebuild positions if the parent has been changed
		$pkey = $item->parent_key;
		if ($item->fields[$pkey] != $_POST[$pkey] && !empty($id)) {
		$old_parent = $item->fields[$pkey];
		$item->fields['position'] = NULL;
		}
	
	$item->save();

	if (!empty($old_parent)) $item->rebuild_pos($old_parent);	
	flashbag_put('Изменения сохранены');
	redirect($ru);
	break;
case 'child_edit':

	if ($id == -1) $id = NULL;
	$item = new servers_credentials($id);
	if (!empty($id) && empty($item->fields['id'])) throw_404();
	$item = $item->to_array();
	$tpl->assign('act', 'child_edit');


	if (!empty($_GET['parent'])) $tpl->assign('parent', intval($_GET['parent']));		$tpl->assign('item', $item);
	break;

case 'child_delete':
	validate_csrf_token();

	if ($id == -1) $id = NULL;
	$item = new servers_credentials($id);
	$item->delete();

	flashbag_put('Изменения сохранены');
	redirect($ru);
	break;
case 'activate':
    db_query("UPDATE `servers` SET active='1' WHERE id='$id'");
    redirect($ru);
    break;
case 'deactivate':
    db_query("UPDATE `servers` SET active='0' WHERE id='$id'");
    redirect($ru);
    break;

case 'child_activate':
    db_query("UPDATE `servers_credentials` SET active='1' WHERE id='$id'");
    redirect($ru);
    break;
case 'child_deactivate':
    db_query("UPDATE `servers_credentials` SET active='0' WHERE id='$id'");
    redirect($ru);
    break;



}

$items = new servers_list();
$items = $items->get();
foreach ($items as $k=>$v) {
$items[$k]['childs'] = db_getAll("SELECT * FROM servers_credentials WHERE server_id = '$v[id]'");
}

$tpl->assign('items', $items);
$tpl->assign('menu_cat', 'servers_credentials');
$tpl->tpl = 'servers_credentials';
$tpl->render('admin/main.tpl');
?>