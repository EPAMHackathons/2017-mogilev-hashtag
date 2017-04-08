<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-04-08 07:29:37
         compiled from "/Users/ivan/www/telehelp.ru/www/tpl/admin/admin_users.tpl" */ ?>
<?php /*%%SmartyHeaderCode:37602601458e89161a75582-33125243%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8d05aedf25f54477f8259e035bd277ba5ad3e7a7' => 
    array (
      0 => '/Users/ivan/www/telehelp.ru/www/tpl/admin/admin_users.tpl',
      1 => 1486629911,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '37602601458e89161a75582-33125243',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'act' => 0,
    'items' => 0,
    'item' => 0,
    'perms' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_58e89161a90c50_07522788',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58e89161a90c50_07522788')) {function content_58e89161a90c50_07522788($_smarty_tpl) {?><?php if (!is_callable('smarty_function_csrf_token')) include '/Users/ivan/www/telehelp.ru/www/include/smarty/plugins/function.csrf_token.php';
if (!is_callable('smarty_modifier_json')) include '/Users/ivan/www/telehelp.ru/www/include/smarty/plugins/modifier.json.php';
?>
<?php if ($_smarty_tpl->tpl_vars['act']->value=='') {?>
	<div class="span12">
		<div class="box corner-all">
			<div class="box-header grd-white corner-top">
				<div class="header-control">
					<a data-box="collapse"><i class="icofont-caret-up"></i></a>
				</div>
				<span>Администраторы</span>
			</div>
			<div class="box-body">
				<table id="datatables" class="table table-bordered table-striped responsive">
					<thead>
					<tr>
						<th>Actions</th>
						<th>Заголовок</th>
					</tr>
					</thead>
					<tbody>
					<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['i'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['i']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['name'] = 'i';
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['items']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
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
						<tr class="">
							<td nowrap class="actions">
								<a href="?act=edit&id=<?php echo $_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
" title="Edit"><i class="icon-edit"></i></a>

								<?php if ($_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['active']=='1') {?>
									<a href="?act=deactivate&id=<?php echo $_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
" title="Deactivate"><i class="icon-remove"></i></a>
								<?php } else { ?>
									<a href="?act=activate&id=<?php echo $_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
" title="Activate"><i class="icon-ok"></i></a>
								<?php }?>

								<a href="?act=delete&id=<?php echo $_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
" title="Delete" class="confirmMe"><i class="icon-trash"></i></a>

							</td>
							<td class="w100 link <?php if ($_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['active']=='0') {?>nonActive<?php }?>">
								<a href="?act=edit&id=<?php echo $_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['items']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['login'];?>
</a>
							</td>
						</tr>
						<?php endfor; else: ?>
						<tr>
							<td></td>
							<td colspan="10">Nothing here</td>
						</tr>
					<?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<a href="?act=edit&id=-1" class="btn">Добавить</a>

<?php } elseif ($_smarty_tpl->tpl_vars['act']->value=='edit') {?>
	<div class="box corner-all">
		<!--box header-->
		<div class="box-header grd-white color-silver-dark corner-top">
			<span>Администраторы</span>
		</div>
		<div class="box-body">
			<form method="post" class="form-validate form-horizontal form-alex">
				<input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
">
				<input type="hidden" name="act" value="save">
                <?php echo smarty_function_csrf_token(array('post'=>1),$_smarty_tpl);?>

				<fieldset>

					<div class="control-group">
						<label class="control-label" for="login">login</label>

						<div class="controls">
							<input type="text" class="grd-white" name="login" id="login" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['login'], ENT_QUOTES, 'UTF-8', true);?>
">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="pwd">Новый пароль</label>

						<div class="controls">
							<input type="text" class="grd-white" name="pwd" id="pwd" value="">
						</div>
					</div>


					<div class="control-group">
						<label class="control-label" for="inputAuto">Разрешения</label>
						<div class="controls">
							<select name="permissions[]" class="chosen" multiple>
								<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['i'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['i']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['name'] = 'i';
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['perms']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
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
									<option value="<?php echo $_smarty_tpl->tpl_vars['perms']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['perm'];?>
" <?php if ($_smarty_tpl->tpl_vars['perms']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['has']=='1') {?>selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['perms']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['perm'];?>
</option>
								<?php endfor; endif; ?>
							</select>
							
						</div>
					</div>


					<div class="control-group">
						<label class="control-label" for="is_root">root</label>

						<div class="controls">
							<label class="checkbox">
								<input type="checkbox" data-form="uniform" name="is_root" id="is_root" value="1" <?php if ($_smarty_tpl->tpl_vars['item']->value['is_root']=='1') {?>checked="checked"<?php }?>>
							</label>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label">Активен</label>

						<div class="controls">
							<label class="checkbox">
								<input type="checkbox" data-form="uniform" name="active" id="active1" value="1" <?php if ($_smarty_tpl->tpl_vars['item']->value['active']=='1') {?>checked="checked"<?php }?>>
							</label>
						</div>
					</div>
					<div class="form-actions">
						<button type="submit" class="btn btn-primary">Сохранить</button>
					</div>

				</fieldset>
			</form>
		</div>
	</div>

	<?php echo '<script'; ?>
 type="text/javascript">
		var allTags = <?php echo smarty_modifier_json($_smarty_tpl->tpl_vars['perms']->value);?>
;
	<?php echo '</script'; ?>
>
<?php }?>
	<?php }} ?>
