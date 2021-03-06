<?
require_once('../include/init.inc.php');

$act = get_postget_var('act');
$id = get_postget_var('id');
$ru = 'jobs.php';

switch ($act) {
    case 'save':
        validate_csrf_token();

        $id = (empty($_POST['id'])) ? NULL : intval($_POST['id']);
        foreach ($_POST as $k => $v) if (!is_array($v)) $_POST[$k] = trim($v);
        unset($_POST['id']);

        if (empty($_POST['active'])) $_POST['active'] = 0;
        if (empty($_POST['need_args'])) $_POST['need_args'] = 0;

        $item = new jobs($id);
        $item->from_array($_POST);
        $item->save();

        $jobId = $item->fields['id'];
        db_query("DELETE FROM servers_jobs WHERE job_id = $jobId");
        $servers = array_unique($_POST['servers']);
        foreach ($servers as $sid) {
            $sid = intval($sid);
            db_query("INSERT INTO servers_jobs SET job_id = $jobId,  server_id = $sid");
        }

        flashbag_put('Изменения сохранены');
        redirect($ru);
        break;

    case 'edit':
        if ($id == -1) $id = NULL;
        $item = new jobs($id);
        if (!empty($id) && empty($item->fields['id'])) throw_404();
        $item = $item->to_array();
        $tpl->assign('act', 'edit');
        $tpl->assign('item', $item);
        break;

    case 'delete':
        validate_csrf_token();

        if ($id == -1) $id = NULL;
        $item = new jobs($id);
        $item->delete();

        flashbag_put('Изменения сохранены');
        redirect($ru);
        break;

    case 'activate':
        db_query("UPDATE jobs SET active='1' WHERE id='$id'");
        redirect($ru);
        break;
    case 'deactivate':
        db_query("UPDATE jobs SET active='0' WHERE id='$id'");
        redirect($ru);
        break;


}

$items = new jobs_list();
$items = $items->get();
$tpl->assign('items', $items);

$items = new job_types_list();
$items = $items->get();
$tpl->assign('types', $items);


$servers = db_getAll("SELECT * FROM servers");
$tpl->assign('servers', $servers);

$tpl->assign('menu_cat', 'jobs');
$tpl->tpl = 'jobs';
$tpl->render('admin/main.tpl');
?>