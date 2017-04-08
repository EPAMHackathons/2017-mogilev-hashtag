<ul class="sidebar">

	<li {if $menu_cat eq 'index' }class="active"{/if}>
		<a href="index.php" title="Главная">
			<div class="helper-font-24"><i class="fa fa-dashboard"></i></div>
			<span class="sidebar-text">Главная</span>
		</a>
	</li>
	<li {if $menu_cat eq 'jobs'  || $menu_cat eq 'job_types'}class="active"{/if}>
		<a href="/_admin/jobs.php" title="Jobs">
			<div class="badge">1</div>
			<div class="helper-font-24"><i class="elusive-share"></i></div>
			<span class="sidebar-text">Jobs</span>
		</a>

		<ul class="sub-sidebar corner-top shadow-silver-dark">

			{if $admin_user->isRoot() }
				<li>
					<a href="/_admin/job_types.php" title="Job types">
						<div class="helper-font-24"><i class="elusive-share"></i></div>
						<span class="sidebar-text">Job types</span>
					</a>
				</li>
			{/if}

		</ul>

	</li>

	<li {if $menu_cat eq 'servers_credentials' }class="active"{/if}>
		<a href="/_admin/servers_credentials.php" title="Servers Creditals">
			<div class="helper-font-24"><i class="elusive-lock-alt"></i></div>
			<span class="sidebar-text">Servers Creditals</span>
		</a>
	</li>

	<li {if $menu_cat eq 'users' }class="active"{/if}>
		<a href="/_admin/user.php" title="Users">
			<div class="helper-font-24"><i class="elusive-user"></i></div>
			<span class="sidebar-text">Users</span>
		</a>
	</li>


	{if  $admin_user->has_permission('admin_users') }
		<li {if $menu_cat eq 'admin_users' }class="active"{/if}>
			<a href="/_admin/admin_users.php" title="Admins">
				<div class="helper-font-24"><i class="elusive-cog"></i></div>
				<span class="sidebar-text">Admins</span>
			</a>
		</li>
	{/if}


</ul>
