<?

$dev_config = array(
    'ru' => array(
        'hosts' => array('telehelp.ru', 'www.telehelp.ru', 'telehelp.local'),
        'def_host' => 'telehelp.ru',
        'db' => 'telehelp',
        'dbhost' => 'localhost',
        'dbuser' => 'root',
        'dbpass' => '',

        'admin_folder' => '_admin',
        'TERM_PROGRAM' => ['apple_terminal'],
        'server_user' => 'ivan',

    )
);

$uat_config = array(
    'ru' => array(
        'hosts' => array('192.168.6.54'),
        'def_host' => '192.168.6.54',

        'db' => 'podarki',
        'dbhost' => 'localhost',
        'dbuser' => 'podarki',
        'dbpass' => 'gv24verliuhqfre7qewrflhi7fqr',

        'admin_folder' => '_admin',
        'server_user' => 'telehelp_mediapark_group_com',

    )
);


$prod_config = array(
    'ru' => array(
        'hosts' => array('telehelp.mediapark-group.com', 'www.telehelp.mediapark-group.com'),
        'def_host' => 'telehelp.mediapark-group.com',

        'db' => 'telehelp_mediapa',
        'dbhost' => 'localhost',
        'dbuser' => 'telehelp_mediapa',
        'dbpass' => 'HT5uCD5lG4KCwqR7',

        'admin_folder' => '_admin',
        'cert_dir' => 'certificates',
        'PWD' => ['/home/savchenkov.a/www/_cronjobs'],
        'server_user' => 'telehelp_mediapark_group_com',
    )
);

//======== END OF configuration

$config = get_config($dev_config);

if (!empty($config)) {
    define('DEV_SERVER', '1');

    error_reporting(E_ALL & ~E_NOTICE  & ~E_DEPRECATED &  ~E_USER_DEPRECATED) ;

} elseif (!empty(get_config($uat_config))) {
    $config = get_config($uat_config);
    define('DEV_SERVER', '2');
    error_reporting(0); //do not display any errors on uat
} else {
    $config = get_config($prod_config, true);
    error_reporting(0); //do not display any errors on production


    if(!empty($_SERVER['force_errors'])) {
        ini_set('display_errors', 0);
    } else {
        error_reporting(E_ALL); ini_set('display_errors', 1);
    }
}

if (empty($config)) die('cant get config');


define('CUR_LANG', $config['lang']);
define('MYSQL_DB', $config['db']);
define('SMARTY_CONFIG_DIR', DOC_ROOT . '/languages/' . $config['lang'] . '/');

$_SERVER['serv_config'] = $config;
$_SERVER['dev_config'] = $dev_config;
$_SERVER['prod_config'] = $prod_config;

$_SERVER['mysql_auth'] = array(
    $config['db'] => array('host' => $config['dbhost'], 'user' => $config['dbuser'], 'pass' => $config['dbpass']),
);


define('SITE_DOMAIN', $config['def_host']);
define('APP_TOP_DOMAIN', '.' . $config['def_host']); //domain for cookie handling, must starts with dot
define('TOP_DOMAIN', $config['def_host']);


function get_config($configs, $force_me = false)
{

    $res = array();

    //get by host & dir name
    if (!empty($_SERVER['HTTP_HOST'])) {
        $host = @strtolower($_SERVER['HTTP_HOST']);
        foreach ($configs as $lang => $data) {
            if (in_array($host, $data['hosts'])) {
                $data['lang'] = $lang;
                if (!empty($data['dir_prefix'])) {
                    if (preg_match('@^' . preg_quote($data['dir_prefix'], '@') . '@', $_SERVER['REQUEST_URI'])) return $data;
                } else $res = $data;
            }
        }

        //get by cname
    } else {

        $cname = @strtolower($_SERVER['PWD']);
        if (!empty($cname)) {
            foreach ($configs as $lang => $data) {
                if (!isset($data['PWD'])) continue;
                if (in_array($cname, $data['PWD'])) {
                    $data['lang'] = $lang;
                    $res = $data;
                }
            }
        }

        $term = @strtolower($_SERVER['TERM_PROGRAM']);
        if (!empty($term)) {
            foreach ($configs as $lang => $data) {
                if (!isset($data['TERM_PROGRAM'])) continue;

                if (in_array($term, $data['TERM_PROGRAM'])) {
                    $data['lang'] = $lang;
                    $res = $data;
                }
            }
        }

        //force load of production config for cronjobs
        if (!empty($force_me)) {
            foreach ($configs as $lang => $data) {
                $data['lang'] = $lang;
                return $data;
            }
        }
    }

    return $res;
}

?>