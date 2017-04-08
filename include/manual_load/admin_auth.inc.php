<?
/*session_start();
if (isset($_GET['do_admin_logout'])) do_admin_logout();
if (isset($_POST['admin_login']) && isset($_POST['admin_pwd'])) do_admin_login();
if (!empty($_SESSION['admin_user'])) set_admin_logged_in($_SESSION['admin_user']);
if (empty($_SESSION['admin_user']) && $_SERVER['SCRIPT_NAME'] != '/' . $_SERVER['serv_config']['admin_folder'] . '/login.php') redirect('/' . $_SERVER['serv_config']['admin_folder'] . '/login.php');

load_admin_titles();

if (!empty($_SESSION['admin_user'])) {
    check_admin_session();
}


//handle language selection
if (empty($_SESSION['admin_lang'])) set_admin_lang(CUR_LANG);
if (!empty($_GET['set_admin_lang'])) {
    //set_admin_lang($_GET['set_admin_lang']);
    redirect(preg_replace('@\?.*@', '', $_SERVER['REQUEST_URI']));
}
//connect_to_selected_language();


function do_admin_login()
{
    global $tpl;
    $tpl->assign('post', $_POST);

    $badTries = db_getOne("SELECT bad_auth_tries FROM admin_users WHERE login='$_POST[admin_login]'");
    if ($badTries >= 5) {
        db_query("UPDATE admin_users SET active=0 WHERE login='$_POST[admin_login]'");
        $tpl->assign('error', 'locked');
    } else {
        $user = validate_admin_login($_POST['admin_login'], $_SERVER['us_POST']['admin_pwd']);


        if (!empty($user)) {
            if (!empty($user['days_since_last_login']) && $user['days_since_last_login'] > 30) {
                db_query("UPDATE admin_users SET active = 0 WHERE id = $user[id]");
                $tpl->assign('error', 'inactive');
            } elseif (empty($user['active'])) {
                $tpl->assign('error', 'deactivated');
            } elseif ($user['days_since_pwd_change'] > 90) {
                $tpl->assign('error', 'old_pwd');
            } else {
                set_admin_logged_in($user);
                db_query("UPDATE admin_users SET last_login = NOW(), bad_auth_tries = 0 WHERE id= $user[id]");
                redirect('/' . $_SERVER['serv_config']['admin_folder'] . '/index.php');
            }
        } else {
            db_query("UPDATE admin_users SET bad_auth_tries = bad_auth_tries + 1 WHERE login='$_POST[admin_login]' ");
            $tpl->assign('admin_login_error', '1');
        }
    }


}

function do_admin_logout()
{
    $_SESSION['admin_user'] = '';
    unset($_SESSION['admin_user']);
    session_unset('admin_user');
    redirect('/');
}

function set_admin_logged_in($a)
{
    $uid = is_array($a) ? $a['id'] : $a->fields['id'];
    $_SESSION['admin_user'] = new admin_users($uid);
    $uri = basename($_SERVER['REQUEST_URI']);
    $uri = preg_replace('@\?.*@', '', $uri);
    $uri = str_replace('.php', '', $uri);


    if ($uri == $_SERVER['serv_config']['admin_folder']) $uri = 'index';

    $allowedAll = ['login'];
    if (!in_array($uri, $allowedAll) &&
        !$_SESSION['admin_user']->has_permission($uri)) die("NOT allowed");

}


function load_admin_titles()
{
    global $tpl;

    if (!empty($_SERVER['admin_titles'])) {
        foreach ($_SERVER['admin_titles'] as $k => $v) {
            $res[] = array('key' => $k, 'title' => $v);
        }
        $tpl->assign('admin_titles', $res);
    }
}


function set_admin_lang($lang)
{
    if (!empty($_SESSION['admin_user'])) $_SESSION['admin_lang'] = $lang;
}

function connect_to_selected_language()
{
    if (empty($_SESSION['admin_user'])) return false;

    $config = (DEV_SERVER == 1) ? $_SERVER['dev_config'] : $_SERVER['prod_config'];
    $_SESSION['admin_lang'] = 'ru';
    if (empty($config[$_SESSION['admin_lang']])) die("can't load config for lang: " . $_SESSION['admin_lang']);
    $config = $config[$_SESSION['admin_lang']];
    $_SERVER['mysql_auth'] = array(
        $config['db'] => array('host' => $config['dbhost'], 'user' => $config['dbuser'], 'pass' => $config['dbpass'])
    );
    do_mysql_connect($config['db'], 'default');
    $_SERVER['admin_db'] = $config['db'];
}


function check_admin_session()
{
    if (empty($_SESSION['admin_user'])) return;

    $sid = session_id();
    $uid = $_SESSION['admin_user']->fields['id'];

    $ssid = db_getOne("SELECT id FROM admin_sessions WHERE sid='$sid' ");
    if (empty($ssid)) {
        $ssid = db_query("INSERT INTO admin_sessions SET sid='$sid', start=NOW(), end=NOW(), user_id = $uid");
    } else {
        db_query("UPDATE admin_sessions SET end=NOW() WHERE id = $ssid");
    }

    $_SERVER['admin_ssid'] = $ssid;
}

function admsess_save_action($action)
{
    if (empty($_SERVER['admin_ssid']) || empty($action)) return;

    $ssid = $_SERVER['admin_ssid'];
    $action = escape_recurrent($action);
    $ip = getUserIP();

    db_query("INSERT INTO admin_sessions_actions SET ssid='$ssid', performed=NOW(), action='$action', ip='$ip' ");
}*/


session_start();
if (isset($_GET['do_admin_logout'])) do_admin_logout();
if (isset($_POST['admin_login']) && isset($_POST['admin_pwd'])) do_admin_login();
if (!empty($_SESSION['admin_user'])) set_admin_logged_in($_SESSION['admin_user']);

if (empty($_SESSION['admin_user']) && $_SERVER['SCRIPT_NAME'] != '/_admin/login.php') redirect('/_admin/login.php');

load_admin_titles();


function do_admin_login()
{
    global $tpl;

    $user = validate_admin_login($_POST);

    if (!empty($user)) {
        set_admin_logged_in($user);
        redirect('/_admin/index.php');
    } else {
        $tpl->assign('post', $_POST);
        $tpl->assign('admin_login_error', '1');
    }
}

function do_admin_logout()
{
    $_SESSION['admin_user'] = '';
    unset($_SESSION['admin_user']);
    session_unset('admin_user');
    redirect('/');
}

function set_admin_logged_in($a)
{
    $uid = is_array($a) ? $a['id'] : $a->fields['id'];
    $_SESSION['admin_user'] = new admin_users($uid);
}



function load_admin_titles() {
    global $tpl;

    if (!empty($_SERVER['admin_titles'])) {
        foreach ($_SERVER['admin_titles'] as $k=>$v) {
            $res[] = array('key' => $k, 'title' => $v);
        }
        $tpl->assign('admin_titles', $res);
    }
}


?>