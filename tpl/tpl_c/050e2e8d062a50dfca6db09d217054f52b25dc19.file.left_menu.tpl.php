<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-04-08 07:29:37
         compiled from "/Users/ivan/www/telehelp.ru/www/tpl/admin/interface/left_menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:95573894358e89161a53286-04158201%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '050e2e8d062a50dfca6db09d217054f52b25dc19' => 
    array (
      0 => '/Users/ivan/www/telehelp.ru/www/tpl/admin/interface/left_menu.tpl',
      1 => 1491636495,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '95573894358e89161a53286-04158201',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'menu_cat' => 0,
    'admin_user' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_58e89161a59355_38863374',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58e89161a59355_38863374')) {function content_58e89161a59355_38863374($_smarty_tpl) {?><ul class="sidebar">

    <li <?php if ($_smarty_tpl->tpl_vars['menu_cat']->value=='index') {?>class="active"<?php }?>>
        <a href="index.php" title="Главная">
            <div class="helper-font-24"><i class="fa fa-dashboard"></i></div>
            <span class="sidebar-text">Главная</span>
        </a>
    </li>
    <li <?php if ($_smarty_tpl->tpl_vars['menu_cat']->value=='servers') {?>class="active"<?php }?>>
        <a href="/_admin/servers.php" title="Servers">
            <div class="helper-font-24"><i class="fa fa-bank"></i></div>
            <span class="sidebar-text">Servers</span>
        </a>
    </li>
    <li>
        <a href="/_admin/jobs.php" title="Jobs">
            <div class="helper-font-24"><i class="elusive-rss"></i></div>
            <span class="sidebar-text">Jobs</span>
        </a>
    </li>

    <li>
        <a href="/_admin/servers_credentials.php" title="Servers Creditals">
            <div class="helper-font-24"><i class="elusive-list"></i></div>
            <span class="sidebar-text">Servers Creditals</span>
        </a>
    </li>
    <li>
        <a href="/_admin/servers_jobs.php" title="Servers Jobs">
            <div class="helper-font-24"><i class="elusive-list"></i></div>
            <span class="sidebar-text">Servers Creditals</span>
        </a>
    </li>
    <li>
        <a href="/_admin/users.php" title="Users">
            <div class="helper-font-24"><i class="elusive-list"></i></div>
            <span class="sidebar-text">Users</span>
        </a>
    </li>
    <li>
        <a href="/_admin/users.php" title="Users Premissions">
            <div class="helper-font-24"><i class="elusive-list"></i></div>
            <span class="sidebar-text">Users Permissions</span>
        </a>
    </li>

    <?php if ($_smarty_tpl->tpl_vars['admin_user']->value->has_permission('config')||$_smarty_tpl->tpl_vars['admin_user']->value->has_permission('users')) {?>
        <li>

            <a href="/_admin/config.php" title="Настройки">
                <div class="badge">1</div>
                <div class="helper-font-24"><i class="elusive-cog-alt"></i></div>
                <span class="sidebar-text">Настройки</span>
            </a>


            <ul class="sub-sidebar corner-top shadow-silver-dark">

                <?php if ($_smarty_tpl->tpl_vars['admin_user']->value->isRoot()) {?>
                    <li>
                        <a href="/_admin/admin_users.php" title="Администраторы">
                            <div class="helper-font-24"><i class="icofont-user"></i></div>
                            <span class="sidebar-text">Администраторы</span>
                        </a>
                    </li>
                <?php }?>

            </ul>

        </li>
    <?php }?>


</ul>
<?php }} ?>
