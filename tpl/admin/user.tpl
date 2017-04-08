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
{/if}
	