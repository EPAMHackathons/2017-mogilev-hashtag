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
			<table id="datatables" class="table table-bordered table-striped responsive ">
				<thead>
				<tr>
					<th>Действия</th>
					<th>Заголовок</th>
				</tr>
				</thead>
				<tbody data-table="user">
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
					<td class="w100 link {if $items[i].active eq '0'}nonActive{/if}" >
						<a href="?act=edit&id={$items[i].id}">{$items[i].title}</a>
																	</td>
				</tr>
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
</div>{***** EDIT *****}
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
							<label class="control-label" for="first_name">first_name</label>

							<div class="controls">
								<input type="text" class="grd-white" name="first_name" id="first_name" value="{$item.first_name|escape}" required>
															</div>
						</div>
									
					
						<div class="control-group">
							<label class="control-label" for="last_name">last_name</label>

							<div class="controls">
								<input type="text" class="grd-white" name="last_name" id="last_name" value="{$item.last_name|escape}" required>
															</div>
						</div>
									
					
						<div class="control-group">
							<label class="control-label" for="username">username</label>

							<div class="controls">
								<input type="text" class="grd-white" name="username" id="username" value="{$item.username|escape}" required>
															</div>
						</div>
									
					
						<div class="control-group">
							<label class="control-label" for="created_at">created_at</label>

							<div class="controls">
								<input type="text" class="grd-white" name="created_at" id="created_at" value="{$item.created_at|escape}" required>
															</div>
						</div>
									
					
						<div class="control-group">
							<label class="control-label" for="updated_at">updated_at</label>

							<div class="controls">
								<input type="text" class="grd-white" name="updated_at" id="updated_at" value="{$item.updated_at|escape}" required>
															</div>
						</div>
									
											<div class="control-group">
							<label class="control-label">Активен</label>

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
</div>{/if}
	