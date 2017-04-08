<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-04-08 07:23:10
         compiled from "/Users/ivan/www/telehelp.ru/www/tpl/admin/login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:23074837958e88fde704ed8-31488300%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dafb66e14bcecd691d92f2c09b7ae9c23b09bed3' => 
    array (
      0 => '/Users/ivan/www/telehelp.ru/www/tpl/admin/login.tpl',
      1 => 1491635986,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '23074837958e88fde704ed8-31488300',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'admin_login_error' => 0,
    'post' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_58e88fde748321_92659903',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58e88fde748321_92659903')) {function content_58e88fde748321_92659903($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Auth</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="stilearning">

	<!-- google font -->
	<link href="/_admin_res/css/google_font.css" rel="stylesheet" type="text/css" />

	<!-- styles -->
	<link href="/_admin_res/css/bootstrap.css" rel="stylesheet">
	<link href="/_admin_res/css/bootstrap-responsive.css" rel="stylesheet">
	<!-- default theme -->
	<link id="style-base" href="/_admin_res/css/stilearn.css" rel="stylesheet">
	<link id="style-responsive" href="/_admin_res/css/stilearn-responsive.css" rel="stylesheet">
	<link id="style-helper" href="/_admin_res/css/stilearn-helper.css" rel="stylesheet">
	<!-- usage -->
	<link href="/_admin_res/css/stilearn-icon.css" rel="stylesheet">
	<link href="/_admin_res/css/font-awesome.css" rel="stylesheet">
	<link href="/_admin_res/css/animate.css" rel="stylesheet">
	<link href="/_admin_res/css/uniform.default.css" rel="stylesheet">

	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	<?php echo '<script'; ?>
 src="http://html5shim.googlecode.com/svn/trunk/html5.js"><?php echo '</script'; ?>
>
	<![endif]-->
</head>

<body>
<!-- section header -->
<header class="header" data-spy="affix" data-offset-top="0">
	<!--nav bar helper-->
	<div class="navbar-helper">
		<div class="row-fluid">
			<!--panel site-name-->
			<div class="span2">
				<div class="panel-sitename">
					<h2><a href="/_admin/"><span class="color-teal">Tele</span>HELPER</a></h2>
				</div>
			</div>
			<!--/panel name-->
		</div>
	</div><!--/nav bar helper-->
</header>

<!-- section content -->
<section class="section">
	<div class="container">
		<div class="signin-form row-fluid">
			<!--Sign In-->
			<div class="span5 offset3">
				<div class="box corner-all">
					<div class="box-header grd-teal color-white corner-top">
						<span>Авторизация:</span>
					</div>
					<div class="box-body bg-white">
						<?php if ($_smarty_tpl->tpl_vars['admin_login_error']->value=='1') {?>
							<div class="alert alert-error">
								<button type="button" class="close" data-dismiss="alert">×</button>
								<strong>Ошибка!</strong> Неверные имя пользователя или пароль
							</div>
						<?php }?>

						<form id="sign-in" method="post" class="form-validate">
							<div class="control-group">
								<label class="control-label">Имя пользователя</label>
								<div class="controls">
									<input type="text" class="input-block-level" data-validate="{required: true, messages:{required:'Введите имя пользователя'}}" name="admin_login" id="login_username" autocomplete="off" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['admin_login'], ENT_QUOTES, 'UTF-8', true);?>
"/>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Пароль</label>
								<div class="controls">
									<input type="password" class="input-block-level" data-validate="{required: true, messages:{required:'Введите пароль'}}" name="admin_pwd" id="login_password" autocomplete="off" />
								</div>
							</div>
							<div class="form-actions">
								<input type="submit" class="btn btn-block btn-large btn-primary" value="Войти" />
							</div>
						</form>
					</div>
				</div>
			</div><!--/Sign In-->
		</div><!-- /row -->
	</div><!-- /container -->


</section>

<!-- javascript
================================================== -->
<?php echo '<script'; ?>
 src="/_admin_res/js/jquery.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/_admin_res/js/bootstrap.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/_admin_res/js/uniform/jquery.uniform.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/_admin_res/js/validate/jquery.metadata.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/_admin_res/js/validate/jquery.validate.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/_admin_res/js/alex_common.js"><?php echo '</script'; ?>
>




</body>
</html>
<?php }} ?>
