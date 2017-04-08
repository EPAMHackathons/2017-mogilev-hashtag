<?
require_once('../include/init.inc.php');

$act = get_postget_var('act');
$id = get_postget_var('id');
$ru = 'servers.php';

switch ($act) {
	case 'save':
	validate_csrf_token();

	$id = (empty($_POST['id'])) ? NULL : intval($_POST['id']);
	foreach ($_POST as $k => $v) if (!is_array($v)) $_POST[$k] = trim($v);
	unset($_POST['id']);
	
	
	
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



}

$items = new servers_list();
$items = $items->get();
$tpl->assign('items', $items);

$tpl->assign('menu_cat', 'servers');
$tpl->tpl = 'servers';
$tpl->render('admin/main.tpl');
?>