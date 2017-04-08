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

    case 'save':
        db_query("DELETE FROM users_permissions WHERE user_id = $id");

        foreach ($_POST as $k => $v) {
            if (preg_match('@job_(\d+)_(\d+)@', $k, $m)) {
                $servId = $m[1];
                $jobId = $m[2];
                if (!empty($_POST[$k.'_creds'])) {
                    $credId = $_POST[$k.'_creds'];
                    db_query("INSERT INTO users_permissions SET user_id = $id, job_id = $jobId, server_id = $servId, credential_id = $credId");
                }
            }
        }

        flashbag_put('Изменения сохранены');
        redirect($ru . '?act=edit&id=' . $id);
        break;


    case 'edit':
        $user = new user($id);
        $user = $user->to_array();

        $tpl->assign('user', $user);
        break;

}

$items = new user_list();
$items->filters[] = " username != '" . $_SERVER['bot_config']['name'] . "' OR username IS NULL ";
$items = $items->get();
$tpl->assign('items', $items);


$servers = new servers_list();
$servers = $servers->get();
$tpl->assign('servers', $servers);


$tpl->assign('menu_cat', 'users');
$tpl->tpl = 'user';
$tpl->render('admin/main.tpl');
?>