<!DOCTYPE html>
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
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
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
						{if $admin_login_error eq '1'}
							<div class="alert alert-error">
								<button type="button" class="close" data-dismiss="alert">×</button>
								<strong>Ошибка!</strong> Неверные имя пользователя или пароль
							</div>
						{/if}

						<form id="sign-in" method="post" class="form-validate">
							<div class="control-group">
								<label class="control-label">Имя пользователя</label>
								<div class="controls">
									<input type="text" class="input-block-level" {literal}data-validate="{required: true, messages:{required:'Введите имя пользователя'}}"{/literal} name="admin_login" id="login_username" autocomplete="off" value="{$post.admin_login|escape}"/>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Пароль</label>
								<div class="controls">
									<input type="password" class="input-block-level" {literal}data-validate="{required: true, messages:{required:'Введите пароль'}}"{/literal} name="admin_pwd" id="login_password" autocomplete="off" />
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
<script src="/_admin_res/js/jquery.js"></script>
<script src="/_admin_res/js/bootstrap.js"></script>
<script src="/_admin_res/js/uniform/jquery.uniform.js"></script>
<script src="/_admin_res/js/validate/jquery.metadata.js"></script>
<script src="/_admin_res/js/validate/jquery.validate.js"></script>
<script src="/_admin_res/js/alex_common.js"></script>




</body>
</html>
