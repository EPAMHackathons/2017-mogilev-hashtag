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
						{if $items[i].active eq '1'}
							<a href="?act=deactivate&id={$items[i].id}" title="Отключить"><i class="icon-remove"></i></a>
						{else}
							<a href="?act=activate&id={$items[i].id}" title="Включить"><i class="icon-ok"></i></a>
						{/if}
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
							<label class="control-label" for="name">Server Name</label>

							<div class="controls">
								<input type="text" class="grd-white" name="name" id="name" value="{$item.name|escape}" required>
							</div>
						</div>
									
					
						<div class="control-group">
							<label class="control-label" for="ip">Ip</label>

							<div class="controls">
								<input type="text" class="grd-white" name="ip" id="ip" value="{$item.ip|escape}" required>
															</div>
						</div>


				<div class="control-group">
					<label class="control-label">Enabled</label>

					<div class="controls">
						<label class="checkbox">
							<input type="checkbox" data-form="uniform" name="active" id="active1" value="1" {if $item.active eq '1'}checked="checked"{/if}>
						</label>
					</div>
				</div>
				
				<div class="form-actions">
					<button type="submit" class="btn btn-primary">Save</button>
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
		<form method="post" class="form-validate form-horizontal form-alex" enctype="multipart/form-data">
			<input type="hidden" name="id" value="{$item.id}">
			<input type="hidden" name="act" value="child_save">
			{csrf_token post=1}
			<fieldset>
				
									
					
						<div class="control-group">
							<label class="control-label" for="server_id">Server</label>
							<div class="controls">
								<select name="server_id" >
									{section name=i loop=$items}
										<option value="{$items[i].id}" {if $items[i].id eq $item.server_id || $items[i].id eq $parent}selected="selected" {/if}>{$items[i].name} ({$items[i].ip})</option>
									{/section}
								</select>
							</div>
						</div>
					
						<div class="control-group">
							<label class="control-label" for="login">Login</label>

							<div class="controls">
								<input type="text" class="grd-white" name="login" id="login" value="{$item.login|escape}" required>
							</div>
						</div>
									
					
						<div class="control-group">
							<label class="control-label" for="password">Password</label>

							<div class="controls">
								<input type="password" class="grd-white" name="password" id="password" value="{$item.password|escape}">
							</div>
						</div>
									
					
						<div class="control-group">
							<label class="control-label" for="public_key">Public Key</label>

							<div class="controls">
                                {if $item.public_key ne ''}
									<small><a href="/keys/{$item.public_key}?rand={$smarty.now}" target="_blank">{$item.public_key}</a></small>
									<br/>
									<br/>
									<small><a href="?act=del_file&id={$item.id}{csrf_token}" class="confirmMe" style="text-decoration: underline">Удалить</a></small>
									<br/>
                                {/if}
								<div class="uploader" id="uniform-inputUpload">
									<input type="file" name="new_public_key" data-form="uniform" id="inputUpload" size="19" style="opacity: 0;">
									<span class="filename">Не выбран файл</span>
									<span class="action">Выбрать</span>
								</div>
							</div>
						</div>

					
						<div class="control-group">
							<label class="control-label" for="private_key">Private Key</label>
							<div class="controls">
                                {if $item.private_key ne ''}
									<small>
										<a href="/keys/{$item.private_key}?rand={$smarty.now}" target="_blank"> {$item.private_key}</a></small>
									<br/>
									<br/>
									<small><a href="?act=del_file&id={$item.id}{csrf_token}" class="confirmMe" style="text-decoration: underline">Удалить</a></small>
									<br/>
                                {/if}
								<div class="uploader" id="uniform-inputUpload">
									<input type="file" name="new_private_key" data-form="uniform" id="inputUpload" size="19" style="opacity: 0;">
									<span class="filename">Не выбран файл</span>
									<span class="action">Выбрать</span>
								</div>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="key_password">Password Key</label>

							<div class="controls">
								<input type="password" class="grd-white" name="key_password" id="key_password" value="{$item.key_password|escape}">
							</div>
						</div>
				<div class="control-group">
					<label class="control-label">Enabled</label>

					<div class="controls">
						<label class="checkbox">
							<input type="checkbox" data-form="uniform" name="active" id="active1" value="1" {if $item.active eq '1'}checked="checked"{/if}>
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

{/if}