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
						<tr data-itemid="{$items[i].id}">
							<td nowrap class="actions">
								{if $items[i].active eq '1'}
									<a href="?act=deactivate&id={$items[i].id}" title="Отключить"><i class="icon-remove"></i></a>
								{else}
									<a href="?act=activate&id={$items[i].id}" title="Включить"><i class="icon-ok"></i></a>
								{/if}
							</td>
							<td class="w100 link {if $items[i].active eq '0'}nonActive{/if}">
								<a href="?act=edit&id={$items[i].id}">{$items[i].username} ({$items[i].first_name} {$items[i].last_name})</a>
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
	</div>
{elseif $act eq 'edit'}
	<div class="span12">
		<div class="box corner-all">
			<div class="box-header grd-white corner-top">
				<div class="header-control">
					<a data-box="collapse"><i class="icofont-caret-up"></i></a>
				</div>
				<span>Permission matrix for {$user.username} ({$user.first_name} {$user.last_name})</span>
			</div>
			<div class="box-body">
				<form method="post" class="form-validate form-horizontal form-alex">
					<input type="hidden" name="id" value="{$user.id}">
					<input type="hidden" name="act" value="save">
					<table class="table table-bordered table-striped responsive ">
						<thead>
						<tr>
							<th>Server</th>
							<th>Credential</th>
							<th class="w100">Job</th>
						</tr>
						</thead>
						<tbody>
						{foreach from=$servers item=serv}
							<tr>
								<th rowspan="{$serv.jobs|@count+1}" style="white-space: nowrap">{$serv.name}</th>
							</tr>
							{foreach from=$serv.jobs item=job name=i}
								<tr>
									<td>
										<select name="job_{$serv.id}_{$job.id}_creds" style="float: left;">
											{foreach from=$serv.credentials item=cred}
												<option value="{$cred.id}">{$cred.login}</option>
											{/foreach}
										</select>
									</td>
									<td>
										<label style="float: left;">
											<input type="checkbox" name="job_{$serv.id}_{$job.id}" value="1">
											{$job.title}
										</label>
									</td>
								</tr>
							{/foreach}
						{/foreach}

						</tbody>
					</table>

					<div class="form-actions">
						<button type="submit" class="btn btn-primary">Сохранить</button>
					</div>
				</form>
			</div>
		</div>
	</div>
{/if}
	