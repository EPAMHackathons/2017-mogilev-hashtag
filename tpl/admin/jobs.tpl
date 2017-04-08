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
				<tbody data-table="jobs">
				{section name=i loop=$items}
					<tr data-itemid="{$items[i].id}">
						<td nowrap class="actions">
							<a href="?act=edit&id={$items[i].id}" title="Edit"><i class="icon-edit"></i></a>
							{if $items[i].active eq '1'}
								<a href="?act=deactivate&id={$items[i].id}" title="Отключить"><i class="icon-remove"></i></a>
							{else}
								<a href="?act=activate&id={$items[i].id}" title="Включить"><i class="icon-ok"></i></a>
							{/if}
							<a href="?act=delete&id={$items[i].id}{csrf_token}" title="Удалить" class="confirmMe"><i class="icon-trash"></i></a>

						</td>
						<td class="w100 link {if $items[i].active eq '0'}nonActive{/if}">
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
		<form method="post" class="form-validate form-horizontal form-alex">
			<input type="hidden" name="id" value="{$item.id}">
			<input type="hidden" name="act" value="save">
			{csrf_token post=1}
			<fieldset>
				<div class="control-group">
					<label class="control-label" for="title">Title</label>

					<div class="controls">
						<input type="text"  name="title" id="title" value="{$item.title|escape}" required>
					</div>
				</div>


				<div class="control-group">
					<label class="control-label" for="command">Payload</label>

					<div class="controls">
						<textarea  name="command" id="command" required>{$item.command|escape}</textarea>
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="type">Servers</label>

					<div class="controls">
						<select name="servers[]"  multiple class="chosen">
							{foreach from=$servers item=server}
								<option value="{$server.id}" {if is_array($item.servers) && in_array($server.id, $item.servers)}selected="selected"{/if}>{$server.name}</option>
							{/foreach}
						</select>
					</div>
				</div>


				<div class="control-group">
					<label class="control-label" for="type">Type</label>

					<div class="controls">
						<select name="type"  required>
							{foreach from=$types item=type}
								<option value="{$type.id}" {if $item.type eq $type.id}selected="selected"{/if}>{$type.title}</option>
							{/foreach}
						</select>
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
	</div>{/if}
	