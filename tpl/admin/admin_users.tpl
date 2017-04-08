{***** LIST *****}
{if $act eq ''}
	<div class="span12">
		<div class="box corner-all">
			<div class="box-header grd-white corner-top">
				<div class="header-control">
					<a data-box="collapse"><i class="icofont-caret-up"></i></a>
				</div>
				<span>Администраторы</span>
			</div>
			<div class="box-body">
				<table id="datatables" class="table table-bordered table-striped responsive">
					<thead>
					<tr>
						<th>Actions</th>
						<th>Заголовок</th>
					</tr>
					</thead>
					<tbody>
					{section name=i loop=$items}
						<tr class="">
							<td nowrap class="actions">
								<a href="?act=edit&id={$items[i].id}" title="Edit"><i class="icon-edit"></i></a>

								{if $items[i].active eq '1'}
									<a href="?act=deactivate&id={$items[i].id}" title="Deactivate"><i class="icon-remove"></i></a>
								{else}
									<a href="?act=activate&id={$items[i].id}" title="Activate"><i class="icon-ok"></i></a>
								{/if}

								<a href="?act=delete&id={$items[i].id}" title="Delete" class="confirmMe"><i class="icon-trash"></i></a>

							</td>
							<td class="w100 link {if $items[i].active eq '0'}nonActive{/if}">
								<a href="?act=edit&id={$items[i].id}">{$items[i].login}</a>
							</td>
						</tr>
						{sectionelse}
						<tr>
							<td></td>
							<td colspan="10">Nothing here</td>
						</tr>
					{/section}
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<a href="?act=edit&id=-1" class="btn">Добавить</a>
{***** EDIT *****}
{elseif $act eq 'edit'}
	<div class="box corner-all">
		<!--box header-->
		<div class="box-header grd-white color-silver-dark corner-top">
			<span>Администраторы</span>
		</div>
		<div class="box-body">
			<form method="post" class="form-validate form-horizontal form-alex">
				<input type="hidden" name="id" value="{$item.id}">
				<input type="hidden" name="act" value="save">
                {csrf_token post=1}
				<fieldset>

					<div class="control-group">
						<label class="control-label" for="login">login</label>

						<div class="controls">
							<input type="text" class="grd-white" name="login" id="login" value="{$item.login|escape}">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="pwd">Новый пароль</label>

						<div class="controls">
							<input type="text" class="grd-white" name="pwd" id="pwd" value="">
						</div>
					</div>


					<div class="control-group">
						<label class="control-label" for="inputAuto">Разрешения</label>
						<div class="controls">
							<select name="permissions[]" class="chosen" multiple>
								{section name=i loop=$perms}
									<option value="{$perms[i].perm}" {if $perms[i].has eq '1'}selected="selected" {/if}>{$perms[i].perm}</option>
								{/section}
							</select>
							{*<input name="permissions" type="hidden" id="inputTags" style="width:71%; height: 30px" value="{$item.permissions|escape}"/>*}
						</div>
					</div>


					<div class="control-group">
						<label class="control-label" for="is_root">root</label>

						<div class="controls">
							<label class="checkbox">
								<input type="checkbox" data-form="uniform" name="is_root" id="is_root" value="1" {if $item.is_root eq '1'}checked="checked"{/if}>
							</label>
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
	</div>

	<script type="text/javascript">
		var allTags = {$perms|@json};
	</script>
{/if}
	