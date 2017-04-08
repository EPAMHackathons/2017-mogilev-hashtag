<div class="box corner-all">
	<div class="box-header grd-white corner-top">
		<div class="header-control">
			<a data-box="collapse"><i class="icofont-caret-up"></i></a>
		</div>
		<span>{$t_title}</span>
	</div>
	<div class="box-body">
		{$items[0]}
		<table class="table table-bordered table-striped responsive">
			<thead>
			<tr>
				<th>Действия</th>
				<th>Заголовок</th>
			</tr>
			</thead>
			<tbody data-table="objects">
			{section name=i loop=$items}
				<tr data-itemid="{$items[i].id}" class="sortable">
					<td nowrap class="actions">
						<a href="?act={$act_prefix}move_up&id={$items[i].id}" title="Вверх"><i class="icon-arrow-up"></i></a>
						<a href="?act={$act_prefix}move_down&id={$items[i].id}" title="Вниз"><i class="icon-arrow-down"></i></a>
						<a href="?act={$act_prefix}edit&id={$items[i].id}" title="Edit"><i class="icon-edit"></i></a>
						<a href="?act={$act_prefix}delete&id={$items[i].id}{csrf_token}" title="Удалить" class="confirmMe"><i class="icon-trash"></i></a>
					</td>
					<td class="w100 link {if $items[i].active eq '0'}nonActive{/if}">
						<a href="?act={$act_prefix}edit&id={$items[i].id}">{$items[i].title}</a>
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
		<br/><a href="?act={$act_prefix}edit&id=-1" class="btn">Добавить</a>
	</div>
</div>
