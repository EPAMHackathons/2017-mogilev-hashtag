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
				<tbody data-table="users_permissions">
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
							<label class="control-label" for="user_id">user_id</label>

							<div class="controls">
								<input type="text" class="grd-white" name="user_id" id="user_id" value="{$item.user_id|escape}" required>
															</div>
						</div>
									
					
						<div class="control-group">
							<label class="control-label" for="job_id">job_id</label>

							<div class="controls">
								<input type="text" class="grd-white" name="job_id" id="job_id" value="{$item.job_id|escape}" required>
															</div>
						</div>
									
				
				<div class="form-actions">
					<button type="submit" class="btn btn-primary">Сохранить</button>
				</div>

			</fieldset>
		</form>
	</div>
</div>{/if}
	