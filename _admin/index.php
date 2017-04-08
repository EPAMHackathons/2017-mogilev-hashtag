<?php
require_once('../include/init.inc.php');


$tpl->assign('menu_cat', 'servers');
$tpl->tpl = 'index';
$tpl->render('admin/main.tpl');
?>