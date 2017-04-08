<!DOCTYPE html>
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

                    <div class="span6">
                        <!--panel search-->
						{include file="admin/interface/searchbar.tpl"}
                    </div>
                    <div class="span4">
                        <!--panel button ext-->
                        <div class="panel-ext">
                           {* <div class="btn-group">
                                <!--notification-->
                                <a class="btn btn-danger btn-small" data-toggle="dropdown" href="#" title="3 notification">3</a>
								{include file="admin/interface/notifications.tpl"}
                            </div>
                            <div class="btn-group">
                                <a class="btn btn-inverse btn-small dropdown-toggle" data-toggle="dropdown" href="#">
                                    Shortcut
                                </a>
								{include file="admin/interface/shortcuts.tpl"}
                            </div>*}
                            <div class="btn-group user-group" style="float: right;">
								{include file="admin/interface/top_user_menu.tpl"}
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
						{include file="admin/interface/left_menu.tpl"}
                    </aside><!--/side bar -->
                </div><!-- span side-left -->
                
                <!-- span content -->
                <div class="span11">
                    <!-- content -->
                    <div class="content">

                        <!-- content-breadcrumb -->
                        <div class="content-breadcrumb">
							{include file="admin/interface/breadcrumbs.tpl"}
                        </div><!-- /content-breadcrumb -->
                        
                        <!-- content-body -->
                        <div class="content-body">
                            <!-- ace editor -->
                            <div class="row-fluid">
								{include file="admin/interface/flash_messages.tpl"}

								{if $tpl ne ''}{include file="admin/$tpl"}{/if}
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

        <script src="/_admin_res/js/jquery.js"></script>
        <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>

        <script src="/_admin_res/js/jquery-migrate-1.1.1.js"></script>
        <script src="/_admin_res/js/bootstrap.js"></script>

        <script src="/_admin_res/js/validate/jquery.metadata.js"></script>
        <script src="/_admin_res/js/validate/jquery.validate.js"></script>
        <script src="/_admin_res/js/select2/select2.js"></script>
        <script src="/_admin_res/js/peity/jquery.peity.js"></script>
        <script src="/_admin_res/js/datatables/jquery.dataTables.min.js"></script>
        <script src="/_admin_res/js/datatables/extras/ZeroClipboard.js"></script>
        <script src="/_admin_res/js/datatables/extras/TableTools.min.js"></script>
        <script src="/_admin_res/js/datatables/DT_bootstrap.js"></script>
        <script src="/_admin_res/js/responsive-tables/responsive-tables.js"></script>
        <script src="/_admin_res/js/redactor/redactor.js"></script>
        <script src="/_admin_res/js/redactor/redactor_rus.js"></script>
        <script src="/_admin_res/js/datepicker/bootstrap-datepicker.js"></script>

        <!-- required stilearn template js, for full feature-->
        <script src="/_admin_res/js/holder.js"></script>
        <script src="/_admin_res/js/stilearn-base.js"></script>
        <script src="/_admin_res/js/chosen/chosen.jquery.min.js"></script>
        <script src="/_admin_res/js/jquery.MultiFile.js"></script>
        <script src="/_admin_res/js/uniform/jquery.uniform.js"></script>
        <script src="/_admin_res/js/calendar/fullcalendar.js"></script>
        <script src="/_admin_res/js/alex_common.js"></script>
        {if $tpl eq 'akcii.tpl'}
            <script>init_calendar();</script>

        {/if}
	</body>
</html>
