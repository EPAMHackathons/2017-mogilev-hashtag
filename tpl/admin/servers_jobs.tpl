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
				<tbody data-table="servers_jobs">
				{section name=i loop=$items}
				<tr data-itemid="{$items[i].id}" >
					<td nowrap class="actions" >
												<a href="?act=edit&id={$items[i].id}" title="Edit"><i class="icon-edit"></i></a>
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
							<label class="control-label" for="server_id">server_id</label>

							<div class="controls">
								<input type="text" class="grd-white" name="server_id" id="server_id" value="{$item.server_id|escape}" required>
															</div>
						</div>
									
					
						<div class="control-group">
							<label class="control-label" for="script_id">script_id</label>

							<div class="controls">
								<input type="text" class="grd-white" name="script_id" id="script_id" value="{$item.script_id|escape}" required>
															</div>
						</div>
									
				
				<div class="form-actions">
					<button type="submit" class="btn btn-primary">Сохранить</button>
				</div>

			</fieldset>
		</form>
	</div>
</div>{/if}
	