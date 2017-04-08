
<div class="span12">
	<div class="box corner-all">
		<div class="box-header grd-white corner-top">
			<div class="header-control">
				<a data-box="collapse"><i class="icofont-caret-up"></i></a>
			</div>
			<span>Настройки сайта</span>
		</div>
		<div class="box-body">
		<form method="post">
			<input type="hidden" name="act" value="save">
			<table class="table table-bordered table-striped responsive table-hover">
                {csrf_token post=1}
				<thead>
				<tr>
					<th>Значения</th>
				</tr>
				</thead>
				<tbody>
				{section name=i loop=$items}
					<tr>
						<td style="width: 15%">
							<strong>{$items[i].key}</strong><br/>

						</td>
						<td class="w100">
							<input type="text" name="inp_{$items[i].id}" value="{$items[i].value|escape}" class="input-xxlarge"><br/>
							<small>{$items[i].comment}</small>
						</td>
					</tr>
				{/section}
				<tfoot>
				<tr>
					<td colspan="2">
						<strong>Добавить значение:</strong><br/>
						<input type="text" name="key" placeholder="Ключ"/>
						<input type="text" name="value"  placeholder="Значение"/>
						<input type="text" name="comment"  placeholder="Описание" class="input-xlarge"/>

					</td>
				</tr>
				<tr>
					<td style="text-align: center" colspan="3">
						<button type="submit" class="btn btn-primary">Сохранить</button>
					</td>
				</tr>
				</tfoot>
				</tbody>
			</table>
		</form>
		</div>
	</div>
</div>