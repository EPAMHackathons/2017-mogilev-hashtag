<?

class Page extends Smarty
{
    var $title;
    var $description;
    var $tpl;
    var $scripts = array();
    var $menu_cat = '';
    var $debug = false;

    function Page()
    {
        global $lang_domains;

        parent::__construct();

        //Configuring Smarty
        $this->template_dir = DOC_ROOT . '/tpl/';
        $this->compile_dir = DOC_ROOT . '/tpl/tpl_c/';
        $this->cache_dir = DOC_ROOT . '/tpl/tpl_c/cache/';

        if (!file_exists(DOC_ROOT . '/tpl/tpl_c/')) @mkdir(DOC_ROOT . '/tpl/tpl_c/');
        if (!is_writable(DOC_ROOT . '/tpl/tpl_c/')) die('smarty compile dir is not writeable');
        if (!file_exists(DOC_ROOT . '/tpl/tpl_c/cache/')) @mkdir(DOC_ROOT . '/tpl/tpl_c/cache/');
        if (!is_writable(DOC_ROOT . '/tpl/tpl_c/cache/')) die('smarty cache dir is not writeable');

        $this->config_dir = DOC_ROOT . '/languages/' . CUR_LANG .'/';


        $this->left_delimiter = '{';
        $this->right_delimiter = '}';
        $this->config_overwrite = true;


        //$this->caching = false;
        if (is_dev_server()) {
            $this->force_compile = true;
            $this->assign('is_dev_server', 1);
        } elseif (is_uat_server()) {
            $this->force_compile = true;
            $this->assign('is_uat_server', 1);
        } else {
            $this->force_compile = false;
            $this->caching = false;
            $this->compile_check = true;
        }

        $this->debugging = (!empty($_SERVER['smarty_debug']) || !empty($this->debug)) ? true : false;

        //our variables
        $this->tpl = '';
        $this->title = '';
        $this->description = '';
        $this->menu_cat = '';
        $this->init();
    }

    function init()
    {
        //content template
        if ($this->tpl != '') $this->assign('tpl', $this->tpl . '.tpl');

        $this->assign('CUR_LANG', CUR_LANG);
        if (defined('TOP_DOMAIN')) $this->assign('TOP_DOMAIN', TOP_DOMAIN);
        if (!empty($this->title)) $this->assign('PAGE_TITLE', $this->title);
        if (!empty($this->menu_cat)) $this->assign('menu_cat', $this->menu_cat);
        if (!empty($this->description)) $this->assign('PAGE_DESCRIPTION', $this->description);
        if (!empty($_SESSION['user'])) $this->assign('user', $_SESSION['user']);
        if (!empty($_SESSION['admin_user'])) $this->assign('admin_user', $_SESSION['admin_user']);

    }

    function render($file_name = 'main.tpl')
    {
        echo $this->fetch($file_name);

        //close all mysql links
        if (!empty($_SERVER['mysql_links'])) {
            foreach ($_SERVER['mysql_links'] as $link) $link->close();
        }
        die;
    }


    function fetch($template = NULL, $cache_id = NULL, $compile_id = NULL, $parent = NULL, $display = false, $merge_tpl_vars = true, $no_output_filter = false)
    {
        $this->init();
        if ($this->debugging) Smarty_Internal_Debug::display_debug($this);

        //each lang has own cache
        return parent::fetch($template);
    }


}

?>