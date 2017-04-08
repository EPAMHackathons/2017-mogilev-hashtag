<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-04-08 07:29:37
         compiled from "/Users/ivan/www/telehelp.ru/www/tpl/admin/main.tpl" */ ?>
<?php /*%%SmartyHeaderCode:195517029658e89161a08012-97335418%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '00b7172ad7ef18eb1dde9418a4af1ab28aa6f8a3' => 
    array (
      0 => '/Users/ivan/www/telehelp.ru/www/tpl/admin/main.tpl',
      1 => 1491635986,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '195517029658e89161a08012-97335418',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'tpl' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_58e89161a47bb4_89166279',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58e89161a47bb4_89166279')) {function content_58e89161a47bb4_89166279($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>admin area</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="stilearning">

        <link href="/_admin_res/css/google_font.css" rel="stylesheet" type="text/css" />
        <link href="/_admin_res/css/bootstrap.css" rel="stylesheet">
        <link href="/_admin_res/css/bootstrap-responsive.css" rel="stylesheet">
        <link id="style-base" href="/_admin_res/css/stilearn.css" rel="stylesheet">
        <link id="style-responsive" href="/_admin_res/css/stilearn-responsive.css" rel="stylesheet">
        <link id="style-helper" href="/_admin_res/css/stilearn-helper.css" rel="stylesheet">
        <link href="/_admin_res/css/stilearn-icon.css" rel="stylesheet">
        <link href="/_admin_res/css/font-awesome.css" rel="stylesheet">
		<link href="/_admin_res/css/elusive-webfont.css" rel="stylesheet"> <!-- new icon, add in v1.2 -->
        <link href="/_admin_res/css/animate.css" rel="stylesheet">
        <link href="/_admin_res/css/uniform.default.css" rel="stylesheet">
        <link href="/_admin_res/css/select2.css" rel="stylesheet">
		<link href="/_admin_res/css/redactor.css" rel="stylesheet">
		<link href="/_admin_res/css/datepicker.css" rel="stylesheet">
		<link href="/_admin_res/css/fullcalendar.css" rel="stylesheet">
		<link href="/_admin_res/css/chosen.css" rel="stylesheet">
		<link href="/_admin_res/css/alex_css.css" rel="stylesheet">

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

                    <div class="span6">
                        <!--panel search-->
						<?php echo $_smarty_tpl->getSubTemplate ("admin/interface/searchbar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

                    </div>
                    <div class="span4">
                        <!--panel button ext-->
                        <div class="panel-ext">
                           
                            <div class="btn-group user-group" style="float: right;">
								<?php echo $_smarty_tpl->getSubTemplate ("admin/interface/top_user_menu.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

                            </div>
                        </div><!--panel button ext-->
                    </div>
                </div>
            </div><!--/nav bar helper-->
        </header>

        <!-- section content -->
        <section class="section">
            <div class="row-fluid">
                <!-- span side-left -->
                <div class="span1">
                    <!--side bar-->
                    <aside class="side-left">
						<?php echo $_smarty_tpl->getSubTemplate ("admin/interface/left_menu.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

                    </aside><!--/side bar -->
                </div><!-- span side-left -->
                
                <!-- span content -->
                <div class="span11">
                    <!-- content -->
                    <div class="content">

                        <!-- content-breadcrumb -->
                        <div class="content-breadcrumb">
							<?php echo $_smarty_tpl->getSubTemplate ("admin/interface/breadcrumbs.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

                        </div><!-- /content-breadcrumb -->
                        
                        <!-- content-body -->
                        <div class="content-body">
                            <!-- ace editor -->
                            <div class="row-fluid">
								<?php echo $_smarty_tpl->getSubTemplate ("admin/interface/flash_messages.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


								<?php if ($_smarty_tpl->tpl_vars['tpl']->value!='') {
echo $_smarty_tpl->getSubTemplate ("admin/".((string)$_smarty_tpl->tpl_vars['tpl']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);
}?>
                            </div><!-- /row-fluid -->
                            <!--/ace editor-->
                        </div><!--/content-body -->
                    </div><!-- /content -->
                </div><!-- /span content -->

            </div>
        </section>

        <!-- section footer -->
        <footer>
            <a rel="to-top" href="#top"><i class="icofont-circle-arrow-up"></i></a>
        </footer>

        <!-- javascript
        ================================================== -->

        <?php echo '<script'; ?>
 src="/_admin_res/js/jquery.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 type="text/javascript" src="http://platform.twitter.com/widgets.js"><?php echo '</script'; ?>
>

        <?php echo '<script'; ?>
 src="/_admin_res/js/jquery-migrate-1.1.1.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="/_admin_res/js/bootstrap.js"><?php echo '</script'; ?>
>

        <?php echo '<script'; ?>
 src="/_admin_res/js/validate/jquery.metadata.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="/_admin_res/js/validate/jquery.validate.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="/_admin_res/js/select2/select2.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="/_admin_res/js/peity/jquery.peity.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="/_admin_res/js/datatables/jquery.dataTables.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="/_admin_res/js/datatables/extras/ZeroClipboard.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="/_admin_res/js/datatables/extras/TableTools.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="/_admin_res/js/datatables/DT_bootstrap.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="/_admin_res/js/responsive-tables/responsive-tables.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="/_admin_res/js/redactor/redactor.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="/_admin_res/js/redactor/redactor_rus.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="/_admin_res/js/datepicker/bootstrap-datepicker.js"><?php echo '</script'; ?>
>

        <!-- required stilearn template js, for full feature-->
        <?php echo '<script'; ?>
 src="/_admin_res/js/holder.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="/_admin_res/js/stilearn-base.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="/_admin_res/js/chosen/chosen.jquery.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="/_admin_res/js/jquery.MultiFile.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="/_admin_res/js/uniform/jquery.uniform.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="/_admin_res/js/calendar/fullcalendar.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="/_admin_res/js/alex_common.js"><?php echo '</script'; ?>
>
        <?php if ($_smarty_tpl->tpl_vars['tpl']->value=='akcii.tpl') {?>
            <?php echo '<script'; ?>
>init_calendar();<?php echo '</script'; ?>
>

        <?php }?>
	</body>
</html>
<?php }} ?>
