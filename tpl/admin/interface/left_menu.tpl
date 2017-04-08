<ul class="sidebar">

    <li {if $menu_cat eq 'index' }class="active"{/if}>
        <a href="index.php" title="Главная">
            <div class="helper-font-24"><i class="fa fa-dashboard"></i></div>
            <span class="sidebar-text">Главная</span>
        </a>
    </li>
    <li {if $menu_cat eq 'servers' }class="active"{/if}>
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
            <span class="sidebar-text">Server Jobs</span>
        </a>
    </li>
    <li>
        <a href="/_admin/user.php" title="Users">
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

    {if $admin_user->has_permission('config') || $admin_user->has_permission('users') }
        <li>

            <a href="/_admin/config.php" title="Настройки">
                <div class="badge">1</div>
                <div class="helper-font-24"><i class="elusive-cog-alt"></i></div>
                <span class="sidebar-text">Настройки</span>
            </a>


            <ul class="sub-sidebar corner-top shadow-silver-dark">

                {if $admin_user->isRoot() }
                    <li>
                        <a href="/_admin/admin_users.php" title="Администраторы">
                            <div class="helper-font-24"><i class="icofont-user"></i></div>
                            <span class="sidebar-text">Администраторы</span>
                        </a>
                    </li>
                {/if}

            </ul>

        </li>
    {/if}


</ul>
