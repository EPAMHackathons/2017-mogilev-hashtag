{***** LIST *****}
{if $act eq ''}
	<div class="span12">
	<div class="box corner-all">
		<div class="box-header grd-white corner-top">
			<div class="header-control">
				<a data-box="collapse"><i class="icofont-caret-up"></i></a>
			</div>
			<span>{section name=i loop=$admin_titles}{if $admin_titles[i].key eq $menu_cat}{$admin_titles[i].title}{/if}{sectionelse}{$table}{/section}</span>
		</div>
		<div class="box-body">
			<table  class="table table-bordered table-striped responsive ">
				<thead>
				<tr>
					<th>Действия</th>
					<th>Заголовок</th>
				</tr>
				</thead>
				<tbody data-table="servers">
				{section name=i loop=$items}
				<tr data-itemid="{$items[i].id}" >
					<td nowrap class="actions" >
												<a href="?act=edit&id={$items[i].id}" title="Edit"><i class="icon-edit"></i></a>
												<a href="?act=delete&id={$items[i].id}{csrf_token}" title="Удалить" class="confirmMe"><i class="icon-trash"></i></a>
						
					</td>
					<td class="w100 link {if $items[i].active eq '0'}nonActive{/if}" colspan="2">
						<strong><a href="?act=edit&id={$items[i].id}">{$items[i].name} ({$items[i].ip})</a>
						&nbsp;<a href="?act=child_edit&parent={$items[i].id}" title="Добавить"><i class="icon-plus"></i></a>						</strong>					</td>
				</tr>
									{assign var=childs value=$items[i].childs}
					{section name=j loop=$childs}
						{if $smarty.section.j.first}
							<tr>
							<td></td>
							<td>
							<table class="table table-bordered table-striped responsive table-dragsortable">
							<tbody data-table="servers_credentials">
						{/if}
							<tr data-itemid="{$childs[j].id}" class="sortable"  >
								<td nowrap class="actions">
									<a href="?act=child_edit&id={$childs[j].id}" title="Edit"><i class="icon-edit"></i></a>
									{if $childs[j].active eq '1'}
										<a href="?act=child_deactivate&id={$childs[j].id}" title="Отключить"><i class="icon-remove"></i></a>
									{else}
										<a href="?act=child_activate&id={$childs[j].id}" title="Включить"><i class="icon-ok"></i></a>
									{/if}
									<a href="?act=child_delete&id={$childs[j].id}" title="Удалить" class="confirmMe"><i class="icon-trash"></i></a>
								</td>
								<td class="w100 link {if $childs[j].active eq '0'}nonActive{/if}" >
									<a href="?act=child_edit&id={$childs[j].id}">{$childs[j].login}</a>
								</td>
							</tr>
						{if $smarty.section.j.last}
							</tbody>
							</table>
							</td>
							</tr>
						{/if}
					{/section}
								{sectionelse}
				<tr>
					<td></td>
					<td colspan="10">Нет записей</td>
				</tr>
				{/section}
				</tbody>
			</table>
			<Br/>
			<a href="?act=edit&id=-1" class="btn">Добавить</a>
		</div>
	</div>
</div>

{***** EDIT PARENT *****}
{elseif $act eq 'edit'}
	<div class="box corner-all">
	<!--box header-->
	<div class="box-header grd-white color-silver-dark corner-top">
		<span>{section name=i loop=$admin_titles}{if $admin_titles[i].key eq $menu_cat}{$admin_titles[i].title}{/if}{sectionelse}{$table}{/section}</span>
	</div>
	<div class="box-body">
		<form method="post" class="form-validate form-horizontal form-alex" >
			<input type="hidden" name="id" value="{$item.id}">
			<input type="hidden" name="act" value="save">
			{csrf_token post=1}
			<fieldset>
				
									
					
						<div class="control-group">
							<label class="control-label" for="name">name</label>

							<div class="controls">
								<input type="text" class="grd-white" name="name" id="name" value="{$item.name|escape}" required>
															</div>
						</div>
									
					
						<div class="control-group">
							<label class="control-label" for="ip">ip</label>

							<div class="controls">
								<input type="text" class="grd-white" name="ip" id="ip" value="{$item.ip|escape}" required>
															</div>
						</div>
									
				
				<div class="form-actions">
					<button type="submit" class="btn btn-primary">Сохранить</button>
				</div>

			</fieldset>
		</form>
	</div>
</div>


{***** EDIT CHILD *****}
{elseif $act eq 'child_edit'}
	<div class="box corner-all">
	<!--box header-->
	<div class="box-header grd-white color-silver-dark corner-top">
		<span>{section name=i loop=$admin_titles}{if $admin_titles[i].key eq $menu_cat}{$admin_titles[i].title}{/if}{sectionelse}{$table}{/section}</span>
	</div>
	<div class="box-body">
		<form method="post" class="form-validate form-horizontal form-alex" >
			<input type="hidden" name="id" value="{$item.id}">
			<input type="hidden" name="act" value="child_save">
			{csrf_token post=1}
			<fieldset>
				
									
					
						<div class="control-group">
							<label class="control-label" for="server_id">server_id</label>
							<div class="controls">
								<select name="server_id" >
									{section name=i loop=$items}
										<option value="{$items[i].id}" {if $items[i].id eq $item.server_id || $items[i].id eq $parent}selected="selected" {/if}>{$items[i].name} ({$items[i].ip})</option>
									{/section}
								</select>
							</div>
						</div>
					
						<div class="control-group">
							<label class="control-label" for="login">login</label>

							<div class="controls">
								<input type="text" class="grd-white" name="login" id="login" value="{$item.login|escape}" required>
							</div>
						</div>
									
					
						<div class="control-group">
							<label class="control-label" for="password">password</label>

							<div class="controls">
								<input type="text" class="grd-white" name="password" id="password" value="{$item.password|escape}">
							</div>
						</div>
									
					
						<div class="control-group">
							<label class="control-label" for="public_key">public_key</label>

							<div class="controls">
								<input type="text" class="grd-white" name="public_key" id="public_key" value="{$item.public_key|escape}" >
															</div>
						</div>
									
					
						<div class="control-group">
							<label class="control-label" for="private_key">private_key</label>

							<div class="controls">
								<input type="text" class="grd-white" name="private_key" id="private_key" value="{$item.private_key|escape}">
							</div>
						</div>
									
				
				<div class="form-actions">
					<button type="submit" class="btn btn-primary">Сохранить</button>
				</div>

			</fieldset>
		</form>
	</div>
</div>

{/if}