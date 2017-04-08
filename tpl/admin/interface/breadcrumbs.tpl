
<!--breadcrumb-->

<ul class="breadcrumb">
	<li><a href="index.php"><i class="icofont-home"></i> Главная</a>
		{if $menu_cat ne ''}<span class="divider">&rsaquo;</span>{/if}
	</li>
	<li>
	{section name=i loop=$admin_titles}
		{if $admin_titles[i].key eq $menu_cat}<a href="{$menu_cat}.php">{$admin_titles[i].title}</a>{/if}
	{/section}
	</li>

</ul>

<!--/breadcrumb-->
