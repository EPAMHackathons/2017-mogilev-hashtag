<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-04-08 07:29:37
         compiled from "/Users/ivan/www/telehelp.ru/www/tpl/admin/interface/breadcrumbs.tpl" */ ?>
<?php /*%%SmartyHeaderCode:168571446158e89161a5ce58-56975839%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9dbf575ee2eabb60716047da2e5f41b81ee94c84' => 
    array (
      0 => '/Users/ivan/www/telehelp.ru/www/tpl/admin/interface/breadcrumbs.tpl',
      1 => 1486629911,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '168571446158e89161a5ce58-56975839',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'menu_cat' => 0,
    'admin_titles' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_58e89161a69803_78827731',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58e89161a69803_78827731')) {function content_58e89161a69803_78827731($_smarty_tpl) {?>
<!--breadcrumb-->

<ul class="breadcrumb">
	<li><a href="index.php"><i class="icofont-home"></i> Главная</a>
		<?php if ($_smarty_tpl->tpl_vars['menu_cat']->value!='') {?><span class="divider">&rsaquo;</span><?php }?>
	</li>
	<li>
	<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['i'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['i']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['name'] = 'i';
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['admin_titles']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total']);
?>
		<?php if ($_smarty_tpl->tpl_vars['admin_titles']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['key']==$_smarty_tpl->tpl_vars['menu_cat']->value) {?><a href="<?php echo $_smarty_tpl->tpl_vars['menu_cat']->value;?>
.php"><?php echo $_smarty_tpl->tpl_vars['admin_titles']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['title'];?>
</a><?php }?>
	<?php endfor; endif; ?>
	</li>

</ul>

<!--/breadcrumb-->
<?php }} ?>
