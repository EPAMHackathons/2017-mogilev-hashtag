<?
//svobodno.su
$_SERVER['config'] = array(
    'mysql' => array(
        'host' => 'localhost',
        'user' => 'root',
        'pass' => 'f21345p908hwVCQERPhiueio'
    ),
    'apache' => array(
        'port' => '8080',
        'avail_hosts_dir' => '/etc/apache2/sites-available',
        'enabled_hosts_dir' => '/etc/apache2/sites-enabled',
        'vhost_tpl' => 'apache_vhost.tpl',
        'restart_cmd' => 'service apache2 restart',
    ),
    'nginx' => array(
        'port' => '80',
        'avail_hosts_dir' => '/etc/nginx/sites-available',
        'enabled_hosts_dir' => '/etc/nginx/sites-enabled',
        'vhost_tpl' => 'nginx_vhost.tpl',
        'restart_cmd' => 'service nginx restart',
    ),
    'host' => '148.251.120.12'
);

//debug

//$_SERVER['user'] = 'taemgroup_mediapark_group_com';
//$_SERVER['sys_pwd'] = '5EFJnw1w4O1c2lg9';
//gen_pipeline_key();
//die();


$domain = $argv[1];
$domain_str = str_replace('-', '_', $domain);
$domain_str = str_replace('.', '_', $domain_str);

$_SERVER['domain'] = $domain;
$_SERVER['user'] = $domain_str;
$_SERVER['home_dir'] = '/home/' . $_SERVER['user'];
$_SERVER['www_dir'] = '/home/' . $_SERVER['user'] . '/www';


add_sys_user();
create_db();
generate_apache_vhost();
generate_nginx_vhost();

echo "======================== finished\r\n";
echo "- Domain: " . $domain . "\r\n";
if (!empty($_SERVER['sys_pwd'])) echo "- System user (ssh/ftp): " . $_SERVER['user'] . ':' . $_SERVER['sys_pwd'] . "\r\n";
if (!empty($_SERVER['mysql_pwd'])) echo "- mysql user: " . $_SERVER['mysql_user'] . ':' . $_SERVER['mysql_pwd'] . " with database: " . $_SERVER['mysql_user'] . "\r\n";

function generate_nginx_vhost()
{
    $conf = $_SERVER['config']['nginx'];
    $aconf = $_SERVER['config']['apache'];
    $tpl = file_get_contents($conf['vhost_tpl']);

    $tpl = preg_replace('@\[port\]@i', $conf['port'], $tpl);
    $tpl = preg_replace('@\[host\]@i', $_SERVER['domain'], $tpl);
    $tpl = preg_replace('@\[www_dir\]@i', $_SERVER['www_dir'], $tpl);
    $tpl = preg_replace('@\[user\]@i', $_SERVER['user'], $tpl);

    echo "Generating Nginx vhost\r\n";

    $fnameAvail = $conf['avail_hosts_dir'] . '/' . $_SERVER['user'] . '.conf';
    $fnameEnable = $conf['enabled_hosts_dir'] . '/' . $_SERVER['user'] . '.conf';
    file_put_contents($fnameAvail, $tpl);

    passthru("ln -s $fnameAvail $fnameEnable");
    passthru($conf['restart_cmd']);
}

function add_sys_user()
{
    $user = $_SERVER['user'];
    $_SERVER['sys_pwd'] = getPwd();
    $pwd = $_SERVER['sys_pwd'];
    $dir = '/home/' . $user;

    echo "Adding system user with password: $pwd\r\n";
    $cmd = 'echo "' . $pwd . '\n' . $pwd . '\n" | adduser --home ' . $dir . ' --gecos "" ' . $user;
    exec($cmd);

    passthru("mkdir $dir/www");
    passthru("chown $user:$user $dir/www");
}

function generate_apache_vhost()
{
    $conf = $_SERVER['config']['apache'];
    $tpl = file_get_contents($conf['vhost_tpl']);

    $tpl = preg_replace('@\[port\]@i', $conf['port'], $tpl);
    $tpl = preg_replace('@\[host\]@i', $_SERVER['domain'], $tpl);
    $tpl = preg_replace('@\[www_dir\]@i', $_SERVER['www_dir'], $tpl);
    $tpl = preg_replace('@\[user\]@i', $_SERVER['user'], $tpl);

    echo "Generating Apache vhost\r\n";

    $fnameAvail = $conf['avail_hosts_dir'] . '/' . $_SERVER['user'] . '.conf';
    $fnameEnable = $conf['enabled_hosts_dir'] . '/' . $_SERVER['user'] . '.conf';
    file_put_contents($fnameAvail, $tpl);

    file_put_contents($_SERVER['www_dir'].'/index.html', 'New domain: ' .$_SERVER['domain'] );
    passthru("ln -s $fnameAvail $fnameEnable");
    passthru($conf['restart_cmd']);
}

function create_db()
{
    $user = $_SERVER['user'];
    $conf = $_SERVER['config']['mysql'];
    $_SERVER['mysql_pwd'] = getPwd();
    $pwd = $_SERVER['mysql_pwd'];

    echo "Creating databse $user with password: $pwd\r\n";

    mysql_connect($conf['host'], $conf['user'], $conf['pass']);


    $existing = [];
    $q = mysql_query("SELECT DISTINCT(User) FROM mysql.user");
    while ($r = mysql_fetch_array($q)) $existing[] = $r;
    $user = substr($_SERVER['user'], 0, 16);
    $n = 0;
    while (in_array($user, $existing)) {
        $user = substr($_SERVER['user'], 0, 15) . $n;
    }

    $_SERVER['mysql_user'] = $user;


    mysql_query("CREATE DATABASE `$user`");
    mysql_query("grant usage on *.* to $user@localhost identified by '$pwd'");
    mysql_query("grant all privileges on $user.* to $user@localhost");
}


function getPwd($len = 16)
{
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < $len; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}


?>
