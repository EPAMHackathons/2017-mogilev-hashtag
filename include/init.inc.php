<?
if (!defined('DOC_ROOT')) define('DOC_ROOT', get_docroot());

require_once(DOC_ROOT . '/include/config.inc.php');

auto_include(DOC_ROOT . '/include/misc', DOC_ROOT . '/include/misc');
auto_include(DOC_ROOT . '/include/mysql', DOC_ROOT . '/include/mysql');
auto_include(DOC_ROOT . '/include/models', DOC_ROOT . '/include/models');

if (!defined('NO_SMARTY')) {
    if (preg_match('@^/' . $_SERVER['serv_config']['admin_folder'] . '[\.]?/@', $_SERVER['REQUEST_URI']) ||
        preg_match('@^/_admin_res[\.]?/@', $_SERVER['REQUEST_URI'])
    ) {
        load_smarty();
        $tpl = new Page();

        require_once(DOC_ROOT . '/include/manual_load/admin_config.php');
        require_once(DOC_ROOT . '/include/manual_load/admin_auth.inc.php');
        require_once(DOC_ROOT . '/include/manual_load/csrf_protection.inc.php');
        require_once(DOC_ROOT . '/include/init_page.inc.php');
    }
}

function load_smarty()
{
    if (!class_exists('Page')) {
        require_once(DOC_ROOT . '/include/smarty/Smarty.class.php');
        require_once(DOC_ROOT . '/include/manual_load/page.cls.php');
    }
}

//========= misc
function auto_include($dir, $orig)
{
    $files = scandir($dir);
    foreach ($files as $f) {
        if ($f == '.' || $f == '..' || $f == '.DS_Store') continue;
        if (is_file($dir . '/' . $f)) {
            require_once($dir . '/' . $f);
        } elseif (is_dir($dir . '/' . $f)) auto_include($dir . '/' . $f, $dir);
    }

}


function get_docroot()
{
    //get DOC_ROOT
    $droot = dirname(__FILE__);
    $droot = str_replace('\\', '/', $droot); //win-hack
    $droot = str_replace('/include', '', $droot);
    return $droot;
}

?>